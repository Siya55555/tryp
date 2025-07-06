@extends('layouts.admin')

@section('title', 'Edit Travel Package')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Travel Package</h1>
        <a href="{{ route('admin.travel-packages.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
            <i class="fas fa-arrow-left mr-2"></i> Back to Packages
        </a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <form action="{{ route('admin.travel-packages.update', $travelPackage) }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Package Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $travelPackage->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Package Type <span class="text-red-500">*</span></label>
                    <select name="type" id="type" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="">Select Type</option>
                        <option value="pro-traveler" {{ old('type', $travelPackage->type) == 'pro-traveler' ? 'selected' : '' }}>Pro Traveler</option>
                        <option value="expert-traveler" {{ old('type', $travelPackage->type) == 'expert-traveler' ? 'selected' : '' }}>Expert Traveler</option>
                        <option value="monster-traveler" {{ old('type', $travelPackage->type) == 'monster-traveler' ? 'selected' : '' }}>Monster Traveler</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label for="short_description" class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                <input type="text" name="short_description" id="short_description" value="{{ old('short_description', $travelPackage->short_description) }}" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                @error('short_description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>{{ old('description', $travelPackage->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price ($) <span class="text-red-500">*</span></label>
                    <input type="number" name="price" id="price" value="{{ old('price', $travelPackage->price) }}" min="0" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
                        <option value="active" {{ old('status', $travelPackage->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $travelPackage->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $travelPackage->sort_order) }}" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Package Image</label>
                @if($travelPackage->image)
                    <div class="mb-2">
                        <img src="{{ Storage::url($travelPackage->image) }}" alt="{{ $travelPackage->name }}" class="h-32 w-auto object-cover rounded-md">
                        <p class="text-xs text-gray-500 mt-1">Current image</p>
                    </div>
                @endif
                <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                <p class="text-xs text-gray-500 mt-1">Recommended size: 800x600px, max 2MB. Leave empty to keep current image.</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <div class="flex items-center mb-2">
                    <label class="text-sm font-medium text-gray-700">Package Features</label>
                    <button type="button" id="add-feature" class="ml-2 px-2 py-1 text-xs bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
                
                <div id="features-container" class="space-y-2">
                    @if($travelPackage->features && count($travelPackage->features) > 0)
                        @foreach($travelPackage->features as $feature)
                            <div class="feature-item flex items-center">
                                <input type="text" name="features[]" value="{{ $feature }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                <button type="button" class="remove-feature ml-2 px-2 py-2 text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="feature-item flex items-center">
                            <input type="text" name="features[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., 8 Day / 7 Night Trip">
                            <button type="button" class="remove-feature ml-2 px-2 py-2 text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    @endif
                </div>
                @error('features')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <div class="flex items-center">
                    <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $travelPackage->is_featured) ? 'checked' : '' }} class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_featured" class="ml-2 block text-sm text-gray-700">Featured Package (will be highlighted on the homepage)</label>
                </div>
                @error('is_featured')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    <i class="fas fa-save mr-2"></i> Update Package
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addFeatureBtn = document.getElementById('add-feature');
        const featuresContainer = document.getElementById('features-container');
        
        addFeatureBtn.addEventListener('click', function() {
            const featureItem = document.createElement('div');
            featureItem.className = 'feature-item flex items-center';
            featureItem.innerHTML = `
                <input type="text" name="features[]" class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., 8 Day / 7 Night Trip">
                <button type="button" class="remove-feature ml-2 px-2 py-2 text-red-500 hover:text-red-700">
                    <i class="fas fa-trash"></i>
                </button>
            `;
            featuresContainer.appendChild(featureItem);
            
            // Setup remove functionality for the new feature
            setupRemoveFeature(featureItem.querySelector('.remove-feature'));
        });
        
        // Setup remove functionality for existing features
        const removeButtons = document.querySelectorAll('.remove-feature');
        removeButtons.forEach(button => setupRemoveFeature(button));
        
        function setupRemoveFeature(button) {
            button.addEventListener('click', function() {
                this.closest('.feature-item').remove();
            });
        }
    });
</script>
@endpush