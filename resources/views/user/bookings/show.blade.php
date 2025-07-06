@extends('layouts.user')

@section('title', 'Booking Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Booking #{{ $booking->id }}</h1>
        <a href="{{ route('user.bookings.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Bookings
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Main Booking Details -->
        <div class="md:col-span-2 space-y-8">
            <!-- Booking Info -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-xl font-semibold text-gray-800">Booking Information</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-8">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Status</h3>
                            <div class="mt-1">
                                <span class="px-2 py-1 text-sm font-semibold rounded-full 
                                    {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </div>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Booking Date</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->booking_date->format('F d, Y') }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">People</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->number_of_people ?? '1' }}</p>
                        </div>
                        
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Created</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->created_at->format('F d, Y H:i') }}</p>
                        </div>
                    </div>

                    @if($booking->notes)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h3 class="text-sm font-medium text-gray-500">Special Requests</h3>
                            <div class="mt-2 p-4 bg-gray-50 rounded-md">
                                <p class="text-sm text-gray-700 whitespace-pre-line">{{ $booking->notes }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bundle Details -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-xl font-semibold text-gray-800">Vacation Bundle Details</h2>
                </div>
                
                @if($booking->bundle)
                    <div class="p-6">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <img src="{{ $booking->bundle->card_image }}" alt="{{ $booking->bundle->name }}" 
                                     class="h-20 w-24 object-cover rounded-md">
                            </div>
                            <div class="ml-6">
                                <h3 class="text-base font-medium text-gray-900">{{ $booking->bundle->name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ $booking->bundle->short_description }}</p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center text-base font-semibold text-gray-900">
                                        ${{ number_format($booking->bundle->price, 2) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        @if(count($booking->bundle->destinations) > 0)
                            <div class="mt-6 pt-6 border-t border-gray-200">
                                <h3 class="text-sm font-medium text-gray-500 mb-3">Destinations</h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    @foreach($booking->bundle->destinations as $destination)
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $destination->main_image }}" alt="{{ $destination->name }}" 
                                                     class="h-12 w-16 object-cover rounded-md">
                                            </div>
                                            <div class="ml-3">
                                                <h4 class="text-sm font-medium text-gray-900">{{ $destination->name }}</h4>
                                                <p class="mt-1 text-xs text-gray-500">{{ $destination->location }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="p-6">
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        The vacation bundle associated with this booking has been deleted or is no longer available.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Actions</h3>
                </div>
                <div class="p-6 space-y-4">
                    @if($booking->status == 'pending')
                        <form method="POST" action="{{ route('user.bookings.cancel', $booking->id) }}" 
                              onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Cancel Booking
                            </button>
                        </form>
                    @endif                    <a href="{{ route('user.bookings.download', $booking->id) }}" 
                       class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Download Details
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection