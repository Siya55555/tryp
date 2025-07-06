@extends('layouts.user')

@section('title', 'Create New Booking')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Create New Booking</h1>
        <a href="{{ route('user.bookings.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Bookings
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <ul class="text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form method="POST" action="{{ route('user.bookings.store') }}" class="p-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Bundle Selection -->
                <div>
                    <label for="bundle_id" class="block text-sm font-medium text-gray-700 mb-1">Vacation Bundle <span class="text-red-500">*</span></label>
                    <select id="bundle_id" name="bundle_id" required class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Select Bundle</option>
                        @foreach($bundles as $bundle)
                            <option value="{{ $bundle->id }}" {{ old('bundle_id') == $bundle->id ? 'selected' : '' }}>
                                {{ $bundle->name }} (${{ number_format($bundle->price, 2) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Booking Date -->
                <div>
                    <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-1">Booking Date <span class="text-red-500">*</span></label>
                    <input type="date" id="booking_date" name="booking_date" required value="{{ old('booking_date') }}" 
                           min="{{ date('Y-m-d') }}"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <!-- Number of People -->
                <div>
                    <label for="number_of_people" class="block text-sm font-medium text-gray-700 mb-1">Number of People</label>
                    <input type="number" id="number_of_people" name="number_of_people" min="1" value="{{ old('number_of_people', 1) }}"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                </div>

                <!-- Special Requests -->
                <div class="md:col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Special Requests</label>
                    <textarea id="notes" name="notes" rows="3" 
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" class="inline-flex items-center px-4 py-2 rounded-md text-sm font-medium text-white " style="background-color: {{ setting('primary_button_color', '#2563eb') }}">
                    Create Booking
                </button>
            </div>
        </form>
    </div>
</div>
@endsection