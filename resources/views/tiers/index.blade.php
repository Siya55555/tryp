@extends('layouts.app')

@section('title', 'Book Your Dream Vacation')

@section('content')
 <!-- Hero Section with Auto Sliding Background -->
 <section class="hero-slider pt-24 pb-40 flex items-center justify-center relative overflow-hidden">    <!-- Background Image Slideshow -->
    <div class="slideshow-container absolute inset-0">
        <div class="slideshow-slide absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                alt="Contact Us Hero 1" 
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
        <!-- Adjusted gradient overlay for better contrast -->
        <div class="absolute inset-0 bg-gradient-to-t from-teal-500/90 to-primary-600/30 z-10"></div>
    </div>

    <!-- Hero Content -->
    <div class="container mx-auto px-4 pb-32 relative z-10">        <!-- Social sharing buttons -->
        <div class="flex justify-center mb-6 text-white">
            <button class="mx-2 p-2 bg-primary-700 bg-opacity-60 rounded-full hover:bg-opacity-80 transition-all duration-300">
                <i class="fas fa-share-alt"></i> Share Via Email
            </button>
            <button class="mx-2 p-2 px-3 bg-primary-700 bg-opacity-60 rounded-full hover:bg-opacity-80 transition-all duration-300">
                <i class="fab fa-facebook-f"></i>
            </button>
            <button class="mx-2 p-2 px-3 bg-primary-700 bg-opacity-60 rounded-full hover:bg-opacity-80 transition-all duration-300">
                <i class="fab fa-twitter"></i>
            </button>
            <button class="mx-2 p-2 px-3 bg-primary-700 bg-opacity-60 rounded-full hover:bg-opacity-80 transition-all duration-300">
                <i class="fab fa-pinterest-p"></i>
            </button>
        </div>

        <div class="text-center text-white mb-12 max-w-4xl mx-auto">
            <h1 class="text-3xl md:text-5xl font-bold mb-4 drop-shadow-lg">Unleash Your Inner Traveler With</h1>
            <p class="text-3xl md:text-5xl font-bold mb-8 drop-shadow-md">An 8 Day / 7 Night Vacation!</p>            <p class="text-lg md:text-xl mb-8 bg-primary-600 bg-opacity-40 inline-block px-4 py-2 rounded-full">
                (ONLINE SPECIAL ONLY)
            </p>
        </div>
        
        <div class="text-center text-white mb-8">
            <h2 class="text-2xl md:text-3xl font-semibold">CHOOSE YOUR PERFECT TRAVEL PLAN BELOW:</h2>
        </div>
    </div>
    <!-- Fixed wave at bottom of the section -->
    <div class="absolute bottom-0 left-0 right-0 w-full" style="z-index: 1;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none" style="width: 100%; height: 120px; display: block;">
            <path fill="#f7fafc" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>
<!-- Replace the static travel packages section in index.blade.php with this dynamic content -->

<!-- Travel Packages Section - Positioned to overlap with hero -->
<section class="py-0 -mt-32 relative z-20">
    <div class="container mx-auto px-4">
        <!-- Travel Packages -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($travelPackages as $package)
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all duration-300 hover:scale-105">
                    <div class="relative">
                        @if($package->image)
                            <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="w-full h-48 object-cover">
                        @else
                            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e" alt="{{ $package->name }}" class="w-full h-48 object-cover">
                        @endif
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-primary-800 to-transparent p-4">
                            <h3 class="text-2xl font-bold text-white">{{ strtoupper($package->name) }}</h3>
                        </div>
                        <div class="absolute top-4 right-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-full w-16 h-16 flex flex-col items-center justify-center text-center p-2 transform rotate-12 shadow-lg">
                            <span class="text-xs">FROM</span>
                            <span class="text-xl font-bold">${{ number_format($package->price, 0) }}</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="font-semibold text-gray-700 mb-4">PACKAGE INCLUDES:</p>
                        @if($package->features && count($package->features) > 0)
                            <ul class="space-y-2 mb-6">
                                @foreach($package->features as $feature)                            <li class="flex items-start">
                                        <i class="fas fa-check text-primary-600 mt-1 mr-2"></i>
                                        <span>{{ $feature }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-600 mb-6">Please contact us for package details.</p>
                        @endif
                        
                        <!-- Hidden Package Details -->
                        <div class="package-details-content hidden mb-6 overflow-hidden transition-all duration-300">
                            <p class="text-gray-700 mb-4">{{ $package->description }}</p>
                        </div>
                          <!-- Package Details Toggle -->
                        <div class="text-center mb-4">
                            <a href="#" class="text-primary-600 hover:text-primary-700 hover:underline flex items-center justify-center package-details-toggle">
                                <span>PACKAGE DETAILS</span>
                                <i class="fas fa-chevron-down ml-1 transition-transform duration-300"></i>
                            </a>
                        </div>
                        
                        <a href="{{ route('tiers.show', ['type' => $package->type]) }}" 
                           class="block w-full text-center py-3 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-full font-semibold hover:from-blue-700 hover:to-indigo-800 transition-colors shadow-lg">
                            SELECT PLAN
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- What Makes Our Travel So Great -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">            <div class="bg-gradient-to-r from-blue-600 to-teal-500 rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-white mb-6 text-center">WHAT MAKES OUR TRAVEL TIERS SO GREAT?</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-white text-xl mr-3 mt-1"></i>
                            <p class="text-white">Travel Where You Want, When You Want!</p>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-white text-xl mr-3 mt-1"></i>
                            <p class="text-white">Flexible Pricing For Travelers Of All Varieties!</p>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-white text-xl mr-3 mt-1"></i>
                            <p class="text-white">1000+ Destinations To Choose From!</p>
                        </div>
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-white text-xl mr-3 mt-1"></i>
                            <p class="text-white">Nothing Due At Time Of Booking!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Package Information -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-3xl font-bold text-primary-800 mb-6">With An 8 Day / 7 Night Monster Week Vacation Package, The Power Of Travel Is In Your Hands!</h2>
                
                <p class="text-gray-700 mb-6">Choose the tier that suits your travel needs best, and let us handle the rest. Visit the vibrant shores of California or the bustling streets of Las Vegas with a Signature Monster Week trip. Adventure to the vineyards of Italy or experience the grandeur of the Eiffel tower with an ultra premium trip.</p>
                
                <p class="text-gray-700 mb-6">Our Monster Week Vacation Package promises an unforgettable journey filled with excitement, discovery, and unbelievable experiences. Book now and let the adventure begin!</p>
            </div>
              <div class="aspect-video bg-gradient-to-br from-primary-600 to-teal-500 rounded-2xl shadow-2xl overflow-hidden relative">
                <img src="https://images.unsplash.com/photo-1547047549-0d757aaa848a" alt="Beach Vacation" class="w-full h-full object-cover opacity-80">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center text-white p-6 bg-primary-800 bg-opacity-40 rounded-xl backdrop-filter backdrop-blur-sm">
                        <h3 class="text-2xl font-bold mb-2">Ready to begin your adventure?</h3>
                        <p class="mb-4">Select one of our packages above to get started!</p>
                        <a href="#" class="inline-block px-6 py-3 bg-white text-primary-800 rounded-full font-bold hover:bg-primary-50 transition-colors">
                            <i class="fas fa-arrow-up mr-2"></i> View Packages
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<x-vacations-booked-counter />

<!-- Frequently Asked Questions -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">  
        
    <h2 class="text-3xl font-bold text-blue-600 mb-12 text-center">
            <span class="relative inline-block">
                Frequently Asked Questions
                <span class="absolute bottom-0 left-0 w-full h-1 bg-yellow-400"></span>
            </span>
        </h2>
    
        
        <div class="max-w-4xl mx-auto space-y-4">
            <!-- FAQ Item 1 -->
          @foreach($faqCategories as $category => $faqs)
                @foreach($faqs as $faq)
                    <div class="border border-gray-200 rounded-lg overflow-hidden faq-item" 
                         data-category="{{ Str::slug($category) }}">
                        <button class="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 transition-colors">
                            <span class="flex items-center text-left">                                <i class="fas fa-question-circle text-primary-700 mr-3"></i>
                                <span class="font-medium">{{ $faq->question }}</span>
                            </span>
                            <i class="fas fa-chevron-down text-primary-700"></i>
                        </button>
                        <div class="p-4 bg-white" style="display: none; max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out;">
                            <p class="text-gray-700">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>

<!-- Testimonials Section with Video Reviews -->
<section class="py-16 relative testimonials-section">    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop" alt="Beach Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-primary-900/70 to-teal-600/70"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-4xl font-bold text-white mb-8 text-center">
                SEE WHY GUESTS SAY THEY LOVE US!
            </h2>
            
            <div class="h-1 w-64 mx-auto bg-teal-400 rounded mb-12"></div>
            
            <!-- YouTube Channel Preview -->
            <div class="bg-white rounded-xl shadow-2xl overflow-hidden mb-10">
                <div class="p-4 bg-gray-100 border-b flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="{{ asset('https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=2080&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') }}" alt="Monster Reservations Group" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h3 class="font-bold text-gray-800">Monster Reservations Group</h3>
                            <p class="text-sm text-gray-500">969 Subscribers • 647 Videos • 187K Views</p>
                        </div>
                    </div>                    <a href="#" class="bg-primary-600 text-white px-4 py-2 rounded-md flex items-center hover:bg-primary-700">
                        <i class="fab fa-youtube mr-2"></i> Subscribe
                    </a>
                </div>
                
                <!-- Tabs -->                <div class="flex border-b">
                    <button class="py-3 px-6 font-medium text-primary-800 border-b-2 border-primary-600">Cabo San Lucas</button>
                    <button class="py-3 px-6 font-medium text-gray-600 hover:text-primary-800">Cancun</button>
                    <button class="py-3 px-6 font-medium text-gray-600 hover:text-primary-800">Puerto Vallarta</button>
                    <button class="py-3 px-6 font-medium text-gray-600 hover:text-primary-800">Punta Cana</button>
                </div>
                
                <!-- Videos Grid -->
<div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">                        <!-- Video 1 -->
                        <div class="relative rounded-lg overflow-hidden shadow-md group">
                            <div class="aspect-video bg-gray-200 relative">
                                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=2070&auto=format&fit=crop" alt="Testimonial Video" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                    <button class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center transform transition-transform group-hover:scale-110">
                                        <i class="fas fa-play text-white text-xl"></i>
                                    </button>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-primary-900/80 to-transparent">
                                    <div class="bg-teal-500 text-white px-3 py-1 rounded-full inline-block mb-2">
                                        Anthony P.
                                    </div>
                                    <h4 class="text-white font-bold text-xl">Cabo</h4>
                                    <p class="text-white/90">"they loved it"</p>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/70 text-white px-2 py-1 text-xs rounded">
                                    00:37
                                </div>
                            </div>
                        </div>
                          <!-- Video 2 -->
                        <div class="relative rounded-lg overflow-hidden shadow-md group">
                            <div class="aspect-video bg-gray-200 relative">
                                <img src="https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop" alt="Testimonial Video" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                    <button class="w-16 h-16 bg-primary-600 rounded-full flex items-center justify-center transform transition-transform group-hover:scale-110">
                                        <i class="fas fa-play text-white text-xl"></i>
                                    </button>
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-gradient-to-t from-primary-900/80 to-transparent">
                                    <div class="bg-teal-500 text-white px-3 py-1 rounded-full inline-block mb-2">
                                        Stephen Z.
                                    </div>
                                    <h4 class="text-white font-bold text-xl">Cabo</h4>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/70 text-white px-2 py-1 text-xs rounded">
                                    00:57
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                  <!-- Pagination -->
                <div class="flex justify-center p-4 border-t">
                    <button class="w-8 h-8 bg-primary-600 text-white rounded-full mx-1">1</button>
                    <button class="w-8 h-8 bg-gray-200 text-gray-700 rounded-full mx-1 hover:bg-gray-300">2</button>
                    <button class="w-8 h-8 bg-gray-200 text-gray-700 rounded-full mx-1 hover:bg-gray-300">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .testimonials-section {
        min-height: 90vh;
    }
    
    @media (max-width: 768px) {
        .testimonials-section {
            min-height: auto;
        }
    }
</style>

<!-- Email Subscription - Modern Design -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <div class="mb-10">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">
                    Stay <span class="text-blue-600">Informed</span>
                </h2>
                <p class="text-gray-600 text-lg">
                    We are continually adding new and exciting destinations along with special offers to our email list. Please sign up below to stay informed and up to date with our newest offers!
                </p>
            </div>

            <form id="newsletter-form" class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto sm:max-w-xl">
                @csrf
                <input 
                    type="email" 
                    name="email"
                    id="newsletter-email"
                    placeholder="Your email address" 
                    class="px-5 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500 w-full"
                    required
                >
                <button 
                    type="submit"
                        class="btn-primary text-white font-semibold px-6 py-3 rounded-lg transition duration-300 whitespace-nowrap">
                
                    Subscribe
                </button>
            </form>

            <p class="text-sm text-gray-500 mt-4">
                We respect your privacy. Unsubscribe anytime.
            </p>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    /* Hero Background Slider Styles */
    .hero-slider {
        position: relative;
    }
    
    .slider-container {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
    }
    
    .slider-track {
        position: relative;
        height: 100%;
        width: 100%;
    }
    
    .slider-item {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    
    .slider-item.active {
        opacity: 1;
    }
    
    .slider-dot {
        width: 12px;
        height: 12px;
        background-color: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        margin: 0 5px;
        cursor: pointer;
        border: 2px solid white;
        transition: background-color 0.3s ease;
    }
    
    .slider-dot.active {
        background-color: white;
    }
    
    /* Custom gradient background for hero section */
    .hero-gradient {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.8), rgba(16, 185, 129, 0.8));
    }
    
    /* Package Details Animation */
    .package-details-content {
        max-height: 0;
        transition: max-height 0.5s ease-out, opacity 0.3s ease-out, margin 0.3s ease-out;
        opacity: 0;
    }
    
    .package-details-content.active {
        max-height: 500px;
        opacity: 1;
        margin-bottom: 1.5rem;
    }
</style>
@endpush

@push('scripts')
<script>
    // Hero Background Slider Functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Background Slider (Adjusting to match the slideshow-slide classes)
        const slideshowSlides = document.querySelectorAll('.slideshow-slide');
        let currentSlide = 0;
        
        function showSlide(index) {
            slideshowSlides.forEach((slide, i) => {
                slide.classList.toggle('opacity-100', i === index);
                slide.classList.toggle('opacity-0', i !== index);
            });
            currentSlide = index;
        }
        
        function nextSlide() {
            let next = currentSlide + 1;
            if (next >= slideshowSlides.length) {
                next = 0;
            }
            showSlide(next);
        }
        
        // Start auto-slide
        let slideInterval = setInterval(nextSlide, 5000);
        
        // FAQ accordion functionality
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const button = item.querySelector('button');
            const content = item.querySelector('div.p-4');
            const icon = button.querySelector('.fas.fa-chevron-down');
            
            button.addEventListener('click', function() {
                // Toggle display
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    content.style.display = 'none';
                    icon.classList.remove('transform', 'rotate-180');
                } else {
                    content.style.display = 'block';
                    content.style.maxHeight = content.scrollHeight + 'px';
                    icon.classList.add('transform', 'rotate-180');
                }
            });
        });
        
        // Package details toggle functionality
        const packageDetailsToggles = document.querySelectorAll('.package-details-toggle');
        
        packageDetailsToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const icon = this.querySelector('i');
                // The details content is now previous to the toggle button
                const detailsContent = this.closest('div').previousElementSibling;
                
                // Toggle icon rotation and details visibility
                if (detailsContent.classList.contains('hidden')) {
                    // Show details
                    detailsContent.classList.remove('hidden');
                    detailsContent.classList.add('active');
                    icon.classList.add('transform', 'rotate-180');
                    
                    // Set timeout to allow transition to happen
                    setTimeout(() => {
                        detailsContent.style.maxHeight = detailsContent.scrollHeight + 'px';
                    }, 10);
                } else {
                    // Hide details
                    detailsContent.classList.remove('active');
                    detailsContent.style.maxHeight = '0px';
                    icon.classList.remove('transform', 'rotate-180');
                    
                    // Set timeout to allow transition to complete before hiding
                    setTimeout(() => {
                        detailsContent.classList.add('hidden');
                    }, 500);
                }
            });
        });
    });
</script>
@endpush