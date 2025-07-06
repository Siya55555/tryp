@extends('layouts.app')

@section('title', $privacy->meta_title ?? 'Privacy Policy')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-64 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1556761175-4b46a572b786?q=80&w=1974&auto=format&fit=crop" 
                alt="Privacy Policy Hero" 
                class="w-full h-full object-cover">
            <!-- Adjusted gradient overlay for better contrast -->
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 to-blue-600/30"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="container mx-auto px-4 h-full flex items-center justify-center relative z-20">
            <h1 class="text-4xl md:text-6xl font-bold text-white text-center drop-shadow-lg">{{ $privacy->title }}</h1>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-10 -mt-16 relative z-20">
                <div class="text-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-blue-600 mb-3">
                        <span class="relative inline-block">
                            OUR COMMITMENT TO PRIVACY
                            <span class="absolute bottom-0 left-0 w-full h-1 bg-teal-400"></span>
                        </span>
                    </h2>
                    <div class="border-b border-gray-200 w-full max-w-xl mx-auto mt-6"></div>
                </div>

                <div class="space-y-6 text-gray-700">
                    {!! $privacy->content !!}
                </div>
                
                <div class="mt-10 border-t border-gray-200 pt-6">
                    <div class="text-center text-gray-600">
                        <p class="text-sm">THIS ADVERTISING MATERIAL IS BEING USED FOR THE PURPOSE OF SOLICITING SALES OF VACATION OWNERSHIP INTERESTS OR PLANS.</p>
                        <p class="text-sm mt-2">FLORIDA SELLER OF TRAVEL LICENSE NO. ST42014</p>
                        <p class="text-sm">CALIFORNIA SELLER OF TRAVEL LICENSE NO. 2153955-50</p>
                        <p class="text-sm">WASHINGTON UBI #: 603-218-630</p>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-vacations-booked-counter />
@endsection