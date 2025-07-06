@extends('layouts.admin')

@section('title', 'Edit Bundle Extra')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Bundle Extra</h1>
        <a href="{{ route('admin.bundles.edit', $bundleExtra->bundle_id) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Bundle
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form method="POST" action="{{ route('admin.bundle-extras.update', $bundleExtra->id) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Title -->
                <div class="col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $bundleExtra->title) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="4" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description', $bundleExtra->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
              
                
                <!-- Image Section -->
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
                    @if($bundleExtra->image)
                        <div class="mt-2 mb-4">
                            <img src="{{ asset($bundleExtra->image) }}" alt="{{ $bundleExtra->title }}" class="h-48 w-auto object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                    
                    <label class="block text-sm font-medium text-gray-700 mb-1">Image Options</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- File Upload -->
                        <div>
                            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload New Image</label>
                            <input type="file" name="image" id="image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL Input -->
                        <div>
                            <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1">Or Enter Image URL</label>
                            <input type="url" name="image_url" id="image_url" value="{{ old('image_url', $bundleExtra->image) }}" placeholder="https://example.com/image.jpg" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            @error('image_url')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <p class="mt-2 text-xs text-gray-500">You can either upload a new image or provide an image URL</p>
                </div>
                
                <div class="col-span-2 border-t border-gray-200 pt-6 mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Extra
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection