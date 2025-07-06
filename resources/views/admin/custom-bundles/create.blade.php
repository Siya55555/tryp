@extends('layouts.admin')

@section('title', 'Create Bundle Type')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create Bundle Type</h1>
        <a href="{{ route('admin.custom-bundles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
            <i class="fas fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form action="{{ route('admin.custom-bundles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="p-6 space-y-6">
                <!-- Basic Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-600">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="e.g. Domestic"
                            onchange="generateSlug()">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug <span class="text-red-600">*</span></label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="e.g. domestic">
                        @error('slug')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        placeholder="Enter description of this bundle type">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price <span class="text-red-600">*</span></label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price') }}" required step="0.01" min="0"
                                class="w-full pl-7 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="0.00">
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center h-full pt-6">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="active" value="1" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" {{ old('active') ? 'checked' : '' }}>
                            <span class="ml-2 text-sm text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label for="features_text" class="block text-sm font-medium text-gray-700 mb-1">Features (one per line)</label>
                    <textarea name="features_text" id="features_text" rows="5"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        placeholder="Enter features, one per line">{{ old('features_text') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Enter each feature on a new line. For example: "Two 5 Day / 4 Night Stays"</p>
                    @error('features_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
<!-- After the Features textarea, before the submit button -->
<div class="col-span-2">
    <label class="block text-sm font-medium text-gray-700 mb-1">Image Options</label>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- File Upload -->
        <div>
            <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Upload Image <span class="text-red-600">*</span></label>
            <input type="file" name="image" id="image" accept="image/*" required
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- URL Input -->
        <div>
            <label for="image_url" class="block text-sm font-medium text-gray-700 mb-1">Or Enter Image URL</label>
            <input type="url" name="image_url" id="image_url" value="{{ old('image_url') }}" 
                placeholder="https://example.com/image.jpg"
                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
            @error('image_url')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <p class="mt-2 text-xs text-gray-500">You can either upload an image or provide an image URL</p>
</div>
            <!-- Submit Button -->
            <div class="px-6 py-4 bg-gray-50 text-right">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Create Bundle Type
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
        
        if (nameInput.value && !slugInput.value) {
            fetch('{{ route("admin.custom-bundles.generate-slug") }}?name=' + encodeURIComponent(nameInput.value))
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