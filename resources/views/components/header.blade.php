<header class="text-white shadow-lg w-full z-50" id="sticky-header" style="background: linear-gradient(to right, {{ $settings['header_bg_color_from'] ?? '#2563eb' }}, {{ $settings['header_bg_color_to'] ?? '#3b82f6' }})">
    <div class="container mx-auto px-4 py-2 flex justify-between items-center">
        <!-- Logo -->
        <div class="text-2xl font-bold">
            <a href="/" class="flex items-center space-x-2 transition transform hover:scale-105">
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
        
       <!-- Replace the current Desktop Navigation in header.blade.php with this: -->

<!-- Desktop Navigation -->
<nav class="hidden lg:flex items-center space-x-8">
    @foreach($mainNavigation as $navItem)
        @if($navItem->children->count() > 0)
            <!-- Dropdown Navigation Item -->
            <div class="relative uppercase dropdown-container">
                <button class="dropdown-toggle flex items-center py-2 space-x-1 font-medium  hover:secondary-text-color transition duration-300 ease-in-out">
                    <span>{{ $navItem->title }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <!-- Added invisible bridge element to prevent gap between nav and dropdown -->
                <div class="absolute w-full h-4 left-0 top-full"></div>
                <div class="dropdown-menu absolute left-0 mt-4 w-64 bg-white text-gray-800 shadow-xl rounded-lg overflow-hidden opacity-0 invisible transform origin-top scale-95 transition duration-300 ease-in-out z-50">
                    <div class="py-2">
                        @foreach($navItem->children as $childItem)                            <a href="{{ $childItem->url }}" target="{{ $childItem->target }}" class="block px-6 py-3 hover:text-primary-button-bg transition duration-200 ease-in-out">
                                <div class="font-medium">{{ $childItem->title }}</div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <!-- Standard Navigation Item -->
            <a href="{{ $navItem->url }}" target="{{ $navItem->target }}" class="py-2 hover:secondary-text-color   font-medium transition duration-300 ease-in-out ">{{ $navItem->title }}</a>
        @endif
    @endforeach
    
    <!-- Authentication Links -->
    @guest
        <a href="{{ route('login') }}" class="py-2 hover:secondary-text-color  font-medium transition duration-300 ease-in-out ">LOGIN</a>
    @else
        <div class="relative dropdown-container uppercase">
            <button class="dropdown-toggle flex items-center py-2 space-x-1 font-medium  hover:secondary-text-color transition duration-300 ease-in-out">
                <span class="uppercase">{{ Auth::user()->name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            </button>
            <div class="absolute w-full h-4 left-0 top-full"></div>
            <div class="dropdown-menu absolute right-0 mt-4 w-48 bg-white text-gray-800 shadow-xl rounded-lg overflow-hidden opacity-0 invisible transform origin-top scale-95 transition duration-300 ease-in-out z-50">
                <div class="py-2">
                    @if(Auth::user()->is_admin)                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:text-primary-button-bg transition duration-200 ease-in-out">
                            Admin Dashboard
                        </a>
                    @endif                    <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 hover:text-primary-button-bg transition duration-200 ease-in-out">
                        My Dashboard
                    </a>
                   
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf                        <button type="submit" class="w-full text-left px-4 py-2 hover:text-primary-button-bg transition duration-200 ease-in-out">
                            LOGOUT
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endguest
    <a href="/contact" class="bg-white text-primary-button-bg px-6 py-2 rounded-full font-bold shadow-md hover:bg-opacity-90 transition duration-300 ease-in-out transform hover:scale-105">CONTACT</a>
</nav>

<!-- Also update the Mobile Menu section with this: -->


        
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button" class="lg:hidden w-10 h-10 flex items-center justify-center text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>
    
    <!-- Mobile Menu -->
  
   <!-- Mobile Menu -->
<div id="mobile-menu" class="lg:hidden hidden shadow-inner" style="background: linear-gradient(to right, {{ $settings['header_bg_color_from'] ?? '#1d4ed8' }}, {{ $settings['header_bg_color_to'] ?? '#2563eb' }})">
    <div class="container uppercase mx-auto px-4 py-3 flex flex-col space-y-2">
        @foreach($mainNavigation as $navItem)
            @if($navItem->children->count() > 0)
                <!-- Mobile Dropdown -->
                <div class="mobile-dropdown">
                    <button class="w-full py-3 px-4 border-l-4 border-transparent hover:border-yellow-400 btn-primary hover:bg-primary-button-hover-bg rounded transition duration-300 ease-in-out flex justify-between items-center">
                        <span>{{ $navItem->title }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mobile-dropdown-icon transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                <div class="mobile-dropdown-content hidden rounded-b-lg mt-1 mb-2 bg-white text-gray-800"  >
                        @foreach($navItem->children as $childItem)
                            <a href="{{ $childItem->url }}" target="{{ $childItem->target }}" class="block py-3 px-8 text-sm hover:secondary-text-color transition duration-200 ease-in-out">{{ $childItem->title }}</a>
                        @endforeach
                    </div>
                </div>
            @else
                <a href="{{ $navItem->url }}" target="{{ $navItem->target }}" class="py-3 px-4 border-l-4 border-transparent hover:border-yellow-400 btn-primary hover:bg-primary-button-hover-bg rounded transition duration-300 ease-in-out">{{ $navItem->title }}</a>
            @endif
        @endforeach
        
        <!-- Mobile Authentication Links -->
        @guest
            <a href="{{ route('login') }}" class="py-3 px-4 border-l-4 border-transparent hover:border-white btn-primary hover:bg-primary-button-hover-bg rounded transition duration-300 ease-in-out">LOGIN</a>
            <a href="{{ route('register') }}" class="mt-2 bg-white text-primary-button-bg py-3 px-4 rounded-lg font-bold text-center shadow-md hover:bg-opacity-90">REGISTER</a>
        @else
            <div class="mobile-dropdown uppercase">
                <button class="w-full py-3 px-4 border-l-4 border-transparent hover:border-white btn-primary hover:bg-primary-button-hover-bg rounded transition duration-300 ease-in-out flex justify-between items-center">
                    <span>{{ Auth::user()->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mobile-dropdown-icon transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="mobile-dropdown-content hidden rounded-b-lg mt-1 mb-2 bg-white text-gray-800"  >
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="block py-3 px-8 text-sm hover:secondary-text-color transition duration-200 ease-in-out">Admin Dashboard</a>
                    @endif
                    <a href="{{ route('user.dashboard') }}" class="block py-3 px-8 text-sm hover:secondary-text-color transition duration-200 ease-in-out">My Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="block">
                        @csrf
                        <button type="submit" class="block w-full text-left py-3 px-8 text-sm hover:secondary-text-color transition duration-200 ease-in-out">LOGOUT</button>
                    </form>
                </div>
            </div>
        @endguest
    </div>
</div>
</header>

<!-- Style for the sticky header -->
<style>
    .sticky {
        position: fixed;
        top: 0;
        width: 100%;
        animation: slideDown 0.3s ease-in-out;
    }
    
/* Dropdown hover styles */
    .dropdown-container:hover .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: scale(1);
    }
    
    .dropdown-container:hover .dropdown-toggle svg {
        transform: rotate(180deg);
    }
    
    /* Animation for when the header becomes sticky */
    @keyframes slideDown {
        from {
            transform: translateY(-100%);
        }
        to {
            transform: translateY(0);
        }
    }
    
    /* Add padding to body only when header is sticky */
    body.has-sticky-header {
        padding-top: 80px; /* Adjust this value based on your header height */
    }
    
    /* Dynamic contact button */
    .text-primary-button-bg {
        color: var(--primary-button-bg, #2563eb);
    }
      .hover\:bg-opacity-90:hover {
        background-color: rgba(255, 255, 255, 0.9) !important;
    }
      
    /* Dynamic hover colors for dropdown items */
    .dropdown-menu a:hover {
        background-color: rgba(var(--primary-button-bg-rgb, 37, 99, 235), 0.1) !important;
        color: var(--primary-button-bg, #2563eb) !important;
    }
    
    /* Dynamic hover text color for nav items */
    nav a.hover\:text-blue-100:hover, 
    button.hover\:text-blue-100:hover {
        color: rgba(var(--primary-button-bg-rgb, 37, 99, 235), 0.9) !important;
    }
</style>

<!-- Script for Mobile Menu Toggle, Dropdown on Click, and Sticky Header on Scroll -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sticky Header on Scroll
        const header = document.getElementById('sticky-header');
        const headerHeight = header.offsetHeight;
        let lastScrollTop = 0;
        
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Make header sticky when scrolling down past header height
            if (scrollTop > headerHeight) {
                if (!header.classList.contains('sticky')) {
                    header.classList.add('sticky');
                    document.body.classList.add('has-sticky-header');
                }
            } else {
                // Remove sticky when back at the top
                header.classList.remove('sticky');
                document.body.classList.remove('has-sticky-header');
            }
            
            lastScrollTop = scrollTop;
        });
        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Mobile Dropdowns
        const mobileDropdowns = document.querySelectorAll('.mobile-dropdown');
        
        mobileDropdowns.forEach(dropdown => {
            const dropdownButton = dropdown.querySelector('button');
            const dropdownContent = dropdown.querySelector('.mobile-dropdown-content');
            const dropdownIcon = dropdown.querySelector('.mobile-dropdown-icon');
            
            dropdownButton.addEventListener('click', function() {
                dropdownContent.classList.toggle('hidden');
                dropdownIcon.classList.toggle('rotate-180');
            });
        });
        
        // Desktop Dropdowns - Improved hover behavior to prevent flickering
        const desktopDropdownContainers = document.querySelectorAll('.dropdown-container');
        
        desktopDropdownContainers.forEach(container => {
            const toggle = container.querySelector('.dropdown-toggle');
            const menu = container.querySelector('.dropdown-menu');
            
            // Track if we're hovering over either the toggle or the menu
            let isHovering = false;
            
            // Function to show the dropdown
            const showDropdown = () => {
                isHovering = true;
                menu.classList.remove('opacity-0', 'invisible', 'scale-95');
                menu.classList.add('opacity-100', 'visible', 'scale-100');
                toggle.querySelector('svg').classList.add('rotate-180');
            };
            
            // Function to hide the dropdown with delay
            const hideDropdown = () => {
                isHovering = false;
                
                // Give a short delay before hiding to improve user experience
                setTimeout(() => {
                    if (!isHovering) {
                        menu.classList.remove('opacity-100', 'visible', 'scale-100');
                        menu.classList.add('opacity-0', 'invisible', 'scale-95');
                        toggle.querySelector('svg').classList.remove('rotate-180');
                    }
                }, 150);
            };
            
            // Mouse events for toggle button
            toggle.addEventListener('mouseenter', showDropdown);
            toggle.addEventListener('mouseleave', hideDropdown);
            
            // Mouse events for menu
            menu.addEventListener('mouseenter', showDropdown);
            menu.addEventListener('mouseleave', hideDropdown);
            
            // Keep click functionality for touch devices
            toggle.addEventListener('click', function(event) {
                event.stopPropagation();
                
                const isVisible = menu.classList.contains('opacity-100');
                
                // Close all other dropdowns first
                desktopDropdownContainers.forEach(otherContainer => {
                    if (otherContainer !== container) {
                        const otherMenu = otherContainer.querySelector('.dropdown-menu');
                        const otherToggle = otherContainer.querySelector('.dropdown-toggle');
                        
                        otherMenu.classList.remove('opacity-100', 'visible', 'scale-100');
                        otherMenu.classList.add('opacity-0', 'invisible', 'scale-95');
                        otherToggle.querySelector('svg').classList.remove('rotate-180');
                    }
                });
                
                // Toggle current dropdown
                if (isVisible) {
                    menu.classList.remove('opacity-100', 'visible', 'scale-100');
                    menu.classList.add('opacity-0', 'invisible', 'scale-95');
                    toggle.querySelector('svg').classList.remove('rotate-180');
                } else {
                    menu.classList.remove('opacity-0', 'invisible', 'scale-95');
                    menu.classList.add('opacity-100', 'visible', 'scale-100');
                    toggle.querySelector('svg').classList.add('rotate-180');
                }
            });
        });
    });
</script>