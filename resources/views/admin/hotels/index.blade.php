@extends('layouts.admin')

@section('title', 'Hotels')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Hotels</h1>
        <a href="{{ route('admin.hotels.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            New Hotel
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Destination</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amenities</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($hotels as $hotel)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $photos = is_array($hotel->photos) ? $hotel->photos : (json_decode($hotel->photos, true) ?? []);
                            @endphp
                            @if(!empty($photos))
                                <img src="{{ Storage::url($photos[0]) }}" alt="Hotel Photo" class="w-16 h-16 object-cover rounded shadow">
                            @else
                                <span class="text-gray-400">No photo</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $hotel->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $hotel->destination->name ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $hotel->address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $amenities = is_array($hotel->amenities) ? $hotel->amenities : (json_decode($hotel->amenities, true) ?? []);
                            @endphp
                            @if(!empty($amenities))
                                <div class="flex flex-wrap">
                                    @foreach($amenities as $amenity)
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs mr-2 mb-1">{{ $amenity }}</span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($hotel->status) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                            <form method="POST" action="{{ route('admin.hotels.destroy', $hotel->id) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this hotel?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">No hotels found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $hotels->links() }}</div>
</div>
@endsection 