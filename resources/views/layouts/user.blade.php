@php
use Illuminate\Support\Facades\Auth;
@endphp
<!-- resources/views/layouts/user.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ setting('company_name', 'MyTravel') }}</title>
    
    <!-- SEO and Social Media Sharing Meta Tags -->
    <x-seo-meta 
        :title="$seoTitle ?? View::getSection('title'). ' - '.setting('company_name', 'MyTravel')"
        :description="$seoDescription ?? 'Your personalized travel dashboard - manage bookings, view your trips, and access exclusive travel offers.'"
        :keywords="$seoKeywords ?? 'travel account, bookings, user dashboard, travel management'"
        :ogImage="$seoImage ?? ''"
        :ogType="$seoType ?? 'website'"
        :canonicalUrl="$canonicalUrl ?? request()->url()"
    />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Dynamic Button Colors CSS -->
    <link rel="stylesheet" href="{{ route('dynamic.css') }}?v={{ \App\Models\Admin\Setting::get('css_version', time()) }}" type="text/css">
    
    <style>
        input{
        }
        input:focus{
            outline:none !important; 
        }   
    </style>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Header -->
    <x-header />
    
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar -->
            <div class="w-full md:w-64 bg-white rounded-lg shadow-md p-6">                <div class="flex flex-col items-center mb-6">
                    <div class="w-24 h-24 rounded-full overflow-hidden bg-blue-100 mb-3">
                        @if(Auth::user()->profile_image)
                            <img                             src="{{ filter_var(Auth::user()->profile_image, FILTER_VALIDATE_URL) ? Auth::user()->profile_image : asset(Auth::user()->profile_image) }}" 
                            alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">                        @else
                            <div class="w-full h-full flex items-center justify-center text-white text-3xl font-bold" style="background-color: {{ setting('primary_button_color', '#2563eb') }}">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <h2 class="text-lg font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                </div>
                
                <nav>
                    <ul class="space-y-2">                        <li>
                            <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('user.dashboard') ? 'text-white' : 'text-gray-700  hover:bg-opacity-75' }} transition-colors" style="{{ request()->routeIs('user.dashboard') ? 'background-color: ' . setting('primary_button_color', '#2563eb') : '' }}; {{ !request()->routeIs('user.dashboard') ? 'hover:background-color: ' . setting('primary_button_color', '#2563eb') . ';' : '' }}">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </div>
                            </a>
                        </li><li>
                            <a href="{{ route('user.profile') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('user.profile') ? 'text-white' : 'text-gray-700  hover:bg-opacity-75' }} transition-colors" style="{{ request()->routeIs('user.profile') ? 'background-color: ' . setting('primary_button_color', '#2563eb') : '' }}; {{ !request()->routeIs('user.profile') ? 'hover:background-color: ' . setting('primary_button_color', '#2563eb') . ';' : '' }}">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    My Profile
                                </div>
                            </a>
                        </li>                        <li>
                            <a href="{{ route('user.bookings.index') }}" class="block px-4 py-2 rounded-md {{ request()->routeIs('user.bookings*') ? 'text-white' : 'text-gray-700  hover:bg-opacity-75' }} transition-colors" style="{{ request()->routeIs('user.bookings*') ? 'background-color: ' . setting('primary_button_color', '#2563eb') : '' }}; {{ !request()->routeIs('user.bookings*') ? 'hover:background-color: ' . setting('primary_button_color', '#2563eb') . ';' : '' }}">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    My Bookings
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 rounded-md text-gray-700 hover:bg-red-50 hover:text-red-600">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    Logout
                                </div>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
            
            <!-- Main Content -->
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-md p-6">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <x-footer />
    
    @stack('scripts')
</body>
</html>
