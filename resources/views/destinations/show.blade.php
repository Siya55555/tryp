@extends('layouts.app')

@section('title', $destination->name . ' - ' . $destination->location)

@section('content')
<!-- Destination Hero -->
<section class="relative pt-24 pb-24 text-white">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ filter_var($destination->main_image, FILTER_VALIDATE_URL) ? $destination->main_image : asset($destination->main_image) }}');">
        @if(count($destination->gallery) > 0)
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ filter_var($destination->gallery[0], FILTER_VALIDATE_URL) ? $destination->gallery[0] : asset($destination->gallery[0]) }}');"></div>
        @endif
        <!-- Dynamic overlay using CSS variables -->
        <div class="absolute inset-0 bg-gradient-to-t from-teal-500/90 to-primary-600/30 " style="opacity: 0.6"></div>
    </div>
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl md:text-5xl font-bold mb-2 drop-shadow-lg">{{ $destination->name }}</h1>
            <p class="text-xl opacity-90 mb-6 drop-shadow-md">{{ $destination->location }}</p>
            
            <div class="inline-block px-6 py-2 bg-yellow-500 rounded-full text-white font-semibold shadow-lg">
                @if($destination->bundle)
                    Part of {{ $destination->bundle->name }} Bundle
                @else
                    Featured Destination
                @endif
            </div>
        </div>
    </div>
    
    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 right-0 w-full" style="z-index: 1;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none" style="width: 100%; height: 120px; display: block;">
            <path fill="#ffffff" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

<!-- Main Content -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Left Column - Main Content -->
            <div class="lg:w-2/3">
                <!-- Main Image -->
                <div class="mb-8 rounded-2xl overflow-hidden shadow-lg h-96">
                    <img 
                        src="{{ filter_var($destination->main_image, FILTER_VALIDATE_URL) ? $destination->main_image : asset($destination->main_image) }}" 
                        alt="{{ $destination->name }}"
                        class="w-full h-full object-cover"
                    >
                </div>
                
                <!-- Description -->
                <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">About {{ $destination->name }}</h2>
                    <div class="prose max-w-none text-gray-600">
                        {{ $destination->description }}
                    </div>
                </div>
                
                <!-- Gallery -->
                @if(count($destination->gallery) > 0)
                <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Gallery</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($destination->gallery as $image)
                            <div class="aspect-w-4 aspect-h-3 rounded-lg overflow-hidden">
                                <img 
                                    src="{{ filter_var($image, FILTER_VALIDATE_URL) ? $image : asset($image) }}" 
                                    alt="{{ $destination->name }} gallery image"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                                >
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Restrictions -->
                @if($destination->restrictions)
                <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Restrictions & Important Information</h2>
                    <div class="prose max-w-none text-gray-600">
                        {{ $destination->restrictions }}
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Right Column - Sidebar -->
            <div class="lg:w-1/3">
                <!-- What's Included -->
                <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">What's Included</h2>
                    <ul class="space-y-4">
                        @foreach($destination->included_items as $item)
                            <li class="flex items-start">
                                <svg class="h-6 w-6 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Hotels Section -->
                @php
                    $hotels = \App\Models\Hotel::where('destination_id', $destination->id)->where('status', 'active')->get();
                @endphp
                @if($hotels->count())
                <div class="bg-white rounded-2xl shadow-md p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Hotels at this Destination</h2>
                    <div class="space-y-6">
                        @foreach($hotels as $hotel)
                            <div class="flex items-center space-x-4">
                                @php
                                    $photos = is_array($hotel->photos) ? $hotel->photos : (json_decode($hotel->photos, true) ?: []);
                                    $photo = $photos[0] ?? 'https://via.placeholder.com/100x100?text=Hotel';
                                @endphp
                                <img src="{{ $photo }}" alt="{{ $hotel->name }}" class="w-20 h-20 object-cover rounded">
                                <div>
                                    <div class="font-bold text-lg text-blue-700">
                                        <a href="{{ route('hotels.show', $hotel->id) }}">{{ $hotel->name }}</a>
                                    </div>
                                    <div class="text-gray-600 text-sm mb-1">{{ $hotel->address }}</div>
                                    <div class="text-gray-700 text-sm">{{ Str::limit($hotel->description, 60) }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('hotels.index', $destination->id) }}" class="text-blue-600 hover:underline">View all hotels for this destination &rarr;</a>
                    </div>
                </div>
                @endif
                
                <!-- Bundle Information (if part of a bundle) -->
                @if($destination->bundle)                <div class="bg-gradient-to-r from-primary-50 to-indigo-50 rounded-2xl shadow-md p-8 mb-8 relative overflow-hidden bundle-shine">
                    <div class="relative z-10">
                        <h2 class="text-2xl font-bold text-primary-800 mb-2">Part of a Bundle</h2>
                        <p class="text-gray-700 mb-4">This destination is part of our {{ $destination->bundle->name }} package.</p>
                        
                        <div class="bg-white p-4 rounded-lg mb-4 shadow-sm">
                            <div class="text-sm text-gray-500">Starting at</div>
                            <div class="text-3xl font-bold text-primary-700">${{ $destination->bundle->price }}</div>
                            <div class="text-sm text-gray-500">per person</div>
                        </div>
                          <a href="{{ route('bundles.show', $destination->bundle->slug) }}" class="block w-full text-center py-3 bg-gradient-to-r from-teal-500 to-indigo-700 text-white rounded-full font-semibold hover:from-primary-700 hover:to-indigo-800 transition-colors shadow-lg">
                            VIEW BUNDLE DETAILS
                        </a>
                    </div>
                </div>
                @endif
                
                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-md p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Inquire About This Destination</h2>
                    <form action="#" method="POST">
                        @csrf
                        <input type="hidden" name="destination_id" value="{{ $destination->id }}">
                          <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-medium mb-2">Your Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email Address</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500">
                        </div>
                        
                        <div class="mb-6">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500"></textarea>
                        </div>
                          <button type="submit" class="w-full py-3 bg-gradient-to-r from-teal-600 to-indigo-700 text-white rounded-full font-semibold hover:from-primary-700 hover:to-indigo-800 transition-colors shadow-lg">
                            SEND INQUIRY
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<x-testimonials :testimonials="$testimonials" />


<!-- Related Destinations (if applicable) -->
@if($destination->bundle && $destination->bundle->destinations->count() > 1)
<section class="py-16">
    <div class="container mx-auto px-4">        <h2 class="text-3xl font-bold text-primary-800 mb-12 text-center">
            <span class="relative inline-block">
                OTHER DESTINATIONS IN THIS BUNDLE
                <span class="absolute bottom-0 left-0 w-full h-1 bg-yellow-400"></span>
            </span>
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($destination->bundle->destinations as $relatedDestination)
                @if($relatedDestination->id != $destination->id)
                    <!-- Destination Card -->
                    <div class="destination-card bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="relative h-64">
                            <img 
                                src="{{ filter_var($relatedDestination->main_image, FILTER_VALIDATE_URL) ? $relatedDestination->main_image : asset($relatedDestination->main_image) }}" 
                                alt="{{ $relatedDestination->name }}"
                                class="w-full h-full object-cover"
                            >                            <div class="absolute top-0 left-0 page-title-bg text-white px-4 py-2 rounded-br-lg font-medium">
                                {{ $relatedDestination->name }}, {{ $relatedDestination->location }}
                            </div>
                            <div class="absolute bottom-0 left-0 w-full">
                                <div class="bg-gradient-to-t from-black to-transparent text-white p-4">
                                    <div class="font-semibold text-lg">{{ $relatedDestination->name }}</div>
                                    <div class="text-sm">{{ $relatedDestination->location }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-6 line-clamp-3">{{ \Illuminate\Support\Str::limit($relatedDestination->description, 100) }}</p>
                              <a href="{{ route('destinations.show', $relatedDestination->id) }}" class="block w-full text-center py-3 bg-gradient-to-r from-primary-600 to-indigo-700 text-white rounded-full font-semibold hover:from-primary-700 hover:to-indigo-800 transition-colors shadow-lg">
                                VIEW DETAILS
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection