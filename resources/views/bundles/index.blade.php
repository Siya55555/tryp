{{-- resources/views/bundles/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Vacation Bundles')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-64 md:h-96 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1503220317375-aaad61436b1b" alt="Vacation Bundles Hero" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-black/20"></div>
        </div>
        <div class="container mx-auto px-4 h-full flex items-center justify-center relative z-10">
            <div class="text-center">
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white drop-shadow-2xl tracking-tight">
                    Vacation Bundles
                </h1>
                <p class="mt-4 text-lg md:text-xl text-white/90 drop-shadow-md">
                    Find Your Perfect Getaway Package
                </p>
            </div>
        </div>
    </section>

    <!-- Bundles Grid -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($bundles as $bundle)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                        <div class="relative h-64">
                            <img src="{{ $bundle->card_image }}" alt="{{ $bundle->name }}" class="w-full h-full object-cover">
                            <div class="absolute top-0 right-0 bg-yellow-400 text-gray-900 font-semibold px-4 py-2 rounded-bl-lg">
                                ${{ number_format($bundle->price, 2) }}
                            </div>
                            @if($bundle->destinations->count() > 0)
                                <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-black/80 to-transparent p-4">
                                    <div class="text-white">
                                        <div class="font-medium">{{ $bundle->destinations->first()->name }}</div>
                                        <div class="text-sm opacity-80">{{ $bundle->destinations->first()->location }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $bundle->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $bundle->short_description }}</p>
                            
                            @if($bundle->features)
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach(array_slice($bundle->features, 0, 2) as $feature)
                                        <span class="bg-blue-100 text-blue-700 text-xs px-2.5 py-1 rounded-full">
                                            {{ $feature }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <div class="flex items-center justify-between">
                                <div class="flex items-center text-yellow-400">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $bundle->rating ? '' : 'text-gray-300' }}"></i>
                                    @endfor
                                    <span class="ml-1 text-sm text-gray-600">({{ $bundle->reviews_count }})</span>
                                </div>
                                <a href="{{ route('bundles.show', $bundle->slug) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-semibold hover:bg-blue-700 transition-colors">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $bundles->links() }}
            </div>
        </div>
    </section>

    <x-why-travel :whyChooseUs="$whyChooseUs" />
    <x-testimonials :testimonials="$testimonials" />
    <x-vacations-booked-counter />
@endsection

@push('styles')
    <style>
        /* Smooth Scroll Behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Slideshow Styling */
        .slideshow-container {
            z-index: 0;
        }

        .slideshow-slide img {
            transition: transform 10s ease-in-out;
        }

        .slideshow-slide:hover img {
            transform: scale(1.05);
        }

        /* Card Hover Effects */
        .bundle-card {
            position: relative;
            overflow: hidden;
        }

        .bundle-card::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to right,
                rgba(255, 255, 255, 0) 0%,
                rgba(255, 255, 255, 0.2) 50%,
                rgba(255, 255, 255, 0) 100%
            );
            transform: rotate(30deg);
            transition: transform 0.5s ease;
        }

        .bundle-card:hover::after {
            transform: rotate(30deg) translateX(200%);
        }

        /* Button Pulse Animation */
        .pulse {
            animation: pulse-animation 2s infinite;
        }

        @keyframes pulse-animation {
            0% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
            }
            70% {
                box-shadow: 0 0 0 12px rgba(59, 130, 246, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(59, 130, 246, 0);
            }
        }

        /* Text Truncation */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .slideshow-container {
                height: 100%;
            }

            .hero-content h1 {
                font-size: 2rem;
            }
        }

        @media (max-width: 375px) {
            .custom-bundle-section h2 {
                font-size: 1.75rem;
            }

            .custom-bundle-section p {
                font-size: 1rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Hero Slideshow
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelectorAll('.slideshow-slide');
            let currentSlide = 0;

            const showSlide = (index) => {
                slides.forEach((slide, i) => {
                    slide.classList.toggle('opacity-100', i === index);
                    slide.classList.toggle('opacity-0', i !== index);
                });
            };

            const nextSlide = () => {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            };

            showSlide(currentSlide);
            setInterval(nextSlide, 5000);
        });
    </script>
@endpush