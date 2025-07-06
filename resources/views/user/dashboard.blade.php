@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')
<div class="container h-[70vh] mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>
      <!-- Welcome Section -->
    <div class="bg-primary-50 rounded-lg p-6 mb-8">
        <h2 class="text-lg font-semibold text-primary-800 mb-2">Welcome, {{ Auth::user()->name }}!</h2>
        <p class="text-primary-600">Welcome to your MyTravel account dashboard. From here you can view your bookings, update your profile, and manage your account preferences.</p>
    </div>
    
   
    
    <!-- Recent Bookings -->
    <div>
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Recent Bookings</h2>
            <a href="{{ route('user.bookings.index') }}" class="text-primary-600 hover:text-primary-800 font-medium">View All</a>
        </div>
        
        @if(count($bookings) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bundle</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($bookings as $booking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if($booking->bundle)
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-md object-cover" src="{{ $booking->bundle->card_image }}" alt="{{ $booking->bundle->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $booking->bundle->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    ${{ number_format($booking->bundle->price, 2) }}
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-sm text-gray-500">
                                                Bundle no longer available
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $booking->booking_date->format('M d, Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->created_at->format('M d, Y') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $booking->status == 'confirmed' ? 'bg-green-100 text-green-800' : ($booking->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($booking->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('user.bookings.show', $booking->id) }}" class="text-primary-600 hover:text-primary-900">View Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-50 text-center py-8 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-gray-600 mb-2">You don't have any bookings yet</p>                <a href="{{ route('bundles.index') }}" class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium text-white " style="background-color: {{ setting('primary_button_color', '#2563eb') }}">
                    Browse Vacation Bundles
                </a>
            </div>
        @endif
    </div>
    
</div>
@endsection