<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{    public function index()
    {
        $blogs = Blog::with(['category', 'tags'])
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->get();
        
        $categories = BlogCategory::withCount('blogs')->get();
        
        // Add SEO metadata
        $seoTitle = 'Blog - Travel Insights & Destination Guides';
        $seoDescription = 'Explore our travel blog for insider tips, destination guides, and travel inspiration to help plan your next adventure.';
        $seoKeywords = 'travel blog, destination guides, travel tips, vacation planning, travel inspiration';
        $seoImage = asset('images/default-social-share.jpg');
        $seoType = 'blog';
        
        return view('blog.index', compact('blogs', 'categories', 'seoTitle', 'seoDescription', 'seoKeywords', 'seoImage', 'seoType'));
    }    public function show($slug)
    {
        $post = Blog::with(['category', 'tags', 'comments'])
            ->where('slug', $slug)
            ->firstOrFail();
          // Fetch related posts
        $relatedPosts = Blog::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->take(4)
            ->get();
          // Fetch more posts (different from current and related)
        $morePosts = Blog::where('id', '!=', $post->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->whereNotIn('id', $relatedPosts->pluck('id'))
            ->take(3)
            ->get();
        
        $categories = BlogCategory::withCount('blogs')->get();
        
        // Add SEO metadata
        $seoTitle = $post->title;
        $seoDescription = $post->excerpt ?? substr(strip_tags($post->content), 0, 160);
        $seoKeywords = $post->tags->pluck('name')->implode(', ');
        $seoImage = $post->featured_image ?? asset('images/default-social-share.jpg');
        $seoType = 'article';
        $canonicalUrl = route('blog.show', $post->slug);
        
        return view('blog.show', compact('post', 'relatedPosts', 'morePosts', 'categories', 
            'seoTitle', 'seoDescription', 'seoKeywords', 'seoImage', 'seoType', 'canonicalUrl'));
    }    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        
        $blogs = Blog::with(['category', 'tags'])
            ->where('category_id', $category->id)
            ->where('status', 'published')
            ->get();
        
        $categories = BlogCategory::withCount('blogs')->get();
        
        // Add SEO metadata
        $seoTitle = $category->name . ' - Travel Blog';
        $seoDescription = 'Explore our ' . $category->name . ' travel articles and guides. Find inspiration, tips, and insights for your next journey.';
        $seoKeywords = $category->name . ', travel, blog, destinations, travel tips, vacation planning';
        $seoImage = asset('images/default-social-share.jpg');
        $seoType = 'blog';
        $canonicalUrl = route('blog.category', $category->slug);
        
        return view('blog.category', compact('category', 'blogs', 'categories', 
            'seoTitle', 'seoDescription', 'seoKeywords', 'seoImage', 'seoType', 'canonicalUrl'));
    }    public function search(Request $request)
{
    $query = $request->input('query');
    
    $blogs = Blog::with(['category', 'tags'])
        ->where('status', 'published')
        ->where(function($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
              ->orWhere('excerpt', 'LIKE', "%{$query}%")
              ->orWhere('content', 'LIKE', "%{$query}%");
        })
        ->get();
    
    $categories = BlogCategory::withCount('blogs')->get();
    
    // Fetch popular tags from the search results
    $popularTags = Tag::whereHas('blogs', function($q) use ($blogs) {
        $q->whereIn('blog_id', $blogs->pluck('id'));
    })->take(8)->get();
    
    // Add SEO metadata
    $seoTitle = 'Search Results for "' . $query . '" - Travel Blog';
    $seoDescription = 'Browse search results for "' . $query . '" on our travel blog. Find travel tips, destination guides, and inspiration.';
    $seoKeywords = $query . ', travel blog, search, travel tips, destination guides';
    $seoImage = asset('images/default-social-share.jpg');
    $seoType = 'website';
    
    return view('blog.search', compact('blogs', 'categories', 'query', 'popularTags', 
        'seoTitle', 'seoDescription', 'seoKeywords', 'seoImage', 'seoType'));
}

    public function storeComment(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'comment' => 'required|string|max:2000',
        ]);

        $blog = Blog::findOrFail($id);

        $comment = $blog->comments()->create([
            'author' => $validated['name'],
            'content' => $validated['comment'],
            'user_id' => auth()->check() ? auth()->id() : null
        ]);

        return redirect()->back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }
}