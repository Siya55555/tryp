@extends('layouts.app')

@section('title', $hotel->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <a href="{{ route('hotels.index', $hotel->destination_id) }}" class="text-blue-600 hover:underline mb-4 inline-block">&larr; Back to Hotels in {{ $hotel->destination->name ?? 'Destination' }}</a>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                @php
                    $photos = is_array($hotel->photos) ? $hotel->photos : (json_decode($hotel->photos, true) ?: []);
                @endphp
                @if(count($photos))
                    <div class="mb-4">
                        <img src="{{ Storage::url($photos[0]) }}" alt="{{ $hotel->name }}" class="w-full h-64 object-cover rounded shadow">
                    </div>
                    @if(count($photos) > 1)
                        <div class="flex space-x-2 overflow-x-auto pb-2">
                            @foreach(array_slice($photos, 1) as $photo)
                                <img src="{{ Storage::url($photo) }}" alt="Gallery" class="h-20 w-32 object-cover rounded shadow">
                            @endforeach
                        </div>
                    @endif
                @else
                    <img src="https://via.placeholder.com/600x400?text=Hotel" alt="{{ $hotel->name }}" class="w-full h-64 object-cover rounded mb-4">
                @endif
            </div>
            <div>
                <div class="mb-2 text-sm text-gray-500">
                    Destination: <a href="{{ route('destinations.show', $hotel->destination->id) }}" class="text-blue-600 hover:underline">{{ $hotel->destination->name ?? 'Destination' }}</a>
                </div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $hotel->name }}</h1>
                <p class="text-gray-600 mb-2 flex items-center">
                    <svg class="h-5 w-5 text-blue-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    {{ $hotel->address }}
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($hotel->address) }}" target="_blank" class="ml-2 text-blue-500 hover:underline">View on Map</a>
                </p>
                <p class="text-gray-700 mb-4">{{ $hotel->description }}</p>
                <h2 class="text-xl font-semibold text-gray-800 mb-2">Amenities</h2>
                @php
                    $amenities = is_array($hotel->amenities) ? $hotel->amenities : (json_decode($hotel->amenities, true) ?: (is_string($hotel->amenities) ? explode(',', $hotel->amenities) : []));
                @endphp
                @if(count($amenities))
                    <div class="flex flex-wrap mb-4">
                        @foreach($amenities as $amenity)
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full mr-2 mb-2 text-sm">{{ trim($amenity) }}</span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 mb-4">No amenities listed.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 