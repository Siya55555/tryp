{{-- resources/views/bundles/show.blade.php --}}
@extends('layouts.app')

@section('title', $bundle->name)

@section('content')    <!-- Hero Section -->
    <section class="relative bg-blue-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img 
            src="{{ filter_var($bundle->hero_image, FILTER_VALIDATE_URL) ? $bundle->hero_image : asset($bundle->hero_image) }}" 

            alt="{{ $bundle->name }}" class="w-full h-full object-cover opacity-60">
            <div class="absolute inset-0 bg-gradient-to-t from-teal-500/80 to-transparent"></div>
        </div>

        <div class="container mx-auto px-4 py-16 md:py-20 relative z-10">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-8">
                <!-- Bundle Info -->
                <div class="text-white max-w-2xl">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-3 tracking-tight">{{ $bundle->name }}</h1>
                    <p class="text-lg md:text-xl opacity-90 mb-6">{{ $bundle->short_description }}</p>

                    @if($bundle->features)
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($bundle->features as $feature)
                                <span class="bg-yellow-400 text-blue-900 text-sm font-medium px-3 py-1 rounded-full shadow-sm">
                                    {{ $feature }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <div class="flex items-center">
                        <div class="flex text-yellow-400">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $bundle->rating ? '' : 'text-gray-300' }}"></i>
                            @endfor
                        </div>
                        <span class="ml-2 text-white text-sm font-medium">{{ $bundle->reviews_count }} Reviews</span>
                    </div>
                </div>

                <!-- Price Box -->
                <div class="bg-white p-6 rounded-2xl shadow-xl w-full lg:w-80">
                    <div class="text-center mb-4">
                        <div class="text-gray-600 text-sm uppercase font-medium">Bundle Price</div>                        <div class="flex items-baseline justify-center mt-2">
                            <div class="text-gray-500 line-through mr-2 text-lg">${{ number_format($bundle->original_price, 2) }}</div>
                            <div class="text-3xl font-bold text-blue-600">${{ number_format($bundle->price, 2) }}</div>
                        </div>
                    </div>                    <a href="#booking-form" class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 rounded-lg font-semibold transition-colors shadow-md">
                        Book Now
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Destinations Section -->
    @foreach($bundle->destinations as $index => $destination)
        <section id="destination-{{ $index + 1 }}" class="py-16 {{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }}">            <div class="container mx-auto px-4 max-w-7xl">                <h2 class="text-3xl md:text-4xl font-bold text-blue-600 mb-8">
                    Destination #{{ $index + 1 }} - {{ $destination->name }}
                </h2>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="{{ $index % 2 === 0 ? 'lg:col-span-1 lg:order-1' : 'lg:col-span-1 lg:order-2' }}">                        <div class="bg-gradient-to-b from-blue-600 to-blue-800 rounded-t-xl px-6 py-4">
                            <h3 class="text-white text-xl font-bold">{{ $destination->name }}</h3>
                        </div>
                        <div class="bg-white border border-gray-200 rounded-b-xl shadow-lg p-6">
                            <h4 class="text-gray-700 font-semibold mb-4">What's Included</h4>
                            <ul class="space-y-3 text-gray-700">
                            @if(!empty($destination->included_items))
                                <ul class="space-y-3 text-gray-700">
                                    @foreach(is_array($destination->included_items) ? $destination->included_items : explode(',', $destination->included_items) as $item)                                        <li class="flex items-start">
                                            <i class="fas fa-check-circle text-blue-600 mt-1 mr-3"></i>
                                            <span>{{ trim($item) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            </ul>
                            @if($destination->restrictions)
                                <div class="mt-6 border-t border-gray-200 pt-4">
                                    <p class="text-sm text-gray-600">{{ $destination->restrictions }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="{{ $index % 2 === 0 ? 'lg:col-span-2 lg:order-2' : 'lg:col-span-2 lg:order-1' }}">
                        <div class="rounded-xl overflow-hidden shadow-lg">
                            <img src="{{ $destination->main_image }}" alt="{{ $destination->name }}" class="w-full h-64 md:h-80 object-cover">
                        </div>                        <div class="mt-6">
                            <h3 class="text-2xl font-bold text-blue-600 mb-3">{{ $destination->name }}, {{ $destination->location }}</h3>
                            <p class="text-gray-700 mb-6">{{ $destination->description }}</p>

                            @if($destination->gallery)
                                <div class="grid grid-cols-4 gap-3">
                                    @foreach(is_array($destination->gallery) ? $destination->gallery : json_decode($destination->gallery, true) as $image)
                                        <div class="relative rounded-lg overflow-hidden shadow-md">
                                            <img src="{{ $image }}" 
                                                alt="{{ $destination->name }}" 
                                                class="w-full h-24 object-cover hover:opacity-90 transition-opacity duration-300 cursor-pointer">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach

   <!-- Booking Form -->
   <section id="booking-form" class="py-16 bg-yellow-100">
        <div class="container mx-auto px-4 max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <!-- Bundle Summary -->
                <div>                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <h2 class="text-2xl font-bold text-blue-600 mb-4">{{ $bundle->name }}</h2>
                        <img
                        src="{{ filter_var($bundle->card_image, FILTER_VALIDATE_URL) ? $bundle->card_image : asset($bundle->card_image) }}" 

                        alt="{{ $bundle->name }}"
                             class="w-full h-48 object-cover rounded-lg mb-4">
                        <p class="text-gray-700">{{ $bundle->description }}</p>
                    </div>
                </div>

                <!-- Form -->
<div>                    <div class="bg-white p-6 rounded-2xl shadow-lg">
                        <h2 class="text-2xl font-bold text-blue-600 mb-4">Learn More About This Bundle</h2>
                        <p class="text-gray-600 mb-6">Fill out the form, and a vacation specialist will contact you within 24 hours.</p>
                       <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                                @csrf

                                <!-- Name Fields -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">                                    <div>
                                        <label for="first-name" class="block text-sm font-medium text-primary-800 mb-1">FIRST NAME <span class="text-red-500">*</span></label>
                                        <input type="text" name="first_name" id="first-name" 
                                            value="{{ old('first_name') }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('first_name') border-red-500 @enderror" 
                                            required>
                                        @error('first_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>                                    <div>
                                        <label for="last-name" class="block text-sm font-medium text-primary-800 mb-1">LAST NAME <span class="text-red-500">*</span></label>
                                        <input type="text" name="last_name" id="last-name" 
                                            value="{{ old('last_name') }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('last_name') border-red-500 @enderror" 
                                            required>
                                        @error('last_name')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email and Phone -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">                                    <div>
                                        <label for="email" class="block text-sm font-medium text-primary-800 mb-1">EMAIL <span class="text-red-500">*</span></label>
                                        <input type="email" name="email" id="email" 
                                            value="{{ old('email') }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('email') border-red-500 @enderror" 
                                            required>
                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-primary-800 mb-1">PHONE <span class="text-red-500">*</span></label>
                                        <input type="tel" name="phone" id="phone" 
                                            value="{{ old('phone') }}"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('phone') border-red-500 @enderror" 
                                            required>
                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Package Holder Radio Buttons -->
                                <div>                                    <label class="block text-sm font-medium text-primary-800 mb-2">ARE YOU A CURRENT PACKAGE HOLDER? <span class="text-red-500">*</span></label>
                                    <div class="flex items-center space-x-6">
                                        <div class="flex items-center">
                                            <input type="radio" id="package-no" name="package_holder" value="no" 
                                                class="h-4 w-4 text-primary-600" 
                                                {{ old('package_holder', 'no') === 'no' ? 'checked' : '' }}>
                                            <label for="package-no" class="ml-2 text-sm text-gray-700">No</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input type="radio" id="package-yes" name="package_holder" value="yes" 
                                                class="h-4 w-4 text-primary-600"
                                                {{ old('package_holder') === 'yes' ? 'checked' : '' }}>
                                            <label for="package-yes" class="ml-2 text-sm text-gray-700">Yes</label>
                                        </div>
                                    </div>
                                    @error('package_holder')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Message Textarea -->
                                <div>                                    <label for="message" class="block text-sm font-medium text-primary-800 mb-1">MESSAGE <span class="text-red-500">*</span></label>
                                    <textarea name="message" id="message" rows="5" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('message') border-red-500 @enderror" 
                                        required>{{ old('message') }}</textarea>
                                    @error('message')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Consent Checkbox -->
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">                                        <input id="consent" name="consent" type="checkbox" 
                                            class="h-4 w-4 text-primary-600 border-gray-300 rounded @error('consent') border-red-500 @enderror" 
                                            {{ old('consent') ? 'checked' : '' }} 
                                            required>
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="consent" class="text-gray-700">I consent to receive telephone sales calls, marketing calls and messages, including prerecorded messages and text messages from MyTravel Reservations Group and its partners, agents or affiliates at the phone number(s)/wireless numbers provided above regarding offers, products and services, including through an automated telephone dialing system. I understand that I am not required to provide this consent to make a purchase from MyTravel.</label>
                                    </div>
                                </div>                                @error('consent')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                <!-- Cloudflare Turnstile Captcha -->
                                <div class="my-4">
                                    <x-captcha />
                                </div>

                                <!-- Success/Error Messages -->
                                @if(session('success'))
                                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                                        <p class="text-green-700">{{ session('success') }}</p>
                                    </div>
                                @endif
                                @if(session('error'))
                                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                                        <p class="text-red-700">{{ session('error') }}</p>
                                    </div>
                                @endif

                                <!-- Submit Button -->
                                <div class="flex justify-end">                                    <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700  rounded-full font-semibold text-white hover:bg-primary-700 transition-colors">
                                        SUBMIT
                                    </button>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </section>

  <!-- Gallery Section -->
  <section class="py-16 bg-white">            <div class="container mx-auto px-4 max-w-7xl">
                <h2 class="text-3xl md:text-4xl font-bold text-blue-600 mb-10 text-center">Explore the Destinations</h2>
                <div class="relative rounded-xl overflow-hidden shadow-xl mb-6">
                    <img 
                    src="{{ filter_var($bundle->gallery_main_image, FILTER_VALIDATE_URL) ? $bundle->gallery_main_image : asset($bundle->gallery_main_image) }}" 

                     alt="{{ $bundle->name }}"
                         class="w-full h-80 md:h-96 object-cover gallery-main-image transition-opacity duration-300">
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    @foreach($bundle->gallery as $image)
                        <div class="rounded-lg overflow-hidden shadow-md">
                            <img 
                            src="{{ filter_var($image, FILTER_VALIDATE_URL) ? $image : asset($image) }}" 

                             alt="{{ $bundle->name }}"
                                 class="w-full h-24 md:h-32 object-cover cursor-pointer hover:opacity-80 transition-all duration-300 gallery-image">
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    <x-testimonials :testimonials="$testimonials" />
    <x-why-travel :whyChooseUs="$whyChooseUs" />
    <x-vacations-booked-counter />
@endsection

    @push('styles')
        <style>
            /* Smooth Scroll */
            html {
                scroll-behavior: smooth;
            }

            /* Testimonial Card Animation */
            .testimonial-card {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .testimonial-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            /* Gallery Image Effects */
            .gallery-image {
                transition: transform 0.3s ease, opacity 0.3s ease;
            }

            .gallery-image:hover {
                transform: scale(1.05);
            }

            /* Form Input Focus */
            input:focus, textarea:focus {
                outline: none;
            }

            /* Text Truncation */
            .line-clamp-4 {
                display: -webkit-box;
                -webkit-line-clamp: 4;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            /* Responsive Adjustments */
            @media (max-width: 640px) {
                .hero-section h1 {
                    font-size: 2.25rem;
                }

                .price-box {
                    width: 100%;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                // Gallery Image Click Handler
                const galleryImages = document.querySelectorAll('.gallery-image');
                const mainImage = document.querySelector('.gallery-main-image');

                galleryImages.forEach(image => {
                    image.addEventListener('click', () => {
                        mainImage.src = image.src;
                        mainImage.classList.add('opacity-0');
                        setTimeout(() => mainImage.classList.remove('opacity-0'), 100);                        galleryImages.forEach(img => img.classList.remove('ring-2', 'ring-blue-500'));
                        image.classList.add('ring-2', 'ring-blue-500');
                    });
                });

                // Smooth Scroll for Anchor Links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', e => {
                        e.preventDefault();
                        const targetId = anchor.getAttribute('href');
                        const targetElement = document.querySelector(targetId);
                        if (targetElement) {
                            window.scrollTo({
                                top: targetElement.offsetTop - 80,
                                behavior: 'smooth'
                            });
                        }
                    });
                });
            });
        </script>
    @endpush