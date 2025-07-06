@extends('layouts.app')

@section('title', 'Hotels in ' . $destination->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Hotels in {{ $destination->name }}</h1>
    @if($hotels->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($hotels as $hotel)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @php
                        $photos = is_array($hotel->photos) ? $hotel->photos : (json_decode($hotel->photos, true) ?: []);
                        $photo = $photos[0] ?? 'https://via.placeholder.com/400x250?text=Hotel';
                    @endphp
                    <img src="{{ $photo }}" alt="{{ $hotel->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-bold mb-2">
                            <a href="{{ route('hotels.show', $hotel->id) }}" class="text-blue-600 hover:underline">{{ $hotel->name }}</a>
                        </h2>
                        <p class="text-gray-600 mb-2">{{ $hotel->address }}</p>
                        <p class="text-gray-700 mb-4">{{ Str::limit($hotel->description, 100) }}</p>
                        <a href="{{ route('hotels.show', $hotel->id) }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white p-6 rounded shadow text-center text-gray-500">
            No hotels found for this destination.
        </div>
    @endif
</div>
@endsection 