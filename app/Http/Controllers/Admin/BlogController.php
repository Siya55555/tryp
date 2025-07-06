<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\BlogCategory;
use App\Models\Admin\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::query();
        
        // Apply search filter
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }
        
        // Apply category filter
        if ($request->has('category') && !empty($request->category)) {
            $query->where('category_id', $request->category);
        }
        
        // Apply status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }
        
        $blogs = $query->with('category')->orderBy('created_at', 'desc')->paginate(10);
        $categories = BlogCategory::all();
        
        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $tags = Tag::all();
        
        return view('admin.blogs.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'status' => 'required|in:draft,published',
            'featured_image' => 'required_without:featured_image_url|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured_image_url' => 'required_without:featured_image|nullable|url',
            'author' => 'required|string|max:255',
            'author_image' => 'nullable|url',
            'author_bio' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);
        
        $featuredImage = null;
        
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/blog_images'), $filename);
            $featuredImage = 'storage/blog_images/' . $filename;
        } elseif ($request->filled('featured_image_url')) {
            $featuredImage = $request->featured_image_url;
        }
        
        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'featured_image' => $featuredImage,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'author' => $request->author,
            'author_image' => $request->author_image,
            'author_bio' => $request->author_bio,
            'read_time' => $request->read_time ?? 5,
            'published_at' => $request->status === 'published' ? ($request->published_at ?? now()) : null,
        ]);
        
        if ($request->has('tags')) {
            $blog->tags()->attach($request->tags);
        }
        
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully!');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::all();
        $tags = Tag::all();
        
        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:blog_categories,id',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured_image_url' => 'nullable|url',
            'author' => 'required|string|max:255',
            'author_image' => 'nullable|url',
            'author_bio' => 'nullable|string',
            'read_time' => 'nullable|integer|min:1',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);
        
        $featuredImage = $blog->featured_image;
        
        if ($request->hasFile('featured_image')) {
            // Delete old image if it's a local file
            if (Str::startsWith($featuredImage, 'storage/blog_images/')) {
                @unlink(public_path($featuredImage));
            }
            
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/blog_images'), $filename);
            $featuredImage = 'storage/blog_images/' . $filename;
        } elseif ($request->filled('featured_image_url')) {
            $featuredImage = $request->featured_image_url;
        }
        
        $wasPublished = $blog->status === 'published';
        $nowPublished = $request->status === 'published';
        
        $blog->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'featured_image' => $featuredImage,
            'category_id' => $request->category_id,
            'status' => $request->status,
            'author' => $request->author,
            'author_image' => $request->author_image,
            'author_bio' => $request->author_bio,
            'read_time' => $request->read_time ?? 5,
            'published_at' => $nowPublished && !$wasPublished ? ($request->published_at ?? now()) : $request->published_at,
        ]);
        
        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        } else {
            $blog->tags()->detach();
        }
        
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        // Delete featured image if it's a local file
        if (Str::startsWith($blog->featured_image, 'storage/blog_images/')) {
            @unlink(public_path($blog->featured_image));
        }
        
        $blog->delete();
        
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post deleted successfully!');
    }
}