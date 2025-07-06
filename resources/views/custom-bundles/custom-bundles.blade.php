@extends('layouts.app')

@section('title', 'Build Your Own Custom Bundle')

@section('content')

<section class="hero-slider pt-24 pb-40 flex items-center justify-center relative overflow-hidden">
    <!-- Background Image Slideshow -->
    <div class="slideshow-container absolute inset-0">
        <div class="slideshow-slide absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out">
            <img src="https://images.unsplash.com/photo-1523592121529-f6dde35f079e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                 alt="Overwater Bungalows" 
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
        </div>        <!-- Updated gradient overlay for blue dominance with yellow hint -->
        <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 to-blue-500/20 z-10"></div>
    </div>

    <!-- Hero Content -->
    <div class="container mx-auto px-4 pb-32 relative z-10">        <!-- Social sharing buttons -->
        <div class="flex justify-center mb-6 text-white">
            <button class="mx-2 p-2 bg-blue-600 bg-opacity-60 rounded-full hover:bg-yellow-400 hover:bg-opacity-80 transition-all duration-300">
                <i class="fas fa-share-alt"></i> Share Via Email
            </button>
            <button class="mx-2 p-2 px-3 bg-blue-600 bg-opacity-60 rounded-full hover:bg-yellow-400 hover:bg-opacity-80 transition-all duration-300">
                <i class="fab fa-facebook-f"></i>
            </button>
            <button class="mx-2 p-2 px-3 bg-blue-600 bg-opacity-60 rounded-full hover:bg-yellow-400 hover:bg-opacity-80 transition-all duration-300">
                <i class="fab fa-twitter"></i>
            </button>
            <button class="mx-2 p-2 px-3 bg-blue-600 bg-opacity-60 rounded-full hover:bg-yellow-400 hover:bg-opacity-80 transition-all duration-300">
                <i class="fab fa-pinterest-p"></i>
            </button>
        </div>

        <div class="text-center text-white mb-12 max-w-4xl mx-auto">
            <h1 class="text-5xl md:text-6xl font-bold mb-4 drop-shadow-lg">Build Your Own Custom Bundle</h1>
            <p class="text-xl md:text-2xl mb-8 drop-shadow-md">DESIGN YOUR PERFECT TRAVEL PACKAGE BELOW:</p>
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

<!-- Travel Packages Section - Positioned to overlap with hero -->
<section class="py-0 -mt-32 relative z-20 mb-40">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-6xl mx-auto">
            @foreach($bundleTypes as $bundleType)
                <div class="bg-white rounded-t-lg overflow-hidden shadow-xl">                    <!-- Header -->
                    <div class="bg-blue-600 text-white text-center py-6">
                        <h3 class="text-2xl font-bold uppercase">{{ $bundleType->name }}</h3>
                    </div>
                    
                    <!-- Image -->
                    <div class="h-64 overflow-hidden">
                        
                        <img 
                        src="{{ filter_var($bundleType->image, FILTER_VALIDATE_URL) ? $bundleType->image : asset($bundleType->image) }}" 

                            alt="{{ $bundleType->name }} Destinations" 
                            class="w-full h-full object-cover">
                    </div>
        
                      <!-- Price -->
                    <div class="flex justify-center">
                        <div class="bg-blue-600 text-white w-32 h-32 rounded-full -mt-16 flex flex-col items-center justify-center border-4 border-white shadow-lg">
                            <span class="text-sm">$</span>
                            <span class="text-4xl font-bold">{{ number_format($bundleType->price, 0) }}</span>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <h4 class="text-center text-blue-600 font-semibold uppercase text-sm mb-4">Package Includes:</h4>
                        
                        @if(is_array($bundleType->features) && count($bundleType->features) > 0)
                            <div class="mb-6 space-y-4">
                                @foreach($bundleType->features as $index => $feature)
                                    <div class="text-center">
                                        @if($index === 0)
                                            <p class="font-semibold">Your Choice Of</p>
                                        @endif
                                        
                                        <p>{{ $feature }}</p>
                                        
                                        @if($index < count($bundleType->features) - 2)
                                            @if($index === 0)
                                                <p class="text-blue-600 font-bold text-lg italic mt-4">Plus...</p>
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="mb-6 text-center">
                                <p>Customized vacation package with premium experiences.</p>
                            </div>
                        @endif
                        
                        <div class="text-center">                            <a href="{{ route('custom-bundle.builder', ['type' => $bundleType->slug]) }}" class="inline-block bg-blue-600 text-white text-sm uppercase font-bold py-3 px-6 rounded-lg hover:bg-yellow-400 transition-colors">
                                Choose Destinations
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Vacations Booked Counter Component -->
<x-vacations-booked-counter />

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Slideshow functionality
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
        
        // Start slideshow
        setInterval(nextSlide, 5000);
    });
</script>
@endpush