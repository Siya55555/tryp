@extends('layouts.app')

@section('title', 'Your Custom Vacation Bundle')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-80 lg:h-96 overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            @if(isset($bundle->destinations[0]['image']))
                <img src="{{ $bundle->destinations[0]['image'] }}" 
                    alt="Destination" 
                    class="w-full h-full object-cover">
            @else
                <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                    alt="Default Destination" 
                    class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-b from-blue-900/40 to-blue-700/70"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="container mx-auto px-4 h-full flex items-center relative z-20">
            <div class="text-white max-w-3xl">
                <p class="uppercase font-bold mb-1">YOUR CUSTOM</p>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-3 uppercase">VACATION BUNDLE</h1>
                
                <div class="flex items-center space-x-2 mb-4">
                    @foreach($bundle->destinations as $index => $destination)
                        <div class="text-sm">
                            <span class="font-bold">{{ isset($destination['name']) ? explode(',', $destination['name'])[0] : 'Destination' }}</span>
                            @if(!$loop->last)
                                <span class="mx-2">•</span>
                            @endif
                        </div>
                    @endforeach
                </div>

               <!-- With this -->
<div class="flex space-x-4">
    <a href="#" class="text-white hover:text-yellow-400 transition-colors">
        <i class="fab fa-facebook-f"></i>
    </a>
    <a href="#" class="text-white hover:text-yellow-400 transition-colors">
        <i class="fab fa-instagram"></i>
    </a>
    <a href="#" class="text-white hover:text-yellow-400 transition-colors">
        <i class="fab fa-twitter"></i>
    </a>
</div>
            </div>
            
            <!-- Price Box -->
            <div class="absolute right-4 top-1/2 -translate-y-1/2 hidden lg:block">
                <div class="bg-black/70 p-6 rounded-lg text-white text-center">
                    <p class="text-sm font-semibold">{{ count($bundle->destinations) }} DESTINATIONS • WHITE GLOVE SERVICE FOR ONLY</p>
                    
                    <div class="flex items-baseline justify-center">
                        <span class="text-gray-400 text-sm line-through mr-2">${{ $bundle->price + 400 }}</span>
                        <span class="text-4xl sm:text-5xl font-bold">${{ $bundle->price }}</span>
                    </div>
                    
                    <a href="/login" class="block mt-3 bg-blue-600 hover:bg-yellow-400 transition-colors text-white text-sm font-bold py-2 px-4 rounded uppercase">
                        BOOK NOW
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mobile Price Box (for small screens) -->
    <div class="lg:hidden bg-black text-white text-center py-4 px-6">
        <p class="text-sm font-semibold">{{ count($bundle->destinations) }} DESTINATIONS • WHITE GLOVE SERVICE FOR ONLY</p>
        
        <div class="flex items-baseline justify-center">
            <span class="text-gray-400 text-sm line-through mr-2">${{ $bundle->price + 400 }}</span>
            <span class="text-4xl font-bold">${{ $bundle->price }}</span>
        </div>
        
        <a href="/login" class="inline-block mt-3 bg-blue-600 hover:bg-yellow-400 transition-colors text-white text-sm font-bold py-2 px-4 rounded uppercase">
            BOOK NOW
        </a>
    </div>

    <!-- Destinations Section -->
   
<!-- Destinations Section -->
<div class="bg-white py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        @foreach($bundle->destinations as $index => $destination)
            <div class="mb-10">
                <!-- Destination Title -->
                <h2 class="text-blue-600 text-2xl font-bold uppercase mb-2">
                    {{ isset($destination['name']) ? explode(',', $destination['name'])[0] : 'Destination' }}
                </h2>
                
                <div class="text-gray-600 mb-4">What's Included</div>
                
                <!-- Destination Content -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Details Card -->
                    <div class="{{ $index % 2 === 0 ? 'md:col-span-2 md:order-1' : 'md:col-span-2 md:order-2' }}">
                        <!-- Info box -->
                        <div class="mb-4">
                            <div class="bg-blue-600 text-white p-3 font-bold uppercase rounded-t-lg">
                                {{ isset($destination['name']) ? explode(',', $destination['name'])[0] : 'Destination' }}
                            </div>
                            <div class="border border-gray-200 rounded-b-lg p-4 bg-white">
                                <ul class="space-y-2">
                                    @if(isset($destination['details']) && isset($destination['details']['stay']))
                                        <li class="flex items-start">
                                            <i class="fas fa-calendar-alt text-blue-600 mt-1 mr-2"></i>
                                            <span>{{ $destination['details']['stay'] }}</span>
                                        </li>
                                    @endif
                                    
                                    @if(isset($destination['details']) && isset($destination['details']['accommodation']))
                                        <li class="flex items-start">
                                            <i class="fas fa-bed text-blue-600 mt-1 mr-2"></i>
                                            <span>{{ $destination['details']['accommodation'] }}</span>
                                        </li>
                                    @endif
                                    
                                    @if(isset($destination['details']) && isset($destination['details']['included']))
                                        @foreach($destination['details']['included'] as $included)
                                            <li class="flex items-start">
                                                <i class="fas fa-check-circle text-blue-600 mt-1 mr-2"></i>
                                                <span>{{ $included }}</span>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                        
                        <!-- Destination description -->
                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                {{ $destination['name'] ?? 'Destination' }}
                            </h3>
                            <p class="text-gray-600 mb-4">
                                   {{ $destination['description'] }}
                               
                            </p>
                            
                            <a href="#" class="inline-flex items-center justify-center bg-blue-600 hover:bg-yellow-400 text-white text-sm font-bold py-2 px-4 rounded uppercase">
                                BOOK NOW
                            </a>
                        </div>
                        
                        <!-- Destination gallery - Small thumbs -->
                        <div class="grid grid-cols-3 gap-2">
                            @if(isset($destination['gallery']) && is_array($destination['gallery']))
                                @foreach($destination['gallery'] as $galleryImage)
                                    <div class="h-24 rounded-lg overflow-hidden">
                                        <img src="{{ $galleryImage }}" 
                                            alt="{{ $destination['name'] ?? 'Destination' }}" 
                                            class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            @else
                                @for($i = 0; $i < 3; $i++)
                                    <div class="h-24 rounded-lg overflow-hidden">
                                        @if(isset($destination['image']))
                                            <img src="{{ $destination['image'] }}" 
                                                alt="{{ $destination['name'] ?? 'Destination' }}" 
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                                                alt="Default Destination" 
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                @endfor
                            @endif
                        </div>
                    </div>
                    
                    <!-- Main Image -->
                    <div class="{{ $index % 2 === 0 ? 'md:col-span-1 md:order-2' : 'md:col-span-1 md:order-1' }}">
                        <div class="rounded-lg overflow-hidden h-64 md:h-full">
                            @if(isset($destination['image']))
                                <img src="{{ $destination['image'] }}" 
                                    alt="{{ $destination['name'] ?? 'Destination' }}" 
                                    class="w-full h-full object-cover">
                            @else
                                <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                                    alt="Default Destination" 
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                    </div>
                </div>
                
                @if(!$loop->last)
                    <hr class="my-8 border-t border-gray-200">
                @endif
            </div>
        @endforeach
    </div>
</div>
    <!-- You Also Receive Section -->
    <section class="py-10 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <h2 class="text-blue-600 text-2xl font-bold uppercase mb-6">YOU ALSO RECEIVE...</h2>
            
            <div class="grid grid-cols-1  gap-6">
                @foreach($bundle->extras as $index => $extra)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
                        <div class="bg-blue-600 text-white p-3 font-bold uppercase">
                            {{ $extra['name'] }}
                        </div>
                        <div class="p-4 flex">
                            <div class="flex-grow pr-4">
                                @if(isset($extra['duration']))
                                    <p class="mb-2 font-medium"><i class="far fa-clock text-blue-600 mr-2"></i> {{ $extra['duration'] }}</p>
                                @endif
                                <p class="text-gray-600">{{ $extra['description'] }}</p>
                            </div>
                            <div class="hidden md:block w-1/3">
                                @if($index == 0)
                                    <img src="https://images.unsplash.com/photo-1548574505-5e239809ee19?q=80&w=2064&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                                        alt="{{ $extra['name'] }}" 
                                        class="w-full h-full object-cover rounded-lg">
                                @else
                                    <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                                        alt="{{ $extra['name'] }}" 
                                        class="w-full h-full object-cover rounded-lg">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-8 text-center">
                <a href="#" class="inline-block bg-blue-600 hover:bg-yellow-400 transition-colors text-white font-bold py-3 px-8 rounded uppercase">
                    BOOK YOUR CUSTOM BUNDLE
                </a>
            </div>
        </div>
    </section>

    <x-why-travel :whyChooseUs="$whyChooseUs" />

    <!-- Vacations Booked Counter Component -->
    <x-vacations-booked-counter />

@endsection

@push('styles')
<style>
/* Animation for testimonial cards */
.testimonial-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}

/* Shine effect */
@keyframes shine {
    0% {
        transform: translateX(-100%) translateY(-100%) rotate(45deg);
    }
    100% {
        transform: translateX(100%) translateY(100%) rotate(45deg);
    }
}

.book-now-btn {
    position: relative;
    overflow: hidden;
}

.book-now-btn::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 200%;
    height: 200%;
    background: linear-gradient(
        to right,
        rgba(255, 255, 255, 0) 0%,
        rgba(255, 255, 255, 0.3) 100%
    );
    transform: translateX(-100%) translateY(-100%) rotate(45deg);
    animation: shine 3s infinite;
}
</style>
@endpush