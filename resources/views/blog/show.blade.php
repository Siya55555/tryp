@extends('layouts.app')

@section('title', $post->title . ' | Blog')

@section('content')
    <!-- Hero Section with Featured Image -->
    <section class="relative h-96 md:h-[500px] overflow-hidden">
        <div class="absolute inset-0">
            <img 
            
            src="{{ filter_var($post->featured_image, FILTER_VALIDATE_URL) ? $post->featured_image : asset($post->featured_image) }}" alt="{{ $post->title }}"
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-primary-900/80 to-primary-900/30 z-10"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="container mx-auto px-4 h-full flex flex-col justify-end pb-12 relative z-20">
            <div class="inline-block mb-3">
                <span class="px-3 py-1 bg-primary-600 text-white text-xs font-medium rounded-full">
                    {{ $post->category->name }}
                </span>
            </div>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white drop-shadow-lg max-w-4xl">
                {{ $post->title }}
            </h1>            <div class="flex items-center text-white/90 mt-4 text-sm">
                <span>{{ $post->published_at ? $post->published_at->format('F d, Y') : 'Date not available' }}</span>
                <span class="mx-2">•</span>
                <span>{{ $post->read_time }} min read</span>
                @if($post->author)
                <span class="mx-2">•</span>
                <span>By {{ $post->author }}</span>
                @endif
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-10 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                <!-- Main Content -->
                <div class="lg:col-span-8 lg:pr-6">
                    <!-- Social Share Buttons (Desktop) -->
                    <div class="hidden lg:flex float-left flex-col space-y-3 mr-6">                        <div class="w-10 h-10 bg-primary-600 text-white rounded-full flex items-center justify-center hover:bg-primary-700 transition">
                            <i class="fab fa-facebook-f"></i>
                        </div>
                        <div class="w-10 h-10 bg-primary-400 text-white rounded-full flex items-center justify-center hover:bg-primary-500 transition">
                            <i class="fab fa-twitter"></i>
                        </div>
                    </div>
                    
                    <!-- Article Content -->
                    <div class="prose prose-lg max-w-none">
                        {!! $post->content !!}

                        <!-- Tags -->
                        @if(count($post->tags) > 0)
                        <div class="mt-10 pt-6 border-t border-gray-200">
                            <h4 class="text-gray-900 font-bold mb-3">Topics:</h4>
                            <div class="flex flex-wrap gap-2">
                                @foreach($post->tags as $tag)
                                <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">
                                    {{ $tag->name }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Author Box -->
                    @if($post->author && $post->author_bio)
                    <div class="mt-12 bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <div class="flex items-start">
                            @if($post->author_image)
                            <img src="{{ $post->author_image }}" alt="{{ $post->author }}" class="w-16 h-16 rounded-full mr-4 object-cover">
                            @endif
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">About the Author</h4>
                                <h5 class="text-primary-600 font-medium">{{ $post->author }}</h5>
                                <p class="mt-2 text-gray-600">{{ $post->author_bio }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Comment Section -->
                    <div class="mt-12 pt-10 border-t border-gray-200" id="comments">
                        <h3 class="text-2xl font-bold text-gray-900 mb-8">Comments ({{ $post->comments->count() }})</h3>
                        @if($post->comments->count() > 0)
    @foreach($post->comments as $comment)
        <div class="mb-8 pb-8 border-b border-gray-200 last:border-0">
            <div class="flex items-start">
                @if($comment->author_image)
                    <img src="{{ $comment->author_image }}" 
                         alt="{{ $comment->author }}" 
                         class="w-12 h-12 rounded-full mr-4 object-cover">
                @else
                    {{-- User icon fallback --}}
                    <div class="w-12 h-12 rounded-full mr-4 bg-gray-100 text-gray-600 flex items-center justify-center">
                        {{-- Using a user icon (you can replace this with your preferred icon library) --}}
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                @endif
                
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        <h5 class="font-bold text-gray-900">{{ $comment->author }}</h5>
                        <span class="text-sm text-gray-500">•</span>
                        <time class="text-sm text-gray-500">
                            {{ $comment->created_at ? $comment->created_at->format('F d, Y') : 'Date not available' }}
                        </time>
                    </div>
                    
                    <div class="mt-2 text-gray-700 leading-relaxed">
                        {{ $comment->content }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-center py-8">
        <p class="text-gray-600 italic">No comments yet. Be the first to share your thoughts!</p>
    </div>
@endif
                        
                        <!-- Comment Form -->
                        <div class="mt-10">
                            <h4 class="text-xl font-bold text-gray-900 mb-6">Leave a Comment</h4>
                            <form action="{{ route('blog.comment', $post->id) }}" method="POST">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label for="name" class="block text-gray-700 mb-1">Name *</label>                                        <input type="text" id="name" name="name" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                    <div>
                                        <label for="email" class="block text-gray-700 mb-1">Email * (will not be published)</label>
                                        <input type="email" id="email" name="email" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="comment" class="block text-gray-700 mb-1">Comment *</label>                                    <textarea id="comment" name="comment" rows="5" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"></textarea>
                                </div>
                                <button type="submit"  class=" bg-blue-600  hover:bg-blue-700  text-white font-medium py-2 px-4 rounded-lg flex items-center">
                                    Post Comment
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Sidebar -->
                <aside class="lg:col-span-4">
                    <!-- Related Posts -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Related Posts</h3>
                        
                        @foreach($relatedPosts as $relatedPost)
                        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="block mb-6 group">
                            <div class="flex items-start">
                                <div class="w-20 h-20 rounded-lg overflow-hidden flex-shrink-0">
                                    <img src="{{ $relatedPost->featured_image }}" alt="{{ $relatedPost->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </div>                                <div class="ml-4">
                                    <h4 class="font-bold text-gray-900 group-hover:text-primary-600 transition">{{ $relatedPost->title }}</h4>
                                    <p class="text-sm text-gray-500">{{ $relatedPost->published_at ? $relatedPost->published_at->format('F d, Y') : 'Date not available' }}</p>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    
                    <!-- Categories Widget -->
                    <div class="mt-8 bg-gray-50 rounded-xl p-6 border border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Categories</h3>
                        <ul class="space-y-3">
                            @foreach($categories as $category)
                            <li>                                <a href="{{ route('blog.category', $category->slug) }}" class="flex justify-between items-center group {{ $category->id == $post->category->id ? 'text-primary-600 font-medium' : 'text-gray-700' }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded-full">{{ $category->blogs_count }}</span>
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

@push('styles')
<style>
    /* Custom styles for the blog post content */
    .prose img {
        @apply rounded-xl shadow-md my-8;
    }
    
    .prose h2 {
        @apply text-2xl font-bold text-gray-900 mt-10 mb-4;
    }
    
    .prose h3 {
        @apply text-xl font-bold text-gray-900 mt-8 mb-3;
    }
    
    .prose p {
        @apply text-gray-700 leading-relaxed mb-4;
    }
    
    .prose ul {
        @apply list-disc list-outside ml-6 text-gray-700 mb-6;
    }
    
    .prose li {
        @apply mb-2;
    }
      .prose blockquote {
        @apply border-l-4 border-primary-500 pl-4 italic text-gray-600 my-6;
    }
    
    /* Custom fade-in animation for images */
    .prose img {
        animation: fadeIn 0.8s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image Gallery Lightbox
        const articleImages = document.querySelectorAll('.prose img:not(.no-lightbox)');
        articleImages.forEach(image => {
            image.classList.add('cursor-pointer');
            image.addEventListener('click', function() {
                const src = this.getAttribute('src');
                const alt = this.getAttribute('alt') || 'Image';
                
                const overlay = document.createElement('div');
                overlay.classList.add('fixed', 'inset-0', 'bg-black/90', 'z-50', 'flex', 'items-center', 'justify-center', 'p-4');
                
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('relative', 'max-w-6xl', 'mx-auto');
                
                const closeBtn = document.createElement('button');
                closeBtn.classList.add('absolute', 'top-4', 'right-4', 'bg-white/10', 'text-white', 'p-2', 'rounded-full');
                closeBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>';
                closeBtn.addEventListener('click', () => overlay.remove());
                
                const img = document.createElement('img');
                img.src = src;
                img.alt = alt;
                img.classList.add('max-h-[85vh]', 'max-w-full', 'object-contain');
                
                const caption = document.createElement('p');
                caption.textContent = alt;
                caption.classList.add('text-white/80', 'text-center', 'mt-4');
                
                imgContainer.appendChild(closeBtn);
                imgContainer.appendChild(img);
                imgContainer.appendChild(caption);
                overlay.appendChild(imgContainer);
                
                document.body.appendChild(overlay);
                
                overlay.addEventListener('click', function(e) {
                    if (e.target === overlay) {
                        overlay.remove();
                    }
                });
            });
        });
        
        // Smooth scroll to comments when clicking on comment links
        const commentLinks = document.querySelectorAll('a[href="#comments"]');
        commentLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const commentsSection = document.querySelector('#comments');
                if (commentsSection) {
                    commentsSection.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });
    });
</script>
@endpush