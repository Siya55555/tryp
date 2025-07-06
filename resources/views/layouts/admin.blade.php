<!DOCTYPE html>
<html lang="en">
<head>    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - {{ setting('company_name', 'MyTravel') }} Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
      <!-- Dynamic Button Colors CSS -->
    <link rel="stylesheet" href="{{ route('dynamic.css') }}?v={{ \App\Models\Admin\Setting::get('css_version', time()) }}" type="text/css">

    <style>

        input:focus{
            outline:none !important; 
        }   


        .sidebar-menu-item {
            transition: all 0.2s ease;
        }
        .sidebar-menu-item:hover {
            transform: translateX(4px);
        }
        .dropdown-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        .dropdown-content.show {
            max-height: 500px;
        }
        .notification-badge {
            transition: all 0.2s ease;
        }
        .notification-badge:hover {
            transform: scale(1.1);
        }
        .flash-message {
            animation: slideInDown 0.5s ease;
        }
        @keyframes slideInDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-800">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar - Hidden on mobile by default -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-20 w-64 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out bg-gray-800 overflow-y-auto">
            <!-- Logo -->
            <div class="flex items-center justify-center h-16 px-4 bg-gray-900">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center p-5">
                     @if(isset($settings['site_logo']))
                    <img
                    
                    src="{{ $settings['site_logo'] }}" alt="{{ $settings['company_name'] ?? 'MyTravel' }}" >
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M5.5 16a.5.5 0 01-.5-.5v-6a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v6a.5.5 0 01-.5.5h-1zm3 0a.5.5 0 01-.5-.5v-6a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v6a.5.5 0 01-.5.5h-1zm4.5-.5a.5.5 0 00.5-.5v-6a.5.5 0 00-.5-.5h-1a.5.5 0 00-.5.5v6a.5.5 0 00.5.5h1z"/>
                        <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14.5a6.5 6.5 0 110-13 6.5 6.5 0 010 13z" clip-rule="evenodd"/>
                    </svg>
                @endif
                </a>
            </div>
            
            <!-- Admin info -->
            <div class="px-4 py-3 border-b border-gray-700">
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gray-700 flex items-center justify-center">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-400">Administrator</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-4 px-3 space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-menu-item flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-tachometer-alt w-5 h-5 mr-3 text-center"></i>
                    <span>Dashboard</span>
                </a>
                
                <!-- Content Management Section -->
                <div class="pt-2">
                    <button onclick="toggleDropdown('content-management')" class="sidebar-menu-item w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">
                        <div class="flex items-center">
                            <i class="fas fa-file-alt w-5 h-5 mr-3 text-center"></i>
                            <span>Content Management</span>
                        </div>
                        <i id="content-management-icon" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                    </button>
                    <div id="content-management-dropdown" class="dropdown-content pl-4 mt-1 space-y-1">
                        <a href="{{ route('admin.blogs.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.blogs.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-pen-nib w-5 h-5 mr-3 text-center"></i>
                            <span>Blog Posts</span>
                        </a>
                        <a href="{{ route('admin.blog-categories.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.blog-categories.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-folder w-5 h-5 mr-3 text-center"></i>
                            <span>Blog Categories</span>
                        </a>
                        <a href="{{ route('admin.tags.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.tags.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-tags w-5 h-5 mr-3 text-center"></i>
                            <span>Tags</span>
                        </a>
                    </div>
                </div>
                
                <!-- Vacation Packages Section -->
                <div class="pt-2">
                    <button onclick="toggleDropdown('vacation-packages')" class="sidebar-menu-item w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">
                        <div class="flex items-center">
                            <i class="fas fa-suitcase w-5 h-5 mr-3 text-center"></i>
                            <span>Vacation Packages</span>
                        </div>
                        <i id="vacation-packages-icon" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                    </button>
                    <div id="vacation-packages-dropdown" class="dropdown-content pl-4 mt-1 space-y-1">
                        <a href="{{ route('admin.travel-packages.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.travel-packages.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-map-marked-alt w-5 h-5 mr-3 text-center"></i>
                            <span>Travel Packages</span>
                        </a>
                        <a href="{{ route('admin.bundles.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.bundles.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-box-open w-5 h-5 mr-3 text-center"></i>
                            <span>Vacation Bundles</span>
                        </a>
                        <a href="{{ route('admin.destinations.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.destinations.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-map-pin w-5 h-5 mr-3 text-center"></i>
                            <span>Destinations</span>
                        </a>
                        <a href="{{ route('admin.bundle-extras.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.bundle-extras.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-plus-circle w-5 h-5 mr-3 text-center"></i>
                            <span>Bundle Extras</span>
                        </a>
                        <a href="{{ route('admin.custom-bundles.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.custom-bundles.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-boxes w-5 h-5 mr-3 text-center"></i>
                            <span>Custom Bundles</span>
                        </a>
                    </div>
                </div>
                
                <a href="{{ route('admin.deals.index') }}" class="sidebar-menu-item flex items-center px-3 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.deals.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <i class="fas fa-percentage w-5 h-5 mr-3 text-center"></i>
                    <span>Deal of the Week</span>
                </a>
                
                <!-- Customer Content Section -->
                <div class="pt-2">
                    <button onclick="toggleDropdown('customer-content')" class="sidebar-menu-item w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">
                        <div class="flex items-center">
                            <i class="fas fa-users w-5 h-5 mr-3 text-center"></i>
                            <span>Customer Content</span>
                        </div>
                        <i id="customer-content-icon" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                    </button>
                    <div id="customer-content-dropdown" class="dropdown-content pl-4 mt-1 space-y-1">
                        <a href="{{ route('admin.testimonials.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-comment-alt w-5 h-5 mr-3 text-center"></i>
                            <span>Testimonials</span>
                        </a>
                        <a href="{{ route('admin.faqs.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.faqs.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-question-circle w-5 h-5 mr-3 text-center"></i>
                            <span>FAQs</span>
                        </a>
                        <a href="{{ route('admin.why-choose-us.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.why-choose-us.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
    <i class="fas fa-medal w-5 h-5 mr-3 text-center"></i>
    <span>Why Choose Us</span>
</a>
                    </div>
                </div>
                
                <!-- User Management Section -->
                <div class="pt-2">
                    <button onclick="toggleDropdown('user-management')" class="sidebar-menu-item w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">
                        <div class="flex items-center">
                            <i class="fas fa-user-cog w-5 h-5 mr-3 text-center"></i>
                            <span>User Management</span>
                        </div>
                        <i id="user-management-icon" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                    </button>
                    <div id="user-management-dropdown" class="dropdown-content pl-4 mt-1 space-y-1">
                        <a href="{{ route('admin.users.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-user-friends w-5 h-5 mr-3 text-center"></i>
                            <span>Users</span>
                        </a>
                        
                    </div>
                </div>
                <!-- Add this to the navigation section in admin.blade.php -->
<!-- Inside the nav element, where other navigation items are defined -->

<!-- Bookings Section -->
<div class="pt-2">
    <button onclick="toggleDropdown('bookings')" class="sidebar-menu-item w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">
        <div class="flex items-center">
            <i class="fas fa-calendar-check w-5 h-5 mr-3 text-center"></i>
            <span>Bookings</span>
            @php
                $pendingBookingsCount = \App\Models\Admin\UserBooking::where('status', 'pending')->count();
                // Check if the Booking class exists and if the tier_bookings table exists
                try {
                    if(class_exists('\\App\\Models\\Booking') && Schema::hasTable('tier_bookings')) {
                        $pendingBookingsCount += \App\Models\Booking::where('status', 'pending')->count();
                    }
                } catch (\Exception $e) {
                    // Either class doesn't exist or table doesn't exist, just continue
                }
            @endphp
            @if($pendingBookingsCount > 0)
                <span class="notification-badge ml-2 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-yellow-500 rounded-full">
                    {{ $pendingBookingsCount }}
                </span>
            @endif
        </div>
        <i id="bookings-icon" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
    </button>
    <div id="bookings-dropdown" class="dropdown-content pl-4 mt-1 space-y-1">
        <a href="{{ route('admin.bookings.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.bookings.index') && !request()->has('type') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            <i class="fas fa-list-ul w-5 h-5 mr-3 text-center"></i>
            <span>All Bookings</span>
        </a>
        <a href="{{ route('admin.bookings.index', ['type' => 'bundles']) }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.bookings.index') && request('type') == 'bundles' ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            <i class="fas fa-box-open w-5 h-5 mr-3 text-center"></i>
            <span>Bundle Bookings</span>
        </a>
        <a href="{{ route('admin.bookings.index', ['type' => 'packages']) }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.bookings.index') && request('type') == 'packages' ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            <i class="fas fa-suitcase w-5 h-5 mr-3 text-center"></i>
            <span>Package Bookings</span>
            @php
                $pendingPackageBookings = 0;
                // Check if the Booking class exists and if the tier_bookings table exists
                try {
                    if(class_exists('\\App\\Models\\Booking') && Schema::hasTable('tier_bookings')) {
                        $pendingPackageBookings = \App\Models\Booking::where('status', 'pending')->count();
                    }
                } catch (\Exception $e) {
                    // Either class doesn't exist or table doesn't exist, just continue
                }
            @endphp
            @if($pendingPackageBookings > 0)
                <span class="ml-auto inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-yellow-500 rounded-full">
                    {{ $pendingPackageBookings }}
                </span>
            @endif
        </a>
        <a href="{{ route('admin.bookings.create', ['type' => 'bundle']) }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.bookings.create') && request('type') == 'bundle' ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            <i class="fas fa-plus w-5 h-5 mr-3 text-center"></i>
            <span>New Bundle Booking</span>
        </a>
        <a href="{{ route('admin.bookings.create', ['type' => 'package']) }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.bookings.create') && request('type') == 'package' ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            <i class="fas fa-plus w-5 h-5 mr-3 text-center"></i>
            <span>New Package Booking</span>
        </a>
    </div>
</div>
                <!-- System Section -->
                <div class="pt-2">
                    <button onclick="toggleDropdown('system')" class="sidebar-menu-item w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">
                        <div class="flex items-center">
                            <i class="fas fa-cogs w-5 h-5 mr-3 text-center"></i>
                            <span>System</span>
                        </div>
                        <i id="system-icon" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
                    </button>
                    <div id="system-dropdown" class="dropdown-content pl-4 mt-1 space-y-1">
                        <a href="{{ route('admin.settings.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-sliders-h w-5 h-5 mr-3 text-center"></i>
                            <span>Site Settings</span>
                        </a>
                        <a href="{{ route('admin.navigation.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.navigation.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-bars w-5 h-5 mr-3 text-center"></i>
                            <span>Navigation</span>
                        </a>                        <a href="{{ route('admin.privacy.index') }}" class="flex items-center px-2 py-2 text-sm font-medium rounded-md {{ request()->routeIs('admin.privacy.*') ? 'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mr-3 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Privacy Policy
                        </a>
                        <a href="{{ route('admin.payment-gateways.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.payment-gateways.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
                            <i class="fas fa-credit-card w-5 h-5 mr-3 text-center"></i>
                            <span>Payment Gateways</span>
                        </a>
                    </div>

                  <!-- Contact Management Section -->
<div class="pt-2">
    <button onclick="toggleDropdown('contact-management')" class="sidebar-menu-item w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">
        <div class="flex items-center text-start">
            <i class="fas fa-envelope w-5 h-5 mr-3 text-center"></i>
            <span>Contact Management</span>
            @php
                $newContactsCount = \App\Models\ContactSubmission::where('status', 'new')->count();
            @endphp
            @if($newContactsCount > 0)
                <span class="notification-badge ml-2 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
                    {{ $newContactsCount }}
                </span>
            @endif
        </div>
        <i id="contact-management-icon" class="fas fa-chevron-down text-xs transition-transform duration-200"></i>
    </button>
    <div id="contact-management-dropdown" class="dropdown-content pl-4 mt-1 space-y-1">        <a href="{{ route('admin.contact-submissions.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.contact-submissions.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            <i class="fas fa-inbox w-5 h-5 mr-3 text-center"></i>
            <span>Contact Submissions</span>
            @if($newContactsCount > 0)
                <span class="notification-badge ml-2 inline-flex items-center justify-center px-2 py-0.5 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
                    {{ $newContactsCount }}
                </span>
            @endif
        </a>
        <a href="{{ route('admin.email-subscriptions.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.email-subscriptions.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            <i class="fas fa-envelope-open w-5 h-5 mr-3 text-center"></i>
            <span>Email Subscriptions</span>
        </a>
        <a href="{{ route('admin.contact-settings.index') }}" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg {{ request()->routeIs('admin.contact-settings.*') ? 'bg-gray-900 text-white' : 'text-gray-400 hover:bg-gray-700 hover:text-white' }}">
            <i class="fas fa-cog w-5 h-5 mr-3 text-center"></i>
            <span>Contact Settings</span>
        </a>
    </div>
</div>
                </div>
            </nav>
            
            <!-- Logout Section -->
            <div class="mt-auto px-3 py-4 border-t border-gray-700">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="sidebar-menu-item flex items-center px-3 py-2 text-sm font-medium rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white">
                    <i class="fas fa-sign-out-alt w-5 h-5 mr-3 text-center"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
        </aside>
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col md:ml-64">
            <!-- Top Navigation -->
            <header class="z-10 py-3 bg-white shadow-sm">
                <div class="px-4 flex items-center justify-between">
                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="md:hidden flex items-center justify-center h-10 w-10 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
    <i class="fas fa-bars text-xl"></i>
</button>
                    
                    <button id="close-sidebar-button" class="absolute top-4 right-4 md:hidden text-gray-400 hover:text-white focus:outline-none">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                    
                    <!-- Right side elements -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        
                        
                        <!-- View Site -->
                        <a href="{{ route('home') }}" target="_blank" class="p-1 rounded-full text-gray-500 hover:text-gray-900 focus:outline-none" title="View Website">
                            <i class="fas fa-external-link-alt text-xl"></i>
                        </a>
                        
                    </div>
                </div>
            </header>
            
            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-4 bg-gray-50">
                <!-- Breadcrumbs -->
                <div class="mb-6">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">                                <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-primary-500">
                                    <i class="fas fa-home mr-2"></i>
                                    Dashboard
                                </a>
                            </li>
                            <!-- Add dynamic breadcrumbs as needed -->
                        </ol>
                    </nav>
                </div>
                
                <!-- Flash Messages -->
                @if(session('success'))
                <div class="flash-message mb-6 bg-green-100 border-l-4 border-green-500 rounded-r-lg p-4 shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-500 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button onclick="this.parentNode.parentNode.parentNode.remove()" class="text-green-500 hover:text-green-700 focus:outline-none">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                @if(session('error'))
                <div class="flash-message mb-6 bg-red-100 border-l-4 border-red-500 rounded-r-lg p-4 shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 text-lg"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button onclick="this.parentNode.parentNode.parentNode.remove()" class="text-red-500 hover:text-red-700 focus:outline-none">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Page Title -->
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-sm text-gray-600">@yield('page-description', 'Welcome to Admin Panel')</p>
                </div>
                
                <!-- Main Content Area -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    @yield('content')
                </div>
            </main>
            
            <!-- Footer -->
            <footer class="bg-white p-4 border-t border-gray-200">
                <div class="text-center text-sm text-gray-500">
                    <p>&copy; {{ date('Y') }} {{ setting('company_name', 'MyTravel') }}. All rights reserved.</p>
                </div>
            </footer>
        </div>
    </div>
    
    <script>
        // Mobile menu toggle
      // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.remove('-translate-x-full');
    });
    
    // Close sidebar on mobile
    document.getElementById('close-sidebar-button').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.add('-translate-x-full');
    });
    
    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        
        // Only apply this on mobile screens
        if (window.innerWidth < 768) {
            // If click is outside sidebar and not on the menu button
            if (!sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        }
    });
        
        // Dropdown toggle
        function toggleDropdown(id) {
            const dropdown = document.getElementById(`${id}-dropdown`);
            const icon = document.getElementById(`${id}-icon`);
            
            dropdown.classList.toggle('show');
            icon.classList.toggle('rotate-180');
            
            // Close other dropdowns
            const allDropdowns = document.querySelectorAll('.dropdown-content');
            const allIcons = document.querySelectorAll('[id$="-icon"]');
            
            allDropdowns.forEach(el => {
                if (el.id !== `${id}-dropdown` && el.classList.contains('show')) {
                    el.classList.remove('show');
                }
            });
            
            allIcons.forEach(el => {
                if (el.id !== `${id}-icon` && el.classList.contains('rotate-180')) {
                    el.classList.remove('rotate-180');
                }
            });
        }
        
        // Auto-expand current section
        document.addEventListener('DOMContentLoaded', function() {
            const currentPath = window.location.pathname;
            
            // Check each section for active links
            const sections = [
                'content-management',
                'vacation-packages',
                'customer-content',
                'user-management',
                'system'
            ];
            
            sections.forEach(section => {
                const dropdown = document.getElementById(`${section}-dropdown`);
                const links = dropdown.querySelectorAll('a');
                
                links.forEach(link => {
                    if (link.classList.contains('bg-gray-900')) {
                        dropdown.classList.add('show');
                        document.getElementById(`${section}-icon`).classList.add('rotate-180');
                    }
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>