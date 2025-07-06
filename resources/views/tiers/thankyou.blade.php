@extends('layouts.app')

@section('title', 'Thank You for Your Booking')

@section('content')
    <section class="hero-gradient min-h-screen flex items-center justify-center relative overflow-hidden">
        <div class="container mx-auto px-4 py-16 relative z-10">
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden max-w-3xl mx-auto text-center">
                <!-- Success Icon -->              
                <div class="pt-10">
                    <div class="w-24 h-24 rounded-full bg-primary-50 flex items-center justify-center mx-auto">
                        <i class="fas fa-check-circle text-primary-600 text-5xl"></i>
                    </div>
                </div>
                
                <!-- Thank You Content -->                <div class="p-8">
                    <h1 class="text-4xl font-bold text-primary-800 mb-4">Thank you for your order!</h1>
                    <p class="text-2xl text-gray-700 mb-8">Your vacation booking has been confirmed!</p>
                    
                    <div class="bg-primary-50 p-6 rounded-xl mb-8 inline-block mx-auto text-left">
                        <h2 class="text-xl font-bold text-primary-800 mb-4">Booking Details</h2>
                        <div class="space-y-2">
                            <p><span class="font-semibold">Name:</span> {{ $booking['name'] }}</p>
                            <p><span class="font-semibold">Email:</span> {{ $booking['email'] }}</p>
                            <p><span class="font-semibold">Package:</span> {{ $booking['package'] }}</p>
                            <p><span class="font-semibold">Quantity:</span> {{ $booking['quantity'] ?? 1 }}</p>
                            <p><span class="font-semibold">Total:</span> ${{ $booking['price'] }}</p>
                            @if(!empty($booking['transaction_id']))
                                <p><span class="font-semibold">Transaction ID:</span> {{ $booking['transaction_id'] }}</p>
                            @endif
                        </div>
                    </div>
                    
                    <p class="text-gray-700 mb-8">We've sent a confirmation email to {{ $booking['email'] }} with all the details of your booking. Our team will be in touch with you shortly to help customize your perfect vacation.</p>                      <div class="flex justify-center space-x-4">
                        <a href="{{ route('home') }}" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-teal-500 text-white rounded-full font-semibold hover:bg-primary-700 transition-colors shadow-md">
                            Return Home
                        </a>
                        <a href="#" class="px-8 py-3 bg-white border border-primary-600 text-primary-600 rounded-full font-semibold hover:bg-primary-50 transition-colors">
                            Contact Support
                        </a>
                    </div>
                </div>
                  <!-- Next Steps -->
                <div class="bg-gradient-to-r from-teal-500 to-teal-500 p-8 ">
                    <h2 class="text-2xl font-bold mb-6 text-white">What's Next?</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-12 h-12 rounded-full bg-white text-dark flex items-center justify-center mx-auto mb-4">
                                <i class="fa-regular fa-envelope"></i>

                            </div>
                            <p class="font-medium text-white">Check your email for confirmation details</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-12 h-12 rounded-full bg-white text-dark flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <p class="font-medium text-white">Our travel agent will call you within 24 hours</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="w-12 h-12 rounded-full bg-white text-dark flex items-center justify-center mx-auto mb-4">
                                <i class="fa-solid fa-calendar-days"></i>
                            </div>
                            <p class="font-medium text-white">Start planning for your amazing vacation!</p>
                        </div>
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
    .hero-gradient {
        background-image: url('https://plus.unsplash.com/premium_photo-1661964304872-7b715cf38cd1?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');
        background-size: cover;
        background-position: center;
        position: relative;
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
 
</style>
  