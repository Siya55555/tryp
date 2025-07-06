@extends('layouts.app')

@section('title', $packageName . ' Package Details')

@section('content')
<section class="hero-gradient min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="container mx-auto px-4 py-16 relative z-10">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-4xl mx-auto">
            <!-- Package Header -->
                <div class="bg-gradient-to-r from-teal-500 to-teal-500 p-8 text-white">
                    <h1 class="text-4xl font-bold mb-4">{{ strtoupper($packageName) }}</h1>
                    <p class="text-xl">{{ $packageDescription }}</p>
                </div>
                
                <!-- Package Content -->
                <div class="p-8">
                    <!-- Package Image and Price -->
                    <div class="flex flex-col md:flex-row gap-8 mb-8">
                        <div class="md:w-1/2">
                            @if(isset($package) && $package->image)
                                <img src="{{ Storage::url($package->image) }}" alt="{{ $packageName }}" class="w-full h-auto rounded-xl shadow-lg">
                            @else
                                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop" alt="{{ $packageName }}" class="w-full h-auto rounded-xl shadow-lg">
                            @endif
                        </div>
                        <div class="md:w-1/2">                           
                            
                            <div class="bg-primary-50 rounded-xl p-6 shadow-md flex flex-col h-full">
                                <h2 class="text-2xl font-bold primary-text-color mb-4">Package Details</h2>
                                
                                <div class="mb-6">
                                    <p class="text-lg text-gray-700">
                                        @if(isset($package) && $package->description)
                                            {{ $package->description }}
                                        @else
                                            Experience an unforgettable 8-day vacation with our premium travel package. Perfect for travelers seeking both adventure and relaxation.
                                        @endif
                                    </p>
                                </div>
                                
                                <div class="mt-auto">
                                    <div class="text-3xl font-bold primary-text-color mb-4">
                                        From $<span id="unit-price" data-price="{{ $packagePrice }}">{{ number_format($packagePrice, 0) }}</span>
                                    </div>
                                    <a href="#booking-form" class="bg-blue-600 text-white rounded-md hover:bg-blue-700 block w-full text-center py-4 px-6 rounded-full font-bold text-lg transition-colors shadow-lg transform hover:scale-105 transition-transform">
                                        BOOK NOW
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Package Features -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold primary-text-color mb-4">What's Included</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if(isset($package) && $package->features && count($package->features) > 0)
                                @foreach($package->features as $feature)
                                    <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                                        <div class="flex-shrink-0 w-10 h-10 primary-text-color rounded-full flex items-center justify-center mr-4">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-black">{{ $feature }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            @else                                <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-4" style="background-color: {{ setting('primary_button_color', '#2563eb') }}33; color: {{ setting('primary_button_color', '#2563eb') }}">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">8 Day / 7 Night Premium Accommodation</p>
                                    </div>
                                </div>
                                <div class="flex items-start bg-gray-50 p-4 rounded-lg">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center mr-4" style="background-color: {{ setting('primary_button_color', '#2563eb') }}33; color: {{ setting('primary_button_color', '#2563eb') }}">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div>
                                        <p class="font-medium">Dedicated Travel Concierge</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Booking Form -->
                    <div id="booking-form" class="bg-gray-50 rounded-xl p-6 shadow-md">
                        <h2 class="text-2xl font-bold primary-text-color mb-6">Book Your {{ $packageName }} Package</h2>
                        
                        @if ($errors->any())
                            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                                <ul class="list-disc pl-5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('tiers.book') }}" method="POST" class="space-y-6">
                            @csrf
                            <input type="hidden" name="package_type" value="{{ $packageType }}">
                            <input type="hidden" name="package_price" value="{{ $packagePrice }}">
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="first_name" id="first_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                                    @error('first_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="last_name" id="last_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                                    @error('last_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" id="email" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                                <input type="tel" name="phone" id="phone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500" placeholder="(XXX) XXX-XXXX" required>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity <span class="text-red-500">*</span></label>
                                    <div class="flex items-center space-x-2 mt-2">
                                        <button type="button" id="decrement-qty" class="w-10 h-10 flex items-center justify-center rounded-l-lg bg-blue-100 text-blue-700 font-bold text-xl shadow hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">-</button>
                                        <input type="number" name="quantity" id="quantity" min="1" max="4" value="1" class="w-16 text-center px-2 py-2 border-t border-b border-gray-300 focus:ring-2 focus:ring-blue-400 focus:border-blue-400 text-lg font-semibold shadow-inner outline-none no-spinner" required style="appearance: textfield; -moz-appearance: textfield;">
                                        <button type="button" id="increment-qty" class="w-10 h-10 flex items-center justify-center rounded-r-lg bg-blue-100 text-blue-700 font-bold text-xl shadow hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">+</button>
                                    </div>
                                    <small class="text-gray-500">You can buy 1 to 4 memberships.</small>
                                    @error('quantity')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    <div class="mt-2 text-lg font-semibold text-blue-700">Total: $<span id="total-price">{{ number_format($packagePrice, 0) }}</span></div>
                                </div>
                            </div>
                            
                            <!-- Payment Information -->
                            @error('payment')
                                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div>
                                <h3 class="text-xl font-bold text-blue-800 mb-4">Payment Information <span class="text-red-500">*</span></h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Card Number <span class="text-red-500">*</span></label>
                                        <div id="card-number-element" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white"></div>
                                    </div>
                                    <div>
                                        <label for="cardholder_name" class="block text-sm font-medium text-gray-700 mb-1">Cardholder Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="cardholder_name" id="cardholder_name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Name as it appears on card" required>
                                        @error('cardholder_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Expiration <span class="text-red-500">*</span></label>
                                        <div id="card-expiry-element" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white"></div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">CVC <span class="text-red-500">*</span></label>
                                        <div id="card-cvc-element" class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white"></div>
                                    </div>
                                </div>
                                <div id="card-errors" class="text-red-600 mb-4"></div>
                                <input type="hidden" name="stripeToken" id="stripeToken">
                            </div>
                            
                            <!-- Billing Address -->
                            <div>
                                <h3 class="text-xl font-bold text-blue-800 mb-4">Billing Address <span class="text-red-500">*</span></h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street Address <span class="text-red-500">*</span></label>
                                        <input type="text" name="address" id="address" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Street address" required>
                                        @error('address')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div>
                                            <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                                            <input type="text" name="city" id="city" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="City" required>
                                            @error('city')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State <span class="text-red-500">*</span></label>
                                            <select name="state" id="state" class="w-full text-black px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                                <option value="" disabled selected>Select State</option>
                                                <option value="AL">Alabama</option>
                                                <option value="AK">Alaska</option>
                                                <option value="AZ">Arizona</option>
                                                <option value="AR">Arkansas</option>
                                                <option value="CA">California</option>
                                                <option value="CO">Colorado</option>
                                                <option value="CT">Connecticut</option>
                                                <option value="DE">Delaware</option>
                                                <option value="FL">Florida</option>
                                                <option value="GA">Georgia</option>
                                                <option value="HI">Hawaii</option>
                                                <option value="ID">Idaho</option>
                                                <option value="IL">Illinois</option>
                                                <option value="IN">Indiana</option>
                                                <option value="IA">Iowa</option>
                                                <option value="KS">Kansas</option>
                                                <option value="KY">Kentucky</option>
                                                <option value="LA">Louisiana</option>
                                                <option value="ME">Maine</option>
                                                <option value="MD">Maryland</option>
                                                <option value="MA">Massachusetts</option>
                                                <option value="MI">Michigan</option>
                                                <option value="MN">Minnesota</option>
                                                <option value="MS">Mississippi</option>
                                                <option value="MO">Missouri</option>
                                                <option value="MT">Montana</option>
                                                <option value="NE">Nebraska</option>
                                                <option value="NV">Nevada</option>
                                                <option value="NH">New Hampshire</option>
                                                <option value="NJ">New Jersey</option>
                                                <option value="NM">New Mexico</option>
                                                <option value="NY">New York</option>
                                                <option value="NC">North Carolina</option>
                                                <option value="ND">North Dakota</option>
                                                <option value="OH">Ohio</option>
                                                <option value="OK">Oklahoma</option>
                                                <option value="OR">Oregon</option>
                                                <option value="PA">Pennsylvania</option>
                                                <option value="RI">Rhode Island</option>
                                                <option value="SC">South Carolina</option>
                                                <option value="SD">South Dakota</option>
                                                <option value="TN">Tennessee</option>
                                                <option value="TX">Texas</option>
                                                <option value="UT">Utah</option>
                                                <option value="VT">Vermont</option>
                                                <option value="VA">Virginia</option>
                                                <option value="WA">Washington</option>
                                                <option value="WV">West Virginia</option>
                                                <option value="WI">Wisconsin</option>
                                                <option value="WY">Wyoming</option>
                                            </select>
                                            @error('state')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">Zip Code <span class="text-red-500">*</span></label>
                                            <input type="text" name="zip" id="zip" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Zip Code" required>
                                            @error('zip')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Consent Checkbox -->
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="consent" name="consent" type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded" required>
                                    @error('consent')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="consent" class="text-gray-700">I consent to receive telephone sales calls, marketing calls and messages, including prerecorded messages and text messages from Monster Reservations Group and its partners, agents or affiliates at the phone number(s)/wireless numbers provided above regarding offers, products and services, including through an automated telephone dialing system. I understand that I am not required to provide this consent to make a purchase from Monster.</label>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="text-center">
                                <button type="submit" class="px-8 py-4 bg-gradient-to-r from-blue-600 to-teal-500 text-white rounded-full font-bold hover:from-blue-700 hover:to-teal-600 transition-colors shadow-xl transform hover:scale-105">
                                    COMPLETE BOOKING
                                </button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    
    <!-- Fixed wave at bottom of the section -->
    <div class="absolute bottom-0 left-0 right-0 w-full" style="z-index: 1;">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" preserveAspectRatio="none" style="width: 100%; height: 120px; display: block;">
            <path fill="#f7fafc" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

<!-- Trust Badges Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold text-blue-800 mb-8 text-center">BOOK WITH CONFIDENCE</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                        <i class="fas fa-lock text-2xl"></i>
                    </div>
                    <p class="font-medium">Secure Payment</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                        <i class="fas fa-shield-alt text-2xl"></i>
                    </div>
                    <p class="font-medium">Protected Information</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                        <i class="fas fa-headset text-2xl"></i>
                    </div>
                    <p class="font-medium">24/7 Support</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                        <i class="fas fa-thumbs-up text-2xl"></i>
                    </div>
                    <p class="font-medium">Satisfaction Guarantee</p>
                </div>
            </div>
        </div>
    </div>
</section>


<x-vacations-booked-counter />
<style>
    .hero-gradient {
        background-image: url('https://plus.unsplash.com/premium_photo-1661964304872-7b715cf38cd1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        background-size: cover;
        background-position: center;
        position: relative;
        color: white;
    }
    
    .hero-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to right, rgba(0,0,0, 0.5), rgba(0,0,0, 0.5));
        z-index: 0;
    }
    #booking-form input,
    #booking-form select {
        color: black !important;
    }
    /* Hide number input spinners for all browsers */
    input[type=number].no-spinner::-webkit-inner-spin-button,
    input[type=number].no-spinner::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    input[type=number].no-spinner {
      -moz-appearance: textfield;
    }
</style>
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    var stripe = Stripe("pk_test_51RgtTnG4ZUdg5poNg0eqlcZqS2XnNk4KjcdxQRCwiSs7adlgbKj3knDc2pk29k7YnAQ6HiGkzAdRVBHRyBRusAmG00frdxZfLE");
    var elements = stripe.elements();
    var style = {
        base: {
            fontSize: '16px',
            color: '#32325d',
            '::placeholder': { color: '#a0aec0' }
        }
    };
    var cardNumber = elements.create('cardNumber', { style: style });
    cardNumber.mount('#card-number-element');
    var cardExpiry = elements.create('cardExpiry', { style: style });
    cardExpiry.mount('#card-expiry-element');
    var cardCvc = elements.create('cardCvc', { style: style });
    cardCvc.mount('#card-cvc-element');
    var form = document.querySelector('form[action="{{ route('tiers.book') }}\"]');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var cardholderName = document.getElementById('cardholder_name').value;
        stripe.createToken(cardNumber, { name: cardholderName }).then(function(result) {
            if (result.error) {
                document.getElementById('card-errors').textContent = result.error.message;
            } else {
                document.getElementById('stripeToken').value = result.token.id;
                form.submit();
            }
        });
    });
    var quantityInput = document.getElementById('quantity');
    var unitPriceSpan = document.getElementById('unit-price');
    var totalPriceSpan = document.getElementById('total-price');
    var unitPrice = parseFloat(unitPriceSpan.getAttribute('data-price'));
    function updatePrices() {
        var qty = parseInt(quantityInput.value) || 1;
        var total = unitPrice * qty;
        unitPriceSpan.textContent = (unitPrice).toLocaleString();
        totalPriceSpan.textContent = total.toLocaleString();
    }
    quantityInput.addEventListener('input', updatePrices);
    updatePrices();
    var decrementBtn = document.getElementById('decrement-qty');
    var incrementBtn = document.getElementById('increment-qty');
    decrementBtn.addEventListener('click', function() {
        var qty = parseInt(quantityInput.value) || 1;
        if (qty > 1) {
            quantityInput.value = qty - 1;
            quantityInput.dispatchEvent(new Event('input'));
        }
    });
    incrementBtn.addEventListener('click', function() {
        var qty = parseInt(quantityInput.value) || 1;
        if (qty < 4) {
            quantityInput.value = qty + 1;
            quantityInput.dispatchEvent(new Event('input'));
        }
    });
});
</script>