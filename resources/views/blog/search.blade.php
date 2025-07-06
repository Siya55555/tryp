@extends('layouts.app')

@section('title', 'Search Results: ' . $query)

@section('content')
    <!-- Search Header -->
    <section class="py-12 bg-blue-600 text-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-center">Search Results: "{{ $query }}"</h1>
            <p class="text-center text-primary-100 mt-2">{{ count($blogs) }} results found</p>
            
            <!-- Search Again -->
            <div class="max-w-2xl mx-auto mt-8">
                <form action="{{ route('blog.search') }}" method="GET" class="relative">
                    <input type="text" name="query" value="{{ $query }}" placeholder="Search blog posts..." class="w-full pl-4 pr-12 py-3 bg-primary-800/50 border border-primary-700 rounded-full focus:ring-2 focus:ring-white/30 focus:border-white/30 text-white placeholder-primary-200">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-white primary-text-color rounded-full p-2 transition hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Results Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Main Content - Search Results -->
                <div class="lg:col-span-8">
                    @if(count($blogs) > 0)
                        @foreach($blogs as $blog)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 group hover:shadow-lg transition-shadow">
                                <div class="flex flex-col md:flex-row">
                                    <div class="md:w-1/3 relative">
                                        <img 
                                        src="{{ filter_var($blog->featured_image, FILTER_VALIDATE_URL) ? $blog->featured_image : asset($blog->featured_image) }}" alt="{{ $blog->title }}"
                                        
                                        class="w-full h-64 md:h-full object-cover">
                                        <div class="absolute top-4 left-4">
                                            <span class="inline-block px-3 py-1 bg-primary-600 text-white text-xs font-medium rounded-full">
                                                {{ $blog->category->name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="md:w-2/3 p-6 flex flex-col justify-between">
                                        <div>
                                            <h2 class="text-xl font-bold mb-2">{{ $blog->title }}</h2>
                                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                                <span>{{ $blog->published_at->format('F d, Y') }}</span>
                                                <span class="mx-2">•</span>
                                                <span>{{ $blog->read_time }} min read</span>
                                            </div>
                                            <p class="text-gray-600 mb-4">
                                                {{ $blog->excerpt }}
                                            </p>
                                        </div>
                                        <div>
                                            <div class="flex flex-wrap gap-2 mb-4">
                                                @foreach($blog->tags as $tag)
                                                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">
                                                        {{ $tag->name }}
                                                    </span>
                                                @endforeach
                                            </div>
                                            <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center font-medium text-primary-600 hover:text-primary-700">
                                                Read Article
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="bg-white rounded-xl shadow-md p-12 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h2 class="text-2xl font-bold text-gray-700 mb-2">No results found</h2>
                            <p class="text-gray-500 mb-6">We couldn't find any blog posts matching your search for "{{ $query }}".</p>
                            <div class="flex justify-center">
                                <a href="{{ route('blog.index') }}" class="px-6 py-3 bg-primary-600 text-white font-medium rounded-lg hover:bg-primary-700 transition">
                                    Back to All Blog Posts
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Sidebar -->
                <aside class="lg:col-span-4">
                    <!-- Categories Widget -->
                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Categories</h3>
                        <ul class="space-y-3">
                            @foreach($categories as $category)
                            <li>
                                <a href="{{ route('blog.category', $category->slug) }}" class="flex justify-between items-center group">
                                    <span class="text-gray-700 group-hover:text-primary-600 transition">{{ $category->name }}</span>
                                    <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded-full">{{ $category->blogs_count }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    <!-- Popular Tags -->
                    <div class="mt-8 bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Popular Tags</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($blog->tags()->distinct()->take(8)->get() as $tag)
                                <a href="#" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 text-sm">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection