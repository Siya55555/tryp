@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <!-- Hero Section with Auto Sliding Background -->
    <section class="relative h-64 md:h-96 overflow-hidden">
        <!-- Background Image Slideshow -->
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
            </div>            <!-- Adjusted gradient overlay for better contrast -->
            <div class="absolute inset-0 bg-gradient-to-t from-primary-900/90 to-primary-600/30 z-10"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="container mx-auto px-4 h-full flex items-center justify-center relative z-20">
            <h1 class="text-4xl md:text-6xl font-bold text-white text-center drop-shadow-lg">Contact Us</h1>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-12 bg-gray-50 relative">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-10 -mt-16 md:-mt-24 relative z-20">                <h2 class="text-2xl md:text-3xl font-bold text-primary-800 text-center mb-6">
                    <span class="relative inline-block">
                        AT MYTRAVEL, OUR COMMITMENT IS TO YOU
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-teal-400"></span>
                    </span>
                </h2>

                <div class="border-b border-gray-200 w-full max-w-xl mx-auto mb-8"></div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                    <!-- Left Side: Contact Info -->
                    <div class="space-y-8">
                        @php
                            $contactSettings = App\Models\Admin\ContactSettings::first() ?? new App\Models\Admin\ContactSettings();
                        @endphp                        <!-- Service Number -->
                        @if($contactSettings->service_number)
                        <div>
                            <h3 class="text-lg font-bold text-primary-800 uppercase mb-1">Service Number</h3>
                            <p class="text-gray-700">CALL US AT: <a href="tel:{{ preg_replace('/[^0-9]/', '', $contactSettings->service_number) }}" class="text-primary-600 hover:underline font-medium">{{ $contactSettings->service_number }}</a></p>
                        </div>
                        @endif                        <!-- Sales Office -->
                        @if($contactSettings->sales_office_number)
                        <div>
                            <h3 class="text-lg font-bold text-primary-800 uppercase mb-1">Sales Office</h3>
                            <p class="text-gray-700">CALL US AT: <a href="tel:{{ preg_replace('/[^0-9]/', '', $contactSettings->sales_office_number) }}" class="text-primary-600 hover:underline font-medium">{{ $contactSettings->sales_office_number }}</a></p>
                        </div>
                        @endif                        <!-- MyTravel Reservations Group -->
                        @if($contactSettings->po_box_address)
                        <div>
                            <h3 class="text-lg font-bold text-primary-800 uppercase mb-1">MyTravel Reservations Group</h3>
                            <address class="not-italic text-gray-700">
                                {{ $contactSettings->po_box_address }}
                            </address>
                        </div>
                        @endif                        <!-- Hours -->
                        <div>
                            <h3 class="text-lg font-bold text-primary-800 uppercase mb-1">Hours</h3>
                            @if($contactSettings->work_hours_weekday)
                            <p class="text-gray-700">{{ $contactSettings->work_hours_weekday }}</p>
                            @endif
                            @if($contactSettings->work_hours_weekend)
                            <p class="text-gray-700">{{ $contactSettings->work_hours_weekend }}</p>
                            @endif
                        </div>                        <!-- Email -->
                        @if($contactSettings->contact_email)
                        <div>
                            <h3 class="text-lg font-bold text-primary-800 uppercase mb-1">Email</h3>
                            <p class="text-gray-700">
                                <a href="mailto:{{ $contactSettings->contact_email }}" class="text-primary-600 hover:underline">{{ strtoupper($contactSettings->contact_email) }}</a>
                            </p>
                        </div>
                        @endif
                    </div>

                    <!-- Right Side: Contact Form -->
                    <div class="flex justify-center items-center">
                        <div class="w-full max-w-md">
                            <h3 class="text-2xl font-bold text-primary-800 text-center mb-6">Send Us a Message</h3>
                            
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

    <x-vacations-booked-counter />

@endsection

@push('scripts')
    <script>
        // Hero section slideshow functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.slideshow-slide');
            let currentSlide = 0;
            
            function showSlide(index) {
                // Hide all slides
                slides.forEach(slide => {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0');
                });
                
                // Show current slide
                slides[index].classList.remove('opacity-0');
                slides[index].classList.add('opacity-100');
            }
            
            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }
            
            // Initial display
            showSlide(currentSlide);
            
            // Auto-rotate every 5 seconds
            setInterval(nextSlide, 5000);
        });
    </script>
@endpush