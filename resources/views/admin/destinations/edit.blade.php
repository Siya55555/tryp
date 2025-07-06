@extends('layouts.admin')

@section('title', 'Edit Destination')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Destination</h1>
        <a href="{{ route('admin.destinations.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form method="POST" action="{{ route('admin.destinations.update', $destination->id) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Basic Information</h2>
                </div>
                
                <!-- Bundle -->
                <div>
                    <label for="bundle_id" class="block text-sm font-medium text-gray-700 mb-1">Bundle <span class="text-red-500">*</span></label>
                    <select name="bundle_id" id="bundle_id" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Select Bundle</option>
                        @foreach($bundles as $bundle)
                            <option value="{{ $bundle->id }}" {{ old('bundle_id', $destination->bundle_id) == $bundle->id ? 'selected' : '' }}>{{ $bundle->name }}</option>
                        @endforeach
                    </select>
                    @error('bundle_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $destination->name) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Location -->
                <div class="col-span-2">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" id="location" value="{{ old('location', $destination->location) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="5" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description', $destination->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 mt-4">Images</h2>
                </div>
                
                <!-- Current Main Image -->
<div class="col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-1">Current Main Image</label>
    <div class="mt-1 mb-3">
        <img src="{{ $destination->main_image }}" alt="{{ $destination->name }}" class="h-48 w-auto object-cover rounded-lg border border-gray-200">
    </div>
    
    <!-- Main Image Update -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="main_image" class="block text-sm font-medium text-gray-700 mb-1">Upload New Main Image</label>
            <input type="file" name="main_image" id="main_image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>
        <div>
            <label for="main_image_url" class="block text-sm font-medium text-gray-700 mb-1">Or Enter Image URL</label>
            <input type="url" name="main_image_url" id="main_image_url" value="{{ old('main_image_url') }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
        </div>
    </div>
    <p class="mt-1 text-xs text-gray-500">You can either upload a file or provide an image URL</p>
    @error('main_image')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
    @error('main_image_url')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<!-- Current Gallery Images -->
<div class="col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-1">Current Gallery Images</label>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-1 mb-3">
        @php
            $galleryImages = is_array($destination->gallery) 
                ? $destination->gallery 
                : json_decode($destination->gallery ?? '[]');
        @endphp
        
        @foreach($galleryImages as $index => $image)
            <div class="relative group">
                <img src="{{ $image }}" alt="Gallery image {{ $index + 1 }}" class="h-32 w-full object-cover rounded-lg border border-gray-200">
                <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                    <input type="checkbox" name="remove_gallery[]" value="{{ $index }}" id="remove_gallery_{{ $index }}" class="mr-2">
                    <label for="remove_gallery_{{ $index }}" class="text-white text-sm cursor-pointer">Remove</label>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Gallery Images Update -->
    
    <!-- Gallery Images Update -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-1">Upload Gallery Images</label>
            <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>
        <div>
            <label for="gallery_image_urls" class="block text-sm font-medium text-gray-700 mb-1">Or Enter Image URLs (one per line)</label>
            <textarea name="gallery_image_urls" id="gallery_image_urls" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" placeholder="Enter image URLs, one per line"></textarea>
        </div>
    </div>
    <p class="mt-1 text-xs text-gray-500">You can either upload files or provide image URLs</p>
    @error('gallery_images')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
    @error('gallery_images.*')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
    @error('gallery_image_urls')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 mt-4">Included Items</h2>
                </div>
                
                <!-- Included Items -->
<div class="col-span-2" id="included-items-container">
    <label for="included_items" class="block text-sm font-medium text-gray-700 mb-1">Included Items <span class="text-red-500">*</span></label>
    
    <div class="space-y-2" id="included-items-list">
        @php
            $includedItems = is_array($destination->included_items) 
                ? $destination->included_items 
                : json_decode($destination->included_items ?? '[]');
        @endphp
        
        @foreach($includedItems as $index => $item)
            <div class="included-item flex items-center">
                <input type="text" name="included_items[]" value="{{ $item }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <button type="button" class="remove-item ml-2 text-red-500 hover:text-red-700" {{ count($includedItems) > 1 ? '' : 'style=display:none' }}>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
        @endforeach
    </div>
                    
                    <button type="button" id="add-item" class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Item
                    </button>
                    
                    @error('included_items')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('included_items.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Restrictions -->
                <div class="col-span-2">
                    <label for="restrictions" class="block text-sm font-medium text-gray-700 mb-1">Restrictions</label>
                    <textarea name="restrictions" id="restrictions" rows="3" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('restrictions', $destination->restrictions) }}</textarea>
                    @error('restrictions')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="col-span-2 border-t border-gray-200 pt-6 mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Destination
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Included Items dynamic fields
        const addItemButton = document.getElementById('add-item');
        const includedItemsList = document.getElementById('included-items-list');
        
        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.included-item').remove();
                
                // Hide remove buttons if there's only one item left
                const remainingItems = document.querySelectorAll('.included-item');
                if (remainingItems.length === 1) {
                    document.querySelector('.remove-item').style.display = 'none';
                }
            });
        });
        
        addItemButton.addEventListener('click', function() {
            const itemInputs = document.querySelectorAll('.included-item');
            
            // Show remove buttons if there's more than one item
            if (itemInputs.length > 0) {
                document.querySelectorAll('.remove-item').forEach(button => {
                    button.style.display = 'block';
                });
            }
            
            // Create new item input
            const newItem = document.createElement('div');
            newItem.className = 'included-item flex items-center';
            newItem.innerHTML = `
                <input type="text" name="included_items[]" placeholder="Enter an included item" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <button type="button" class="remove-item ml-2 text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            `;
            
            includedItemsList.appendChild(newItem);
            
            // Add event listener to the new remove button
            newItem.querySelector('.remove-item').addEventListener('click', function() {
                newItem.remove();
                
                // Hide remove buttons if there's only one item left
                const remainingItems = document.querySelectorAll('.included-item');
                if (remainingItems.length === 1) {
                    document.querySelector('.remove-item').style.display = 'none';
                }
            });
        });
    });
</script>
@endpush