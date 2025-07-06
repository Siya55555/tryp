@extends('layouts.admin')

@section('title', 'View Package Booking')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">View Package Booking</h1>
        <a href="{{ route('admin.bookings.index', ['type' => 'packages']) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>
    
    <!-- Booking Details -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Package Information</h2>
                </div>

                <!-- Travel Package -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Travel Package</p>
                    <p class="text-base text-gray-900">{{ $booking->package_name }}</p>
                    <p class="text-sm text-gray-500">Type: {{ ucfirst($booking->package_type) }}</p>
                </div>
                
                <!-- User Information -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Linked User</p>
                    <p class="text-base text-gray-900">
                        @if($booking->user_id)
                            {{ $booking->user->name }} ({{ $booking->user->email }})
                        @else
                            Guest Booking (No User)
                        @endif
                    </p>
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pt-4 border-t border-gray-200">Customer Information</h2>
                </div>
                
                <!-- Name -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Name</p>
                    <p class="text-base text-gray-900">{{ $booking->first_name }} {{ $booking->last_name }}</p>
                </div>
                
                <!-- Price -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Package Price</p>
                    <p class="text-base text-gray-900">${{ number_format($booking->package_price, 2) }}</p>
                </div>
                
                <!-- Email -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Email</p>
                    <p class="text-base text-gray-900">{{ $booking->email }}</p>
                </div>
                
                <!-- Phone -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Phone</p>
                    <p class="text-base text-gray-900">{{ $booking->phone }}</p>
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pt-4 border-t border-gray-200">Billing Address</h2>
                </div>
                
                <!-- Address -->
                <div class="col-span-2">
                    <p class="text-sm font-medium text-gray-700 mb-1">Street Address</p>
                    <p class="text-base text-gray-900">{{ $booking->address }}</p>
                </div>
                
                <!-- City, State, Zip -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">City</p>
                    <p class="text-base text-gray-900">{{ $booking->city }}</p>
                </div>
                
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">State</p>
                    <p class="text-base text-gray-900">{{ $booking->state }}</p>
                </div>
                
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Zip Code</p>
                    <p class="text-base text-gray-900">{{ $booking->zip }}</p>
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pt-4 border-t border-gray-200">Booking Details</h2>
                </div>
                
                <!-- Status -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Status</p>
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $booking->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>
                
                <!-- Payment Method -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Payment Method</p>
                    <p class="text-base text-gray-900">{{ ucfirst(str_replace('_', ' ', $booking->payment_method)) }}</p>
                </div>
                
                <!-- Card Last Four -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Card Details</p>
                    <p class="text-base text-gray-900">
                        @if($booking->card_last_four)
                            **** **** **** {{ $booking->card_last_four }}
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                
                <!-- Created At -->
                <div>
                    <p class="text-sm font-medium text-gray-700 mb-1">Booking Date</p>
                    <p class="text-base text-gray-900">{{ $booking->created_at->format('M d, Y h:i A') }}</p>
                </div>
                
                <!-- Notes -->
                @if($booking->notes)
                <div class="col-span-2 mt-4">
                    <p class="text-sm font-medium text-gray-700 mb-1">Notes</p>
                    <p class="text-base text-gray-900">{{ $booking->notes }}</p>
                </div>
                @endif
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 flex justify-end space-x-3">
                <a href="{{ route('admin.bookings.edit', ['booking' => $booking->id, 'type' => 'package']) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Edit Booking
                </a>
                <form method="POST" action="{{ route('admin.bookings.destroy', ['booking' => $booking->id, 'type' => 'package']) }}" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection