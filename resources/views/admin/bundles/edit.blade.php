@extends('layouts.admin')

@section('title', 'Edit Vacation Bundle')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Vacation Bundle</h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.bundles.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
            
            <a href="{{ route('bundles.show', $bundle->slug) }}" target="_blank" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                View on Site
            </a>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form method="POST" action="{{ route('admin.bundles.update', $bundle->id) }}" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Basic Information</h2>
                </div>
                
                <!-- Name -->
                <div class="col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $bundle->name) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Slug -->
                <div class="col-span-2">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1">Slug <span class="text-red-500">*</span></label>
                    <div class="flex">
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $bundle->slug) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <button type="button" id="generateSlug" class="ml-2 inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Generate
                        </button>
                    </div>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Short Description -->
                <div class="col-span-2">
                    <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Short Description <span class="text-red-500">*</span></label>
                    <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $bundle->short_description) }}" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('short_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Full Description <span class="text-red-500">*</span></label>
                    <textarea name="description" id="description" rows="5" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('description', $bundle->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price <span class="text-red-500">*</span></label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" name="price" id="price" min="0" step="0.01" value="{{ old('price', $bundle->price) }}" required class="block w-full pl-7 pr-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">USD</span>
                        </div>
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Original Price -->
                <div>
                    <label for="original_price" class="block text-sm font-medium text-gray-700 mb-1">Original Price <span class="text-red-500">*</span></label>
                    <div class="relative mt-1 rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">$</span>
                        </div>
                        <input type="number" name="original_price" id="original_price" min="0" step="0.01" value="{{ old('original_price', $bundle->original_price) }}" required class="block w-full pl-7 pr-12 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <span class="text-gray-500 sm:text-sm">USD</span>
                        </div>
                    </div>
                    @error('original_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Rating -->
                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
                    <input type="number" name="rating" id="rating" min="0" max="5" step="0.1" value="{{ old('rating', $bundle->rating) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('rating')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Reviews Count -->
                <div>
                    <label for="reviews_count" class="block text-sm font-medium text-gray-700 mb-1">Reviews Count</label>
                    <input type="number" name="reviews_count" id="reviews_count" min="0" value="{{ old('reviews_count', $bundle->reviews_count) }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('reviews_count')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 mt-4">Current Images</h2>
                </div>
                
                <!-- Current Images Display -->
                <div class="col-span-2 grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-1">Card Image</p>
                        <img 
                        src="{{ filter_var($bundle->card_image, FILTER_VALIDATE_URL) ? $bundle->card_image : asset($bundle->card_image) }}" alt="{{ $bundle->name }}"

                        
                        class="h-40 w-full object-cover rounded">
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-1">Hero Image</p>
                        <img 
                        src="{{ filter_var($bundle->hero_image, FILTER_VALIDATE_URL) ? $bundle->hero_image : asset($bundle->hero_image) }}" alt="Hero Image"
                        
                        class="h-40 w-full object-cover rounded">
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-1">Gallery Main Image</p>
                        <img 
                        src="{{ filter_var($bundle->gallery_main_image, FILTER_VALIDATE_URL) ? $bundle->gallery_main_image : asset($bundle->gallery_main_image) }}" alt="gallery_main_image"
                        
                        class="h-40 w-full object-cover rounded">
                    </div>
                    
                    <!-- Gallery Images -->
                    @if(is_array($bundle->gallery) && count($bundle->gallery) > 0)
                        <div>
                            <p class="text-sm font-medium text-gray-700 mb-1">Gallery Images ({{ count($bundle->gallery) }})</p>
                            <div class="flex overflow-x-auto space-x-2 pb-2">
                                @foreach($bundle->gallery as $galleryImage)
                                    <img 
                                    
                                    src="{{ filter_var($galleryImage, FILTER_VALIDATE_URL) ? $galleryImage : asset($galleryImage) }}" alt="Gallery Image"

                                    class="h-40 w-32 flex-shrink-0 object-cover rounded">
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 mt-4">Replace Images</h2>
                </div>
                
                <!-- Card Image -->
                <div>
                    <label for="card_image" class="block text-sm font-medium text-gray-700 mb-1">Card Image</label>
                    <div class="flex items-center">
                        <input type="file" name="card_image" id="card_image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Card thumbnail used in listings (recommended size: 600x400px)</p>
                    @error('card_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Hero Image -->
                <div>
                    <label for="hero_image" class="block text-sm font-medium text-gray-700 mb-1">Hero Image</label>
                    <div class="flex items-center">
                        <input type="file" name="hero_image" id="hero_image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Large banner image for detail page (recommended size: 1920x800px)</p>
                    @error('hero_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Gallery Main Image -->
                <div>
                    <label for="gallery_main_image" class="block text-sm font-medium text-gray-700 mb-1">Gallery Main Image</label>
                    <div class="flex items-center">
                        <input type="file" name="gallery_main_image" id="gallery_main_image" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Featured image in the gallery (recommended size: 1200x800px)</p>
                    @error('gallery_main_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Gallery Images -->
                <div class="col-span-2">
                    <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-1">Gallery Images</label>
                    <div class="flex items-center">
                        <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Select multiple images for the gallery (recommended size: 1200x800px). Uploading new images will replace the existing gallery.</p>
                    @error('gallery_images')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('gallery_images.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Alternative: Image URLs -->
                <div class="col-span-2">
                    <p class="block text-sm font-medium text-gray-700 mb-1">Or enter image URLs to replace all images (one per line):</p>
                    <textarea name="image_urls" rows="5" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('image_urls') }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Format: card_image, hero_image, gallery_main_image, gallery_image1, gallery_image2, ...</p>
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 mt-4">Features</h2>
                </div>
                
                <!-- Features -->
                <div class="col-span-2" id="features-container">
                    <label for="features" class="block text-sm font-medium text-gray-700 mb-1">Features <span class="text-red-500">*</span></label>
                    
                    <div class="space-y-2">
                        @if(is_array($bundle->features) && count($bundle->features) > 0)
                            @foreach($bundle->features as $index => $feature)
                                <div class="feature-input flex items-center">
                                    <input type="text" name="features[]" value="{{ $feature }}" placeholder="Enter a feature" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <button type="button" class="remove-feature ml-2 text-red-500 hover:text-red-700" {{ count($bundle->features) > 1 ? '' : 'style=display:none;' }}>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="feature-input flex items-center">
                                <input type="text" name="features[]" placeholder="Enter a feature" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <button type="button" class="remove-feature ml-2 text-red-500 hover:text-red-700" style="display: none;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    
                    <button type="button" id="add-feature" class="mt-2 inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Feature
                    </button>
                    
                    @error('features')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('features.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 mt-4">Destinations</h2>
                    <p class="text-sm text-gray-600 mb-2">Current destinations: {{ $bundle->destinations->count() }}</p>
                    <a href="{{ route('admin.destinations.create', ['bundle_id' => $bundle->id]) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Manage Destinations
                    </a>
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 mt-4">Extras</h2>
                    <p class="text-sm text-gray-600 mb-2">Current extras: {{ $bundle->extras->count() }}</p>
                    <a href="{{ route('admin.bundle-extras.create', ['bundle_id' => $bundle->id]) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Manage Extras
                    </a>
                </div>
                
                <div class="col-span-2 border-t border-gray-200 pt-6 mt-4">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Update Bundle
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
        // Slug generation
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        const generateSlugButton = document.getElementById('generateSlug');
        
        generateSlugButton.addEventListener('click', function() {
            if (nameInput.value) {
                slugInput.value = nameInput.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-')
                    .trim();
            }
        });
        
        // Features dynamic fields
        const addFeatureButton = document.getElementById('add-feature');
        const featuresContainer = document.getElementById('features-container').querySelector('.space-y-2');
        
        addFeatureButton.addEventListener('click', function() {
            const featureInputs = document.querySelectorAll('.feature-input');
            
            // Show remove buttons if there's more than one feature
            if (featureInputs.length > 0) {
                document.querySelectorAll('.remove-feature').forEach(button => {
                    button.style.display = 'block';
                });
            }
            
            // Create new feature input
            const newFeature = document.createElement('div');
            newFeature.className = 'feature-input flex items-center';
            newFeature.innerHTML = `
                <input type="text" name="features[]" placeholder="Enter a feature" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                <button type="button" class="remove-feature ml-2 text-red-500 hover:text-red-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            `;
            
            featuresContainer.appendChild(newFeature);
            
            // Add event listener to the new remove button
            newFeature.querySelector('.remove-feature').addEventListener('click', function() {
                newFeature.remove();
                
                // Hide remove buttons if there's only one feature left
                const remainingFeatures = document.querySelectorAll('.feature-input');
                if (remainingFeatures.length === 1) {
                    document.querySelector('.remove-feature').style.display = 'none';
                }
            });
        });
        
        // Add event listeners to existing remove buttons
        document.querySelectorAll('.remove-feature').forEach(button => {
            button.addEventListener('click', function() {
                button.closest('.feature-input').remove();
                
                // Hide remove buttons if there's only one feature left
                const remainingFeatures = document.querySelectorAll('.feature-input');
                if (remainingFeatures.length === 1) {
                    document.querySelector('.remove-feature').style.display = 'none';
                }
            });
        });
    });
</script>
@endpush