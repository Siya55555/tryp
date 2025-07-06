@extends('layouts.app')

@section('title', 'Search Results for ' . $search)

@section('content')
<!-- Search Results Hero -->
<section class="relative pt-24 pb-24 text-white">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1488085061387-422e29b40080?q=80&w=3131&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); filter: brightness(0.6);">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900/70 to-indigo-900/70"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold mb-2 drop-shadow-lg">Destination Search Results</h1>
        </div>
        
    </div>
    
    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 right-0 w-full" style="z-index: 1;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none" style="width: 100%; height: 120px; display: block;">
            <path fill="#ffffff" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

<!-- Search Results -->
<section class="py-12">
    <div class="container mx-auto px-4">
        @if($destinations->count() > 0)
            <div class="mb-8">
                <p class="text-gray-600">Found {{ $destinations->total() }} destinations matching your search.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($destinations as $destination)
                    <!-- Destination Card -->
                    <div class="destination-card bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="relative h-64">
                            <img 
                                src="{{ filter_var($destination->main_image, FILTER_VALIDATE_URL) ? $destination->main_image : asset($destination->main_image) }}" 
                                alt="{{ $destination->name }}"
                                class="w-full h-full object-cover"
                            >
                            <div class="absolute top-0 left-0 bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-2 rounded-br-lg font-medium">
                                {{ $destination->name }}, {{ $destination->location }}
                            </div>
                            <div class="absolute bottom-0 left-0 w-full">
                                <div class="bg-gradient-to-t from-black to-transparent text-white p-4">
                                    <div class="font-semibold text-lg">{{ $destination->name }}</div>
                                    <div class="text-sm truncate">{{ $destination->location }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-6 line-clamp-3">{{ \Illuminate\Support\Str::limit($destination->description, 100) }}</p>
                            <div class="mb-5">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Included:</h4>
                                <ul class="text-gray-600 space-y-1">
                                @php
                                    $includedItems = [];
                                    if (is_array($destination->included_items)) {
                                        $includedItems = $destination->included_items;
                                    } elseif (is_string($destination->included_items) && !empty($destination->included_items)) {
                                        // Try to decode as JSON first
                                        $jsonItems = json_decode($destination->included_items, true);
                                        if (json_last_error() === JSON_ERROR_NONE && is_array($jsonItems)) {
                                            $includedItems = $jsonItems;
                                        } else {
                                            // If not valid JSON, try as comma-separated
                                            $includedItems = explode(',', $destination->included_items);
                                        }
                                    }
                                @endphp

                                @if(count($includedItems) > 0)
                                    @foreach(array_slice($includedItems, 0, 2) as $item)
                                        <li class="flex items-start">
                                            <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            {{ trim($item) }}
                                        </li>
                                    @endforeach
                                @endif
                                </ul>
                            </div>
                            
                            <a href="{{ route('destinations.show', $destination->id) }}" class="block w-full text-center py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-full font-semibold hover:from-blue-700 hover:to-indigo-800 transition-colors shadow-lg">
                                VIEW DETAILS
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="mt-12">
    {{ $destinations->appends(['search' => $search])->links('vendor.pagination.tailwind') }}
</div>
        @else
            <div class="text-center py-12">
                <div class="text-5xl text-gray-300 mb-4">
                    <i class="fas fa-search"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-700 mb-2">No destinations found</h3>
                <p class="text-gray-600 mb-8">We couldn't find any destinations matching "{{ $search }}".</p>
                <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-full font-medium hover:bg-blue-700 transition">
                    Back to Home
                </a>
            </div>
        @endif
    </div>
</section>
@endsection