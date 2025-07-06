@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>
    
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">                <div class="p-3 rounded-full bg-primary-500 bg-opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Total Blogs</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['blogs'] }}</p>
                    </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-500 bg-opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Total Bundles</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['bundles'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-500 bg-opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Total Users</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['users'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-500 bg-opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Testimonials</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['testimonials'] }}</p>
                </div>
            </div>
        </div>
        
        <!-- New Contact Submissions Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">                <div class="p-3 rounded-full bg-primary-500 bg-opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="font-semibold text-gray-600">Contact Messages</h2>
                    <p class="text-2xl font-bold text-gray-800">{{ \App\Models\ContactSubmission::count() }}</p>
                    <p class="text-sm text-primary-600">
                        <span class="font-medium">{{ \App\Models\ContactSubmission::where('status', 'new')->count() }}</span> new
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Deal of the week card -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <div class="flex items-center">
            <div class="p-3 rounded-full bg-red-500 bg-opacity-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-4">
                <h2 class="font-semibold text-gray-600">Deal of the Week</h2>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['deals'] }}</p>
            </div>
        </div>
    </div>
    
    <!-- Recent Content -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Recent Blogs -->
        <div class="bg-white rounded-lg shadow overflow-hidden lg:col-span-1">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Recent Blogs</h3>
            </div>
            <div class="p-6">
                @if($recentBlogs->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentBlogs as $blog)
                            <div class="flex items-center border-b border-gray-100 pb-4">
                                <div class="flex-shrink-0 h-12 w-12 rounded-md overflow-hidden">
                                    <img 
                                    src="{{ filter_var($blog->featured_image , FILTER_VALIDATE_URL) ? $blog->featured_image  : asset($blog->featured_image) }}" 

                                     alt="{{ $blog->title }}" class="h-full w-full object-cover">
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-800">{{ $blog->title }}</h4>
                                    <p class="text-sm text-gray-500">
                                        {{ $blog->created_at->format('M d, Y') }} | {{ $blog->status }}
                                    </p>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="text-primary-500 hover:text-primary-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('admin.blogs.index') }}" class="text-sm text-primary-500 hover:text-primary-700">View all blogs →</a>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No blogs found</p>
                @endif
            </div>
        </div>
        
        <!-- Recent Deals -->
        <div class="bg-white rounded-lg shadow overflow-hidden lg:col-span-1">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Deal of the Week</h3>
            </div>
            <div class="p-6">
                @if($recentDeals->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentDeals as $deal)
                            <div class="border-b border-gray-100 pb-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12 rounded-md overflow-hidden">
                                        @if($deal->image)
                                            <img src="{{ asset('storage/' . $deal->image) }}" alt="{{ $deal->title }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full bg-gray-200 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <h4 class="font-medium text-gray-800">{{ $deal->title }}</h4>
                                        <p class="text-sm text-gray-500">
                                            ${{ number_format($deal->discount_price ?: $deal->price, 2) }}
                                            <span class="ml-2 px-2 py-1 text-xs rounded-full {{ $deal->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ ucfirst($deal->status) }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{ route('admin.deals.edit', $deal->id) }}" class="text-primary-500 hover:text-primary-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('admin.deals.index') }}" class="text-sm text-primary-500 hover:text-primary-700">Manage all deals →</a>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-gray-500">No deals found</p>
                        <a href="{{ route('admin.deals.create') }}" class="mt-2 inline-block text-sm text-primary-500 hover:text-primary-700">
                            Create your first deal →
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Recent Contact Submissions -->
        <div class="bg-white rounded-lg shadow overflow-hidden lg:col-span-1">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Recent Messages</h3>
            </div>
            <div class="p-6">
                @php
                    $recentSubmissions = \App\Models\ContactSubmission::orderBy('created_at', 'desc')->take(5)->get();
                @endphp
                
                @if($recentSubmissions->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentSubmissions as $submission)
                            <div class="border-b border-gray-100 pb-4">
                                <div class="flex items-center mb-2">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-primary-100 text-primary-800 flex items-center justify-center font-bold">
                                        {{ strtoupper(substr($submission->first_name, 0, 1)) }}{{ strtoupper(substr($submission->last_name, 0, 1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-gray-800">{{ $submission->first_name }} {{ $submission->last_name }}</h4>
                                        <p class="text-xs text-gray-500">
                                            {{ $submission->created_at->diffForHumans() }}
                                            <span class="ml-2 px-2 py-0.5 text-xs rounded-full 
                                                {{ $submission->status === 'new' ? 'bg-primary-100 text-primary-800' : 
                                                ($submission->status === 'read' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                                {{ ucfirst($submission->status) }}
                                            </span>
                                        </p>
                                    </div>
                                    <div class="ml-auto">
                                        <a href="{{ route('admin.contact-submissions.show', $submission->id) }}" class="text-primary-500 hover:text-primary-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($submission->message, 100) }}</p>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('admin.contact-submissions.index') }}" class="text-sm text-primary-500 hover:text-primary-700">View all messages →</a>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No contact submissions found</p>
                @endif
            </div>
        </div>
        
        <!-- Recent Testimonials -->
        <div class="bg-white rounded-lg shadow overflow-hidden lg:col-span-1">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Recent Testimonials</h3>
            </div>
            <div class="p-6">
                @if($recentTestimonials->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentTestimonials as $testimonial)
                            <div class="flex items-center border-b border-gray-100 pb-4">
                                <div class="flex-shrink-0 h-12 w-12 rounded-full overflow-hidden">
                                    @if($testimonial->image)
                                        <img 
                                        src="{{ filter_var($testimonial->image , FILTER_VALIDATE_URL) ? $testimonial->image  : asset($testimonial->image ) }}" 

                                         class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full bg-primary-100 flex items-center justify-center text-primary-500">
                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-800">{{ $testimonial->name }}</h4>
                                    <div class="flex items-center">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }}" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                                <div class="ml-auto">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="text-primary-500 hover:text-primary-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-right">
                        <a href="{{ route('admin.testimonials.index') }}" class="text-sm text-primary-500 hover:text-primary-700">View all testimonials →</a>
                    </div>
                @else
                    <p class="text-gray-500 text-center py-4">No testimonials found</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection