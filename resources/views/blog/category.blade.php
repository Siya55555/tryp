@extends('layouts.app')

@section('title', $category->name . ' | Blog Category')

@section('content')
    <!-- Category Header -->
    <section class="py-12 bg-blue-900 text-white">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-center">{{ $category->name }}</h1>
            <p class="text-center text-blue-100 mt-2">{{ count($blogs) }} articles</p>
            
            <!-- Search for this category -->
            <div class="max-w-2xl mx-auto mt-8">
                <form action="{{ route('blog.search') }}" method="GET" class="relative">
                    <input type="text" name="query" placeholder="Search in {{ $category->name }}..." class="w-full pl-4 pr-12 py-3 bg-blue-800/50 border border-blue-700 rounded-full focus:ring-2 focus:ring-white/30 focus:border-white/30 text-white placeholder-blue-200">
                    <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-white text-blue-800 rounded-full p-2 transition hover:bg-gray-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Category Posts Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Main Content - Category Posts -->
                <div class="lg:col-span-8">
                    @if(count($blogs) > 0)
                        @foreach($blogs as $blog)
                            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6 group hover:shadow-lg transition-shadow">
                                <div class="flex flex-col md:flex-row">
                                    <div class="md:w-1/3 relative">
                                        <img src="{{ $blog->featured_image }}" alt="{{ $blog->title }}" class="w-full h-64 md:h-full object-cover">
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
                                            <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-700">
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
                        <!-- No posts placeholder -->
                    @endif
                </div>
                
                <!-- Sidebar -->
                <aside class="lg:col-span-4">
                    <!-- Categories Widget -->
                    <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Categories</h3>
                        <ul class="space-y-3">
                            @foreach($categories as $cat)
                            <li>
                                <a href="{{ route('blog.category', $cat->slug) }}" class="flex justify-between items-center group {{ $cat->id == $category->id ? 'text-blue-600 font-medium' : 'text-gray-700' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded-full">{{ $cat->blogs_count }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection