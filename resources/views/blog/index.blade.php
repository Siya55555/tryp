@extends('layouts.app')

@section('title', 'Travel Blog & Vacation Tips')

@section('content')
    <!-- Hero Section (remains the same) -->
    <section class="relative h-64 md:h-96 overflow-hidden">
        <!-- Background Image Slideshow -->
        <div class="slideshow-container absolute inset-0">
            <div class="slideshow-slide absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                    alt="Blog Hero" 
                    class="w-full h-full object-cover">
            </div>
            <div class="slideshow-slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                    alt="Contact Us Hero 2" 
                    class="w-full h-full object-cover">
            </div>
            <div class="slideshow-slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                <img src="https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                    alt="Contact Us Hero 3" 
                    class="w-full h-full object-cover">
            </div>
            <!-- Semi-transparent gradient overlay instead of solid black -->
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/50 to-blue-900/30 z-10"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="container mx-auto px-4 h-full flex flex-col items-center justify-center relative z-20">
           <div>
           <h1 class="text-4xl md:text-6xl font-bold text-white text-center drop-shadow-lg">Travel Blog</h1>
            <p class="text-lg md:text-xl text-white/80 mt-2">Expert tips, destination guides, and travel inspiration</p>

             <!-- Search -->
             <div class="w-full md:w-auto flex-1 max-w-xl mt-10">
                    <form action="{{ route('blog.search') }}" method="GET" class="relative">
                        <input type="text" name="query" placeholder="Search blog posts..." class="w-full pl-4 pr-12 py-3 bg-gray-100 border-0 rounded-full focus:ring-2 focus:ring-blue-500 focus:bg-white">
                        <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-blue-600 text-white rounded-full p-2 transition hover:bg-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>  
        </div>
        
    </section>
     

    <!-- Blog Posts Grid -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Category Filter Buttons -->
            <div class="flex flex-wrap justify-center mb-8 gap-2">
                <button data-category="all" class="filter-buttons px-4 py-2 bg-blue-600 text-white rounded-full">
                    All Posts
                </button>
                @foreach($categories as $category)
                    <button data-category="{{ $category->slug }}" class="filter-buttons px-4 py-2 bg-gray-100 text-gray-700 rounded-full">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if(count($blogs) > 0)
                    @foreach($blogs as $blog)
                        <div class="group blog-card" data-category="{{ $blog->category->slug }}">
                            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-transform duration-300 hover:-translate-y-2 h-full">
                                <div class="relative aspect-video overflow-hidden">
                                    <img src="{{ $blog->featured_image }}" 
                                        alt="{{ $blog->title }}" 
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    <div class="absolute top-4 left-4">
                                        <span class="inline-block px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded-full">
                                            {{ $blog->category->name }}
                                        </span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center text-sm text-gray-500 mb-2">
                                        <span>{{ $blog->published_at->format('F d, Y') }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $blog->read_time }} min read</span>
                                    </div>
                                    <h3 class="text-xl font-bold mb-2">{{ $blog->title }}</h3>
                                    <p class="text-gray-600 mb-4">
                                        {{ $blog->excerpt }}
                                    </p>
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center font-medium text-blue-600 hover:text-blue-700">
                                        Read Article
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-span-full text-center py-12">
                        <h3 class="text-2xl font-bold text-gray-700">No blog posts found</h3>
                        <p class="text-gray-500 mt-2">Check back soon for new content!</p>
                    </div>
                @endif
            </div>
            
            <!-- Load More Button -->
            <div class="mt-12 text-center">
                <button id="load-more" class="px-8 py-3 bg-white border border-gray-300 rounded-full text-gray-700 font-medium hover:bg-gray-50 transition inline-flex items-center">
                    <span>Load More</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get DOM elements
        const searchForm = document.querySelector('form');
        const searchInput = document.querySelector('input[name="query"]');
        const filterButtons = document.querySelectorAll('.filter-buttons button');
        const blogCards = document.querySelectorAll('.blog-card');
        const loadMoreButton = document.getElementById('load-more');
        
        // Set initial state
        let visiblePosts = 6;
        showVisiblePosts();
        
        // Search functionality
        searchForm.addEventListener('submit', function(e) {
            // Form submits to search route, no need to prevent default
        });
        
        // Add event listeners to filter buttons
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Update button styles
                filterButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-100', 'text-gray-700');
                });
                
                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('bg-blue-600', 'text-white');
                
                // Filter posts by category
                const category = this.dataset.category;
                filterByCategory(category);
                
                // Reset visible posts count when changing categories
                visiblePosts = 6;
                showVisiblePosts();
            });
        });
        
        // Load more functionality
        loadMoreButton.addEventListener('click', function() {
            visiblePosts += 3;
            showVisiblePosts();
        });
        
        // Function to filter posts by category
        function filterByCategory(category) {
            blogCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.classList.remove('hidden');
                } else {
                    card.classList.add('hidden');
                }
            });
        }
        
        // Function to show only a certain number of visible posts
        function showVisiblePosts() {
            let visibleCount = 0;
            let hiddenCount = 0;
            
            blogCards.forEach((card, index) => {
                if (!card.classList.contains('hidden')) {
                    if (visibleCount < visiblePosts) {
                        card.style.display = 'block';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                        hiddenCount++;
                    }
                }
            });
            
            // Hide load more button if all posts are shown
            if (hiddenCount === 0) {
                loadMoreButton.style.display = 'none';
            } else {
                loadMoreButton.style.display = 'inline-flex';
            }
        }
        
        // Initialize with "All" filter active
        document.querySelector('.filter-buttons button[data-category="all"]').click();
    });
    
    // Slideshow functionality
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.slideshow-slide');
        let currentSlide = 0;
        
        function showSlide(index) {
            slides.forEach(slide => {
                slide.style.opacity = '0';
            });
            
            slides[index].style.opacity = '1';
        }
        
        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }
        
        // Change slide every 5 seconds
        setInterval(nextSlide, 5000);
    });
</script>
@endpush