@extends('layouts.admin')

@section('title', 'Edit Bundle Type')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Bundle Type</h1>
        <a href="{{ route('admin.custom-bundles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form action="{{ route('admin.custom-bundles.update', $bundleType) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $bundleType->name) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                        <div class="flex">
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $bundleType->slug) }}"
                                class="w-full rounded-l-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                required>
                            <button type="button" onclick="generateSlug()" 
                                class="px-4 py-2 bg-gray-100 text-gray-600 border border-l-0 border-gray-300 rounded-r-md hover:bg-gray-200">
                                Generate
                            </button>
                        </div>
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        >{{ old('description', $bundleType->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Base Price ($)</label>
                        <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $bundleType->price) }}"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            required>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <label class="flex items-center">
                            <input type="checkbox" name="active" value="1" 
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
                                {{ old('active', $bundleType->active) ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label for="features_text" class="block text-sm font-medium text-gray-700 mb-1">Features (one per line)</label>
                    <textarea name="features_text" id="features_text" rows="5"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        placeholder="Enter features, one per line">{{ old('features_text', is_array($bundleType->features) ? implode("\n", $bundleType->features) : '') }}</textarea>
                    @error('features_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
<!-- After the Features textarea -->
<div class="col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-1">Image Options</label>
    
    @if($bundleType->image)
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Current Image</label>
            <img src="{{ asset($bundleType->image) }}" 
                alt="{{ $bundleType->name }}" 
                class="h-48 w-auto object-cover rounded-lg border border-gray-200">
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- File Upload -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload New Image</label>
            <input type="file" name="image" id="image" accept="image/*" 
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- URL Input -->
        <div>
            <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1">Or Enter Image URL</label>
            <input type="url" name="image_url" id="image_url" 
                placeholder="https://example.com/image.jpg"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            @error('image_url')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        </div>
            <p class="mt-2 text-xs text-gray-500">You can either upload a new image or provide an image URL</p>
        </div>
        </div>

            <!-- Submit Button -->
            <div class="px-6 py-4 bg-gray-50 text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Update Bundle Type
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function generateSlug() {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        
        if (nameInput.value) {
            fetch(`{{ route('admin.custom-bundles.generate-slug') }}?name=${encodeURIComponent(nameInput.value)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.slug) {
                        slugInput.value = data.slug;
                    }
                })
                .catch(error => {
                    console.error('Error generating slug:', error);
                });
        }
    }
</script>
@endpush