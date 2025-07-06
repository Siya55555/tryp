@extends('layouts.admin')

@section('title', 'Edit Hotel')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Hotel</h1>
        <a href="{{ route('admin.hotels.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form method="POST" action="{{ route('admin.hotels.update', $hotel->id) }}" class="p-6" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="destination_id" class="block text-sm font-medium text-gray-700 mb-1">Destination <span class="text-red-500">*</span></label>
                    <select name="destination_id" id="destination_id" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Select Destination</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ old('destination_id', $hotel->destination_id) == $destination->id ? 'selected' : '' }}>{{ $destination->name }}</option>
                        @endforeach
                    </select>
                    @error('destination_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Hotel Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $hotel->name) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Address <span class="text-red-500">*</span></label>
                    <input type="text" name="address" id="address" value="{{ old('address', $hotel->address) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description', $hotel->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="amenities" class="block text-sm font-medium text-gray-700 mb-1">Amenities</label>
                    <input type="text" id="amenities-input" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Type an amenity and press Enter">
                    <div id="amenities-tags" class="flex flex-wrap mt-2"></div>
                    <input type="hidden" name="amenities" id="amenities" value="{{ old('amenities', is_array($hotel->amenities) ? implode(',', $hotel->amenities) : (is_string($hotel->amenities) ? $hotel->amenities : '')) }}">
                    @error('amenities')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-2">
                    <label for="photos" class="block text-sm font-medium text-gray-700 mb-1">Photos</label>
                    <input type="file" name="photos[]" id="photos" multiple accept="image/*" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <div class="flex flex-wrap mt-2">
                        @if(is_array($hotel->photos) || is_string($hotel->photos))
                            @foreach((is_array($hotel->photos) ? $hotel->photos : (json_decode($hotel->photos, true) ?? [])) as $photo)
                                <div class="mr-2 mb-2 relative">
                                    <img src="{{ Storage::url($photo) }}" alt="Hotel Photo" class="w-24 h-24 object-cover rounded shadow">
                                </div>
                            @endforeach
                        @endif
                    </div>
                    @error('photos')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="active" {{ old('status', $hotel->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $hotel->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg">Update Hotel</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('amenities-input');
        const tagsContainer = document.getElementById('amenities-tags');
        const hiddenInput = document.getElementById('amenities');
        let tags = [];

        // Load old value if present
        if (hiddenInput.value) {
            tags = hiddenInput.value.split(',').map(t => t.trim()).filter(Boolean);
            renderTags();
        }

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && input.value.trim() !== '') {
                e.preventDefault();
                addTag(input.value.trim());
                input.value = '';
            }
        });

        function addTag(tag) {
            if (!tags.includes(tag)) {
                tags.push(tag);
                renderTags();
            }
        }

        function removeTag(tag) {
            tags = tags.filter(t => t !== tag);
            renderTags();
        }

        function renderTags() {
            tagsContainer.innerHTML = '';
            tags.forEach(tag => {
                const tagEl = document.createElement('span');
                tagEl.className = 'bg-blue-100 text-blue-800 px-3 py-1 rounded-full mr-2 mb-2 flex items-center';
                tagEl.innerHTML = tag + ' <button type="button" class="ml-2 text-blue-500 hover:text-blue-700" onclick="this.parentNode.remove(); removeTag(\'' + tag + '\')">&times;</button>';
                tagsContainer.appendChild(tagEl);
            });
            hiddenInput.value = tags.join(',');
        }
        window.removeTag = removeTag;
    });
</script>
@endpush
@endsection 