@extends('layouts.app')

@section('title', 'Book Your Perfect Vacation')

@section('content')

    <!-- Hero Section with Search -->
    <!-- Hero Section with Search -->
<section class="hero-section min-h-screen flex items-center justify-center relative overflow-hidden" 
    @if(\App\Models\Admin\Setting::get('hero_bg_image'))
        style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.3)), url('{{ filter_var(\App\Models\Admin\Setting::get('hero_bg_image'), FILTER_VALIDATE_URL) ? \App\Models\Admin\Setting::get('hero_bg_image') : asset(\App\Models\Admin\Setting::get('hero_bg_image')) }}'); background-size: cover; background-position: center;"
    @else
        class="hero-gradient" 
    @endif
>
    <div class="container mx-auto px-4 py-16 relative z-10">
        <div class="text-center text-white mb-12 max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 drop-shadow-lg">{{ \App\Models\Admin\Setting::get('hero_heading', 'Discover Your Perfect Getaway') }}</h1>
            <p class="text-xl md:text-2xl mb-8 drop-shadow-md">{{ \App\Models\Admin\Setting::get('hero_subheading', 'Explore exclusive vacation packages and create memories that last a lifetime') }}</p>
        </div>
        
        <div class="relative z-10 max-w-4xl mx-auto">
            <!-- Using the new search component -->
            @include('components.destination-search')
        </div>
    </div>
    
    <!-- Fixed wave at bottom of the section -->
    <div class="absolute bottom-0 left-0 right-0 w-full" style="z-index: 1;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none" style="width: 100%; height: 120px; display: block;">
            <path fill="#ffffff" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

    <!-- Stats Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-center text-center gap-8">
                <div class="w-full md:w-1/3 max-w-xs">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-2xl shadow-lg">
                        <div class="text-4xl font-bold text-blue-600 mb-2 stat-counter">665,245+</div>
                        <div class="text-gray-600 font-medium">Vacations Booked</div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 max-w-xs">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-2xl shadow-lg">
                        <div class="text-4xl font-bold text-blue-600 mb-2 stat-counter">91,000+</div>
                        <div class="text-gray-600 font-medium">Followers on Facebook</div>
                    </div>
                </div>
                <div class="w-full md:w-1/3 max-w-xs">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-2xl shadow-lg">
                        <div class="text-4xl font-bold text-blue-600 mb-2 stat-counter">45,000+</div>
                        <div class="text-gray-600 font-medium">5 Star Google Reviews!</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-deal-week  />




  <!--  POPULAR BUNDLES -->
<section class="py-16">    
    
<div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-blue-600 mb-12 text-center">
            <span class="relative inline-block">
                POPULAR BUNDLES
                <span class="absolute bottom-0 left-0 w-full h-1 bg-yellow-400"></span>
            </span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($bundles as $bundle)
                <!-- Destination Card -->
                <div class="destination-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative h-64">
                        <img 
                        
                        src="{{ filter_var($bundle->card_image, FILTER_VALIDATE_URL) ? $bundle->card_image : asset($bundle->card_image) }}" alt="{{ $bundle->name }}"

                        class="w-full h-full object-cover">
                        <div class="absolute top-0 left-0 bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-2 rounded-br-lg font-medium">
                            {{ $bundle->name }}, {{ $bundle->location }}
                        </div>
                        <div class="absolute top-0 right-0 bg-gradient-to-r from-yellow-500 to-yellow-600 text-white px-4 py-2 rounded-bl-lg">
                            <div class="text-xs">Starting At</div>
                            <div class="font-bold">${{ $bundle->price }}</div>
                        </div>
                        <div class="absolute bottom-0 left-0 w-full">
                            <div class="bg-gradient-to-t from-black to-transparent text-white p-4">
                                <div class="font-semibold text-lg">{{ $bundle->name }}</div>
                                <div class="text-sm">{{ $bundle->short_description }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="text-gray-600 mb-6 space-y-2">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $bundle->features[0] }}
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $bundle->features[1] }}
                            </li>
                        </ul>
                        
                        <a href="{{ route('bundles.show', $bundle->slug) }}" class="block w-full text-center py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-full font-semibold hover:from-blue-700 hover:to-indigo-800 transition-colors shadow-lg">
                            VIEW DEAL
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- View All Button -->
        <div class="text-center mt-12">
            <a href="{{ route('bundles.index') }}" class="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-full font-semibold hover:from-blue-700 hover:to-indigo-800 transition-colors shadow-lg">
                VIEW ALL BUNDLES
            </a>
        </div>
    </div>
</section>

   <!-- POPULAR DESTINATIONS -->
<section class="py-16 bg-gray-50">    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-blue-600 mb-12 text-center">
            <span class="relative inline-block">
                POPULAR DESTINATIONS
                <span class="absolute bottom-0 left-0 w-full h-1 bg-yellow-400"></span>
            </span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($destinations as $destination)
                <!-- Destination Card -->
                <div class="destination-card bg-white rounded-2xl shadow-lg overflow-hidden">
                    <div class="relative h-64">
                        <img 
                        src="{{ filter_var($destination->main_image, FILTER_VALIDATE_URL) ? $destination->main_image : asset($destination->main_image) }}" 
                        alt="{{ $destination->name }}"
                        class="w-full h-full object-cover">
                        <div class="absolute top-0 left-0 bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-2 rounded-br-lg font-medium">
                            {{ $destination->name }}, {{ $destination->location }}
                        </div>
                        <div class="absolute bottom-0 left-0 w-full">
                            <div class="bg-gradient-to-t from-black to-transparent text-white p-4">
                                <div class="font-semibold text-lg">{{ $destination->name }}</div>
                                <div class="text-sm">{{ $destination->location }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="text-gray-600 mb-6 space-y-2">
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
                        
                        <a href="{{ route('destinations.show', $destination->id) }}" class="block w-full text-center py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-full font-semibold hover:from-blue-700 hover:to-indigo-800 transition-colors shadow-lg">
                            VIEW DETAILS
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- View All Button -->
        <div class="text-center mt-12">
            <a href="{{ route('destinations.search', ['search' => '']) }}" class="inline-block px-8 py-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-full font-semibold hover:from-blue-700 hover:to-indigo-800 transition-colors shadow-lg">
                VIEW ALL DESTINATIONS
            </a>
        </div>
    </div>
</section>

   
<x-testimonials :testimonials="$testimonials" />
<x-why-travel :whyChooseUs="$whyChooseUs" />

<x-vacations-booked-counter   />
 

    
<style>
   
   .hero-section {
    position: relative;
}

.hero-gradient {
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=3273&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
    background-size: cover;
    background-position: center;
    position: relative;
}
</style>

@endsection

