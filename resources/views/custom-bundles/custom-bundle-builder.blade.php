@extends('layouts.app')

@section('title', 'Build Your ' . ucfirst($bundleType->name ?? '') . ' Custom Bundle')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[500px] overflow-hidden">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img 
            src="{{ filter_var($bundleType->image, FILTER_VALIDATE_URL) ? $bundleType->image : asset($bundleType->image) }}" 

                alt="{{ ucfirst($bundleType->name ?? '') }} Destinations" 
                class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 via-blue-700/50 to-blue-500/30"></div>
        </div>
        
        <!-- Social Share -->
        <div class="container mx-auto px-4 pt-8 relative z-20">
            <div class="flex justify-end mb-4">
                <button class="flex items-center bg-white/20 backdrop-blur-md text-white px-5 py-2.5 rounded-full hover:bg-yellow-400 hover:text-blue-900 transition-all duration-300 shadow-lg">
                    <i class="fas fa-envelope mr-2"></i>
                    Share Via Email
                </button>
                <div class="flex space-x-3 ml-4">
                    <a href="#" class="bg-white/20 backdrop-blur-md w-10 h-10 rounded-full flex items-center justify-center text-white hover:bg-yellow-400 hover:text-blue-900 transition-all duration-300 shadow-lg">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="bg-white/20 backdrop-blur-md w-10 h-10 rounded-full flex items-center justify-center text-white hover:bg-yellow-400 hover:text-blue-900 transition-all duration-300 shadow-lg">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="bg-white/20 backdrop-blur-md w-10 h-10 rounded-full flex items-center justify-center text-white hover:bg-yellow-400 hover:text-blue-900 transition-all duration-300 shadow-lg">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Hero Content -->
        <div class="container mx-auto px-4 h-full flex items-center justify-center relative z-20">
            <div class="text-center text-white">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 drop-shadow-xl animate-fadeIn">
                    {{ $bundleType->title ?? ucfirst($bundleType->name ?? 'Custom') . ' Bundle' }}
                </h1>
                <p class="text-xl md:text-2xl mb-8 drop-shadow-lg font-light tracking-wider">
                    {{ $bundleType->subtitle ?? 'CREATE YOUR PERFECT TRAVEL EXPERIENCE' }}
                </p>
                <div class="w-24 h-1 bg-yellow-400 mx-auto rounded-full"></div>
            </div>
        </div>
    </section>

    <!-- Destination Selection Section -->
    <section class="py-16 bg-gradient-to-b from-white to-blue-50">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden transform -translate-y-12">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white text-center py-8 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0">
                            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,202.7C672,203,768,181,864,160C960,139,1056,117,1152,128C1248,139,1344,181,1392,202.7L1440,224L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-bold uppercase tracking-wider relative z-10">{{ $bundleType->name ?? 'Custom' }} Bundle</h3>
                </div>
                
                <!-- Price Circle -->
                <div class="flex justify-center">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-800 text-white w-40 h-40 rounded-full mt-10 flex flex-col items-center justify-center border-4 border-white shadow-2xl transform transition-transform hover:scale-105">
                        <span class="text-sm font-light">FROM</span>
                        <div class="flex items-start">
                            <span class="text-lg mt-1">$</span>
                            <span class="text-5xl font-bold">{{ number_format($price, 0) }}</span>
                        </div>
                        <span class="text-sm font-light">PER PERSON</span>
                    </div>
                </div>
                
                <!-- Instructions -->
                <div class="p-8 md:p-12 text-center">
                    <p class="text-gray-700 mb-8 max-w-2xl mx-auto text-lg">
                        {{ $bundleType->description ?? 'Select your preferred destinations below to create your custom travel package.' }}
                    </p>
                    
                    <form action="{{ route('custom-bundle.build') }}" method="POST" class="max-w-4xl mx-auto">
                        @csrf
                        <input type="hidden" name="bundle_type" value="{{ $bundleType->slug }}">
                        <input type="hidden" name="price" value="{{ $price }}">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
                            <!-- First Destination Column -->                            <div class="bg-blue-50 rounded-xl p-6 shadow-inner">
                                <h4 class="flex items-center text-blue-600 font-semibold uppercase mb-6 text-xl">
                                    @if($bundleType->slug == 'combination')
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        Domestic Destination
                                    @else
                                        <i class="{{ $bundleType->slug == 'international' ? 'fas fa-globe-americas' : 'fas fa-map-marker-alt' }} mr-2"></i>
                                        First Destination
                                    @endif
                                    <span class="text-red-500 ml-1">*</span>
                                </h4>
                                
                                <div class="space-y-4 text-left">
                                    @forelse($firstDestinations as $destination)
                                        <div class="destination-option">
                                            <input type="radio" id="first_{{ $destination->id }}" 
                                                name="first_destination" 
                                                value="{{ $destination->id }}" 
                                                class="hidden peer">
                                            <label for="first_{{ $destination->id }}" class="flex items-center p-3 border-2 border-blue-100 rounded-lg cursor-pointer transition-all bg-white peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-blue-200">
                                                <div class="flex items-center justify-center w-6 h-6 mr-3 border-2 border-blue-200 rounded-full peer-checked:bg-blue-500 peer-checked:border-blue-500 destination-radio">
                                                    <svg class="hidden w-3 h-3 text-white destination-check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M5 12l5 5L20 7"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-gray-700 font-medium">{{ $destination->name }}, {{ $destination->location }}</span>
                                            </label>
                                        </div>
                                    @empty
                                        <div class="text-center text-gray-500 p-4">
                                            No destinations available. Please add destinations in the admin panel.
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                            
                            <!-- Second Destination Column -->                            <div class="bg-blue-50 rounded-xl p-6 shadow-inner">
                                <h4 class="flex items-center text-blue-600 font-semibold uppercase mb-6 text-xl">
                                    @if($bundleType->slug == 'combination')
                                        <i class="fas fa-globe-americas mr-2"></i>
                                        International Destination
                                    @else
                                        <i class="{{ $bundleType->slug == 'international' ? 'fas fa-globe-europe' : 'fas fa-map-marker-alt' }} mr-2"></i>
                                        Second Destination
                                    @endif
                                    <span class="text-red-500 ml-1">*</span>
                                </h4>
                                
                                <div class="space-y-4 text-left">
                                    @forelse($secondDestinations as $destination)
                                        <div class="destination-option">
                                            <input type="radio" id="second_{{ $destination->id }}" 
                                                name="second_destination" 
                                                value="{{ $destination->id }}" 
                                                class="hidden peer">
                                            <label for="second_{{ $destination->id }}" class="flex items-center p-3 border-2 border-blue-100 rounded-lg cursor-pointer transition-all bg-white peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-blue-200">
                                                <div class="flex items-center justify-center w-6 h-6 mr-3 border-2 border-blue-200 rounded-full peer-checked:bg-blue-500 peer-checked:border-blue-500 destination-radio">
                                                    <svg class="hidden w-3 h-3 text-white destination-check" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M5 12l5 5L20 7"></path>
                                                    </svg>
                                                </div>
                                                <span class="text-gray-700 font-medium">{{ $destination->name }}, {{ $destination->location }}</span>
                                            </label>
                                        </div>
                                    @empty
                                        <div class="text-center text-gray-500 p-4">
                                            No destinations available. Please add destinations in the admin panel.
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="mt-12">
                            <button type="submit" class="group relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-lg uppercase font-bold rounded-full hover:from-yellow-400 hover:to-yellow-500 transition-all duration-300 shadow-lg hover:shadow-xl w-full md:w-auto md:min-w-[300px]">
                                <span class="relative z-10 flex items-center">
                                    Build My Custom Bundle
                                    <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Bottom Decoration -->
                <div class="h-2 bg-gradient-to-r from-blue-600 to-blue-700"></div>
            </div>
            
            <!-- Features Section -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                @php
                    $features = [];
                    // Check if bundleType->features is an array (decoded JSON)
                    if (isset($bundleType->features) && is_array($bundleType->features)) {
                        $features = $bundleType->features;
                    }
                @endphp
                
                @forelse($features as $index => $feature)
                    <div class="bg-white p-6 rounded-xl shadow-lg text-center transform transition-transform hover:-translate-y-1">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="{{ $feature['icon'] ?? 'fas fa-star' }} text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ $feature['title'] ?? '' }}</h3>
                        <p class="text-gray-600">{{ $feature['description'] ?? '' }}</p>
                    </div>
                @empty
                    <!-- No features to display -->
                @endforelse
            </div>
        </div>
    </section>

    <!-- Vacations Booked Counter Component -->
    <x-vacations-booked-counter />

@endsection

@push('styles')
<style>
    .animate-fadeIn {
        animation: fadeIn 1.2s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .destination-option input[type="radio"]:checked + label .destination-radio .destination-check {
        display: block;
    }
    
    .destination-option.disabled label {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prevent selecting the same destination for both choices
        const firstDestinations = document.querySelectorAll('input[name="first_destination"]');
        const secondDestinations = document.querySelectorAll('input[name="second_destination"]');
        
        function updateDestinationOptions() {
            const firstSelected = document.querySelector('input[name="first_destination"]:checked');
            const secondSelected = document.querySelector('input[name="second_destination"]:checked');
            
            // Reset all options first
            firstDestinations.forEach(radio => {
                radio.disabled = false;
                radio.closest('.destination-option').classList.remove('disabled');
            });
            
            secondDestinations.forEach(radio => {
                radio.disabled = false;
                radio.closest('.destination-option').classList.remove('disabled');
            });
            
            // Disable matching options
            if (firstSelected) {
                const matchingSecond = document.querySelector(`input[name="second_destination"][value="${firstSelected.value}"]`);
                if (matchingSecond) {
                    matchingSecond.disabled = true;
                    matchingSecond.closest('.destination-option').classList.add('disabled');
                }
            }
            
            if (secondSelected) {
                const matchingFirst = document.querySelector(`input[name="first_destination"][value="${secondSelected.value}"]`);
                if (matchingFirst) {
                    matchingFirst.disabled = true;
                    matchingFirst.closest('.destination-option').classList.add('disabled');
                }
            }
        }
        
        firstDestinations.forEach(radio => {
            radio.addEventListener('change', function() {
                updateDestinationOptions();
                const section = this.closest('.bg-blue-50');
                if (section) {
                    section.classList.add('ring-2', 'ring-blue-400', 'transition-all', 'duration-300');
                    setTimeout(() => {
                        section.classList.remove('ring-2', 'ring-blue-400');
                    }, 500);
                }
            });
        });
        
        secondDestinations.forEach(radio => {
            radio.addEventListener('change', function() {
                updateDestinationOptions();
                const section = this.closest('.bg-blue-50');
                if (section) {
                    section.classList.add('ring-2', 'ring-blue-400', 'transition-all', 'duration-300');
                    setTimeout(() => {
                        section.classList.remove('ring-2', 'ring-blue-400');
                    }, 500);
                }
            });
        });
        
        // Initial setup
        updateDestinationOptions();
        
        // Form validation
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            const firstSelected = document.querySelector('input[name="first_destination"]:checked');
            const secondSelected = document.querySelector('input[name="second_destination"]:checked');
            
            if (!firstSelected || !secondSelected) {
                e.preventDefault();
                
                // Create toast notification instead of alert
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fadeIn';
                toast.innerHTML = '<div class="flex items-center"><i class="fas fa-exclamation-circle mr-2"></i> Please select both destinations</div>';
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                    setTimeout(() => toast.remove(), 500);
                }, 3000);
            } else if (firstSelected.value === secondSelected.value) {
                e.preventDefault();
                
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fadeIn';
                toast.innerHTML = '<div class="flex items-center"><i class="fas fa-exclamation-circle mr-2"></i> Please select two different destinations</div>';
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                    setTimeout(() => toast.remove(), 500);
                }, 3000);
            }
        });
    });
</script>
@endpush