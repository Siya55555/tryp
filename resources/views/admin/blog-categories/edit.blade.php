@extends('layouts.admin')

@section('title', 'Edit Blog Category')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <span class="bg-gradient-to-r from-blue-600 to-blue-600 w-2 h-8 rounded mr-3 inline-block"></span>
            Edit Blog Category
        </h1>
        <a href="{{ route('admin.blog-categories.index') }}" 
           class="bg-gray-100 hover:bg-gray-200 text-gray-700 transition-colors duration-200 font-medium py-2 px-4 rounded-lg flex items-center border border-gray-300 shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-100 max-w-3xl mx-auto">
        <div class="bg-gradient-to-r from-blue-600 to-blue-600 px-6 py-4">
            <h2 class="text-white font-semibold text-lg">Category Information</h2>
        </div>
        
        <form method="POST" action="{{ route('admin.blog-categories.update', $blogCategory->id) }}" class="p-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 gap-6">
                <!-- Name -->
                <div class="form-group">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                        Name 
                        <span class="text-red-500 ml-1">*</span>
                        <span class="ml-2 text-xs text-gray-500">(Required)</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $blogCategory->name) }}" 
                           required 
                           class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 @error('name') border-red-300 @enderror"
                           placeholder="Enter category name">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <!-- Slug -->
                <div class="form-group">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                        Slug 
                        <span class="text-red-500 ml-1">*</span>
                        <span class="ml-2 text-xs text-gray-500">(Required)</span>
                    </label>
                    <div class="flex">
                        <input type="text" 
                               name="slug" 
                               id="slug" 
                               value="{{ old('slug', $blogCategory->slug) }}" 
                               required 
                               class="block w-full rounded-lg rounded-r-none border-gray-300 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition duration-200 @error('slug') border-red-300 @enderror"
                               placeholder="enter-slug-here">
                        <button type="button" 
                                id="generateSlug" 
                                class="inline-flex items-center px-4 py-2 border border-l-0 border-transparent text-sm font-medium rounded-r-lg text-white bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            Generate
                        </button>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">The slug is used in URLs and must be unique.</p>
                    @error('slug')
                        <p class="mt-1 text-sm text-red-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <!-- Related Blogs -->
                <div class="form-group mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Related Blog Posts</label>
                    <div class="mt-1 bg-gray-50 p-5 rounded-lg border border-gray-200">
                        @if($blogCategory->blogs && $blogCategory->blogs->count() > 0)
                            <div class="max-h-60 overflow-y-auto pr-2">
                                <ul class="space-y-2">
                                    @foreach($blogCategory->blogs as $blog)
                                        <li class="flex items-start">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <a href="{{ route('admin.blogs.edit', $blog->id) }}" 
                                               class="text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                                                {{ $blog->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="mt-3 text-right">
                                <span class="text-sm font-medium text-gray-600">
                                    Total: {{ $blogCategory->blogs->count() }} blog post(s)
                                </span>
                            </div>
                        @else
                            <div class="flex items-center justify-center py-6 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mr-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-sm">No blog posts are using this category.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="mt-8 flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Update Category
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-group:focus-within label {
        color: #3b82f6; /* blue-500 */
    }
    
    /* Custom scrollbar for related blogs list */
    .overflow-y-auto::-webkit-scrollbar {
        width: 5px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        const generateSlugButton = document.getElementById('generateSlug');
        
        // Auto-generate slug when name changes (only if slug is empty)
        nameInput.addEventListener('blur', function() {
            if (nameInput.value && !slugInput.value) {
                generateSlug();
            }
        });
        
        // Generate slug on button click
        generateSlugButton.addEventListener('click', generateSlug);
        
        function generateSlug() {
            if (nameInput.value) {
                slugInput.value = nameInput.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/--+/g, '-')
                    .trim();
                
                // Add animation effect to show the slug was generated
                slugInput.classList.add('bg-blue-50');
                setTimeout(() => {
                    slugInput.classList.remove('bg-blue-50');
                }, 500);
            }
        }
    });
</script>
@endpush