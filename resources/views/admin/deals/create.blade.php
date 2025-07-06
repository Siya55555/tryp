{{-- resources/views/admin/deals/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Create Deal of the Week')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create Deal of the Week</h1>
        <a href="{{ route('admin.deals.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-lg">
            <i class="fas fa-arrow-left mr-2"></i> Back to Deals
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form action="{{ route('admin.deals.store') }}" method="POST" enctype="multipart/form-data" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div>
                    <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-1">Subtitle</label>
                    <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    @error('subtitle')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Features -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Features</label>
                <div id="features-container">
                    @if(old('features'))
                        @foreach(old('features') as $index => $feature)
                            <div class="feature-item flex items-center mb-2">
                                <input type="text" name="features[]" value="{{ $feature }}" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 mr-2">
                                <button type="button" class="remove-feature bg-red-100 text-red-600 p-2 rounded-md hover:bg-red-200">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    @else
                        <div class="feature-item flex items-center mb-2">
                            <input type="text" name="features[]" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 mr-2">
                            <button type="button" class="remove-feature bg-red-100 text-red-600 p-2 rounded-md hover:bg-red-200">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif
                </div>
                <button type="button" id="add-feature" class="mt-2 inline-flex items-center bg-blue-50 text-blue-600 px-3 py-1 rounded-md text-sm hover:bg-blue-100">
                    <i class="fas fa-plus mr-2"></i> Add Feature
                </button>
                @error('features')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price <span class="text-red-500">*</span></label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">$</span>
                        </div>
                        <input type="number" name="price" id="price" value="{{ old('price') }}" min="0" step="0.01" class="pl-7 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50" required>
                    </div>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Discount Price -->
                <div>
                    <label for="discount_price" class="block text-sm font-medium text-gray-700 mb-1">Discount Price</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">$</span>
                        </div>
                        <input type="number" name="discount_price" id="discount_price" value="{{ old('discount_price') }}" min="0" step="0.01" class="pl-7 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    </div>
                    @error('discount_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Image -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                    <input type="file" name="image" id="image" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <p class="mt-1 text-sm text-gray-500">Recommended size: 800x600 pixels. Max size: 2MB.</p>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Expires In -->
                <div>
                    <label for="expires_in_days" class="block text-sm font-medium text-gray-700 mb-1">Expires In (days)</label>
                    <input type="number" name="expires_in_days" id="expires_in_days" value="{{ old('expires_in_days', 7) }}" min="1" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    <p class="mt-1 text-sm text-gray-500">Leave empty for no expiration date.</p>
                    @error('expires_in_days')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- CTA Text -->
                <div>
                    <label for="cta_text" class="block text-sm font-medium text-gray-700 mb-1">Call to Action Text</label>
                    <input type="text" name="cta_text" id="cta_text" value="{{ old('cta_text', 'BOOK NOW') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    @error('cta_text')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- CTA Link -->
                <div>
                    <label for="cta_link" class="block text-sm font-medium text-gray-700 mb-1">Call to Action Link</label>
                    <input type="text" name="cta_link" id="cta_link" value="{{ old('cta_link', '/bundles') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                    @error('cta_link')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <div class="flex space-x-4">
                    <div class="flex items-center">
                        <input type="radio" name="status" id="status_active" value="active" {{ old('status', 'active') === 'active' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <label for="status_active" class="ml-2 text-sm text-gray-700">Active</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" name="status" id="status_inactive" value="inactive" {{ old('status') === 'inactive' ? 'checked' : '' }} class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                        <label for="status_inactive" class="ml-2 text-sm text-gray-700">Inactive</label>
                    </div>
                </div>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.deals.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create Deal
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add Feature Button
        document.getElementById('add-feature').addEventListener('click', function() {
            const container = document.getElementById('features-container');
            const featureItem = document.createElement('div');
            featureItem.className = 'feature-item flex items-center mb-2';
            featureItem.innerHTML = `
                <input type="text" name="features[]" class="flex-1 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50 mr-2">
                <button type="button" class="remove-feature bg-red-100 text-red-600 p-2 rounded-md hover:bg-red-200">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(featureItem);
            
            // Add event listener to the new remove button
            attachRemoveListeners();
        });
        
        // Remove Feature Button
        function attachRemoveListeners() {
            document.querySelectorAll('.remove-feature').forEach(button => {
                button.removeEventListener('click', removeFeature);
                button.addEventListener('click', removeFeature);
            });
        }
        
        function removeFeature() {
            // Don't remove if it's the only one
            const features = document.querySelectorAll('.feature-item');
            if (features.length > 1) {
                this.closest('.feature-item').remove();
            } else {
                // Clear the input instead of removing
                this.closest('.feature-item').querySelector('input').value = '';
            }
        }
        
        // Initial setup
        attachRemoveListeners();
    });
</script>
@endpush
@endsection