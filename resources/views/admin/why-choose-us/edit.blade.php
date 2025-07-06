@extends('layouts.admin')

@section('title', 'Edit Why Choose Us Feature')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Edit Feature</h1>
        <p class="text-gray-600">Update the "Why Choose MyTravel?" feature.</p>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('admin.why-choose-us.update', $whyChooseUs->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $whyChooseUs->title) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" id="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">{{ old('description', $whyChooseUs->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon (FontAwesome Class)</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-icons text-gray-400"></i>
                    </div>
                    <input type="text" name="icon" id="icon" value="{{ old('icon', $whyChooseUs->icon) }}" class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                </div>
                <p class="text-sm text-gray-500 mt-1">Example: fas fa-check-circle, fas fa-globe, etc.</p>
                @error('icon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="color" class="block text-sm font-medium text-gray-700 mb-2">Background Color</label>
                <div class="flex items-center">
                    <input type="color" name="color" id="color" value="{{ old('color', $whyChooseUs->color) }}" class="h-10 w-10 border border-gray-300 rounded-md mr-3">                    <input type="text" name="color_text" id="color-text" value="{{ old('color', $whyChooseUs->color) }}" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                </div>
                @error('color')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $whyChooseUs->sort_order) }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-primary-500 focus:border-primary-500">
                @error('sort_order')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="active" value="1" {{ old('active', $whyChooseUs->active) ? 'checked' : '' }} class="h-4 w-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <span class="ml-2 text-sm text-gray-700">Active</span>
                </label>
            </div>
            
            <div class="flex justify-end">
                <a href="{{ route('admin.why-choose-us.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Cancel</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">Update Feature</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const colorInput = document.getElementById('color');
        const colorTextInput = document.getElementById('color-text');
        
        colorInput.addEventListener('input', function() {
            colorTextInput.value = this.value;
        });
        
        colorTextInput.addEventListener('input', function() {
            colorInput.value = this.value;
        });
    });
</script>
@endpush