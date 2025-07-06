<?php

namespace App\Http\Controllers;

use App\Models\BundleType;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Admin\WhyChooseUs; // Add this import

class CustomBundleController extends Controller
{
    /**
     * Display the custom bundles landing page.
     */
    public function index()
    {
        $bundleTypes = BundleType::where('active', true)->get();
        
        // Parse features for each bundle type only if it's a JSON string
        $bundleTypes->each(function($bundleType) {
            if (is_string($bundleType->features)) {
                $bundleType->features = json_decode($bundleType->features, true);
            }
        });
    
        return view('custom-bundles.custom-bundles', compact('bundleTypes'));
    }
    
    /**
     * Display the bundle builder page.
     * 
     * @param string $type
     * @return \Illuminate\View\View
     */
    public function builder($type = 'domestic')
    {
        // Validate bundle type
        $validTypes = ['domestic', 'international', 'combination'];
        if (!in_array($type, $validTypes)) {
            abort(404);
        }
        
        // Get bundle type info
        $bundleType = BundleType::where('slug', $type)->firstOrFail();
        
        // Ensure features is properly formatted as an array
        if (is_string($bundleType->features)) {
            try {
                $bundleType->features = json_decode($bundleType->features, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $bundleType->features = [];
                }
            } catch (\Exception $e) {
                $bundleType->features = [];
            }
        } elseif (!is_array($bundleType->features)) {
            $bundleType->features = [];
        }
        
        // Get price from bundle type
        $price = $bundleType->price ?? 0;
        
        // Get destinations based on bundle type
        if ($type === 'domestic') {
            $firstDestinations = $this->getDomesticDestinations();
            $secondDestinations = $this->getDomesticDestinations();
        } elseif ($type === 'international') {
            $firstDestinations = $this->getInternationalDestinations();
            $secondDestinations = $this->getInternationalDestinations();
        } else { // combination
            $firstDestinations = $this->getDomesticDestinations();
            $secondDestinations = $this->getInternationalDestinations();
        }
        
        return view('custom-bundles.custom-bundle-builder', compact(
            'bundleType',
            'price',
            'firstDestinations',
            'secondDestinations'
        ));
    }
    
    /**
     * Redirect to the domestic bundle builder page.
     */
    public function domestic()
    {
        return $this->builder('domestic');
    }
    
    /**
     * Redirect to the international bundle builder page.
     */
    public function international()
    {
        return $this->builder('international');
    }
    
    /**
     * Redirect to the combination bundle builder page.
     */
    public function combination()
    {
        return $this->builder('combination');
    }
    
    /**
     * Build the custom bundle based on selected destinations.
     */
    public function build(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'bundle_type' => 'required|string|in:domestic,international,combination',
                'price' => 'required|numeric',
                'first_destination' => 'required|string',
                'second_destination' => 'required|string',
            ]);
            
            // Ensure destinations are different
            if ($validated['first_destination'] === $validated['second_destination']) {
                return back()->withErrors(['error' => 'Please select two different destinations']);
            }
            
            // Create bundle object
            $bundle = new \stdClass();
            $bundle->type = $validated['bundle_type'];
            $bundle->price = $validated['price'];
            $bundle->destinations = [];
            
            // Create destinations based on type
            if ($bundle->type === 'domestic') {
                // Both destinations are domestic
                $bundle->destinations = $this->createDestinationDetails(
                    $validated['first_destination'], 
                    $validated['second_destination'], 
                    'domestic'
                );
                
            } elseif ($bundle->type === 'international') {
                // Both destinations are international
                $bundle->destinations = $this->createDestinationDetails(
                    $validated['first_destination'], 
                    $validated['second_destination'], 
                    'international'
                );
                
            } elseif ($bundle->type === 'combination') {
                // First is domestic, second is international
                $firstDestination = $this->getDestinationDetails($validated['first_destination'], 'domestic');
                $secondDestination = $this->getDestinationDetails($validated['second_destination'], 'international');
                
                $bundle->destinations = [$firstDestination, $secondDestination];
            }
            
            // Add extras to the bundle
            $bundle->extras = $this->getBundleExtras($bundle->type);
            


            $whyChooseUs = WhyChooseUs::where('active', true)
            ->orderBy('sort_order')
            ->get();

            // Return the bundle summary view
            return view('custom-bundles.custom-bundle-summary', compact('bundle','whyChooseUs'));
            
        } catch (\Exception $e) {
            Log::error('Custom bundle build error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'An error occurred while creating your custom bundle.']);
        }
    }
    
    /**
     * Get domestic destinations.
     */
    private function getDomesticDestinations()
    {
        return Destination::where('destination_type', 'domestic')
            ->where('display_in_custom_bundles', true)
            ->get();
    }
    
    /**
     * Get international destinations.
     */
    private function getInternationalDestinations()
    {
        return Destination::where('destination_type', 'international')
            ->where('display_in_custom_bundles', true)
            ->get();
    }
    
    /**
     * Create destination details for the bundle.
     */
    private function createDestinationDetails($first, $second, $type)
    {
        $firstDestination = $this->getDestinationDetails($first, $type);
        $secondDestination = $this->getDestinationDetails($second, $type);
        
        return [$firstDestination, $secondDestination];
    }
    
    /**
     * Get details for a specific destination.
     */
    private function getDestinationDetails($destinationSlug, $type = null)
    {
        // Try to find the destination in the database
        $searchTerm = str_replace(['-', '_'], ' ', $destinationSlug);
        
        $destination = Destination::where('destination_type', $type)
            ->where(function($query) use ($searchTerm, $destinationSlug) {
                $query->where('id', $destinationSlug)
                    ->orWhere('name', 'like', "%$searchTerm%")
                    ->orWhere('location', 'like', "%$searchTerm%");
            })
            ->first();

        if ($destination) {
            // Ensure included_items is an array
            $included_items = [];
            if (isset($destination->included_items)) {
                if (is_string($destination->included_items)) {
                    // Try to decode JSON string to array
                    $included_items = json_decode($destination->included_items, true) ?: [];
                } elseif (is_array($destination->included_items)) {
                    $included_items = $destination->included_items;
                }
            }
            
            // Convert destination properties to array
            return [
                'name' => $destination->name . ', ' . $destination->location,
                'image' => $destination->main_image,
                'description' => $destination->description,
                'gallery' => $destination->gallery ?: [],
                'details' => [
                    'stay' => $included_items[0] ?? null,
                    'accommodation' => $included_items[1] ?? null,
                    'included' => array_slice($included_items, 2) ?: []
                ]
            ];
        }
        
        // If no destination is found, return an empty structure
        return [
            'name' => '',
            'image' => '',
            'description' => '',
            'gallery' => [],
            'details' => [
                'stay' => null,
                'accommodation' => null,
                'included' => []
            ]
        ];
    }
    
    /**
     * Get extra features for the bundle.
     */
    private function getBundleExtras($type)
    {
        try {
            if (Schema::hasTable('bundle_types')) {
                $bundleTypeId = DB::table('bundle_types')
                    ->where('slug', $type)
                    ->value('id');
                
                if ($bundleTypeId && Schema::hasTable('bundle_extras')) {
                    $extras = DB::table('bundle_extras')
                        ->where('bundle_id', $bundleTypeId)
                        ->get();
                    
                    if ($extras->count() > 0) {
                        return $extras->map(function($extra) {
                            return [
                                'name' => $extra->title ?? $extra->name ?? '',
                                'description' => $extra->description ?? '',
                                'duration' => $extra->duration ?? ''
                            ];
                        })->toArray();
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Error getting bundle extras: ' . $e->getMessage());
        }
        
        return [];
    }
}