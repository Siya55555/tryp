<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Bundle;
use App\Models\Admin\Destination;
use App\Models\Admin\BundleExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BundleController extends Controller
{
    public function index(Request $request)
    {
        $query = Bundle::query();
        
        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('short_description', 'like', '%' . $search . '%');
            });
        }
        
        // Apply price range filter
        if ($request->has('min_price') && !empty($request->min_price)) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && !empty($request->max_price)) {
            $query->where('price', '<=', $request->max_price);
        }
        
        $bundles = $query->with('destinations')->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.bundles.index', compact('bundles'));
    }

    public function create()
    {
        return view('admin.bundles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:bundles',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'card_image' => 'required_without:image_urls|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image' => 'required_without:image_urls|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_main_image' => 'required_without:image_urls|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images' => 'required_without:image_urls|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_urls' => 'nullable|string',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string',
        ]);
        
        // Process images
        $cardImage = null;
        $heroImage = null;
        $galleryMainImage = null;
        $gallery = [];
        
        // Handle uploaded images
        if ($request->hasFile('card_image')) {
            $image = $request->file('card_image');
            $filename = 'card_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/bundle_images'), $filename);
            $cardImage = 'storage/bundle_images/' . $filename;
        }
        
        if ($request->hasFile('hero_image')) {
            $image = $request->file('hero_image');
            $filename = 'hero_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/bundle_images'), $filename);
            $heroImage = 'storage/bundle_images/' . $filename;
        }
        
        if ($request->hasFile('gallery_main_image')) {
            $image = $request->file('gallery_main_image');
            $filename = 'gallery_main_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/bundle_images'), $filename);
            $galleryMainImage = 'storage/bundle_images/' . $filename;
        }
        
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $filename = 'gallery_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/bundle_images'), $filename);
                $gallery[] = 'storage/bundle_images/' . $filename;
            }
        }
        
        // Handle image URLs if no files were uploaded
        if (empty($cardImage) && empty($heroImage) && empty($galleryMainImage) && empty($gallery)) {
            $imageUrls = explode("\n", $request->image_urls);
            $imageUrls = array_map('trim', $imageUrls);
            $imageUrls = array_filter($imageUrls);
            
            if (count($imageUrls) >= 3) {
                $cardImage = $imageUrls[0];
                $heroImage = $imageUrls[1];
                $galleryMainImage = $imageUrls[2];
                
                for ($i = 3; $i < count($imageUrls); $i++) {
                    $gallery[] = $imageUrls[$i];
                }
            }
        }
        
        // Create the bundle
        $bundle = Bundle::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'rating' => $request->rating ?? 0,
            'reviews_count' => $request->reviews_count ?? 0,
            'card_image' => $cardImage,
            'hero_image' => $heroImage,
            'gallery_main_image' => $galleryMainImage,
            'gallery' => $gallery,
            'features' => $request->features,
        ]);
        
        return redirect()->route('admin.bundles.index')->with('success', 'Vacation bundle created successfully!');
    }

    public function edit(Bundle $bundle)
    {
        return view('admin.bundles.edit', compact('bundle'));
    }

    public function update(Request $request, Bundle $bundle)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:bundles,slug,' . $bundle->id,
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'card_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_urls' => 'nullable|string',
            'features' => 'required|array|min:1',
            'features.*' => 'required|string',
        ]);
        
        // Process images
        $cardImage = $bundle->card_image;
        $heroImage = $bundle->hero_image;
        $galleryMainImage = $bundle->gallery_main_image;
        $gallery = $bundle->gallery;
        
        // Handle uploaded images
        if ($request->hasFile('card_image')) {
            // Delete old image if it's a local file
            if (Str::startsWith($cardImage, 'storage/bundle_images/')) {
                @unlink(public_path($cardImage));
            }
            
            $image = $request->file('card_image');
            $filename = 'card_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/bundle_images'), $filename);
            $cardImage = 'storage/bundle_images/' . $filename;
        }
        
        if ($request->hasFile('hero_image')) {
            // Delete old image if it's a local file
            if (Str::startsWith($heroImage, 'storage/bundle_images/')) {
                @unlink(public_path($heroImage));
            }
            
            $image = $request->file('hero_image');
            $filename = 'hero_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/bundle_images'), $filename);
            $heroImage = 'storage/bundle_images/' . $filename;
        }
        
        if ($request->hasFile('gallery_main_image')) {
            // Delete old image if it's a local file
            if (Str::startsWith($galleryMainImage, 'storage/bundle_images/')) {
                @unlink(public_path($galleryMainImage));
            }
            
            $image = $request->file('gallery_main_image');
            $filename = 'gallery_main_' . time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/bundle_images'), $filename);
            $galleryMainImage = 'storage/bundle_images/' . $filename;
        }
        
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images if they're local files
            if (is_array($gallery)) {
                foreach ($gallery as $oldImage) {
                    if (Str::startsWith($oldImage, 'storage/bundle_images/')) {
                        @unlink(public_path($oldImage));
                    }
                }
            }
            
            $gallery = [];
            foreach ($request->file('gallery_images') as $index => $image) {
                $filename = 'gallery_' . time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/bundle_images'), $filename);
                $gallery[] = 'storage/bundle_images/' . $filename;
            }
        }
        
        // Handle image URLs if provided
        if ($request->filled('image_urls')) {
            $imageUrls = explode("\n", $request->image_urls);
            $imageUrls = array_map('trim', $imageUrls);
            $imageUrls = array_filter($imageUrls);
            
            if (count($imageUrls) >= 3) {
                // Delete old images if they're local files
                if (Str::startsWith($cardImage, 'storage/bundle_images/')) {
                    @unlink(public_path($cardImage));
                }
                if (Str::startsWith($heroImage, 'storage/bundle_images/')) {
                    @unlink(public_path($heroImage));
                }
                if (Str::startsWith($galleryMainImage, 'storage/bundle_images/')) {
                    @unlink(public_path($galleryMainImage));
                }
                if (is_array($gallery)) {
                    foreach ($gallery as $oldImage) {
                        if (Str::startsWith($oldImage, 'storage/bundle_images/')) {
                            @unlink(public_path($oldImage));
                        }
                    }
                }
                
                $cardImage = $imageUrls[0];
                $heroImage = $imageUrls[1];
                $galleryMainImage = $imageUrls[2];
                
                $gallery = [];
                for ($i = 3; $i < count($imageUrls); $i++) {
                    $gallery[] = $imageUrls[$i];
                }
            }
        }
        
        // Update the bundle
        $bundle->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'original_price' => $request->original_price,
            'rating' => $request->rating ?? $bundle->rating,
            'reviews_count' => $request->reviews_count ?? $bundle->reviews_count,
            'card_image' => $cardImage,
            'hero_image' => $heroImage,
            'gallery_main_image' => $galleryMainImage,
            'gallery' => $gallery,
            'features' => $request->features,
        ]);
        
        return redirect()->route('admin.bundles.index')->with('success', 'Vacation bundle updated successfully!');
    }

    public function destroy(Bundle $bundle)
    {
        // Delete images if they're local files
        if (Str::startsWith($bundle->card_image, 'storage/bundle_images/')) {
            @unlink(public_path($bundle->card_image));
        }
        if (Str::startsWith($bundle->hero_image, 'storage/bundle_images/')) {
            @unlink(public_path($bundle->hero_image));
        }
        if (Str::startsWith($bundle->gallery_main_image, 'storage/bundle_images/')) {
            @unlink(public_path($bundle->gallery_main_image));
        }
        if (is_array($bundle->gallery)) {
            foreach ($bundle->gallery as $image) {
                if (Str::startsWith($image, 'storage/bundle_images/')) {
                    @unlink(public_path($image));
                }
            }
        }
        
        // Delete destinations and extras (they will be cascaded due to foreign key constraints)
        
        $bundle->delete();
        
        return redirect()->route('admin.bundles.index')->with('success', 'Vacation bundle deleted successfully!');
    }
}