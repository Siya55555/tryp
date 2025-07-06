@extends('layouts.admin')

@section('title', 'Edit Package Booking')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Edit Package Booking #{{ $booking->id }}</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.bookings.show', ['booking' => $booking->id, 'type' => 'package']) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                View Details
            </a>
            <a href="{{ route('admin.bookings.index', ['type' => 'packages']) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to List
            </a>
        </div>
    </div>

    <!-- Booking Form -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" class="p-6">
            @csrf
            @method('PUT')
            <input type="hidden" name="booking_type" value="package">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Package Information</h2>
                </div>

                <!-- Travel Package -->
                <div>
                    <label for="package_type" class="block text-sm font-medium text-gray-700 mb-1">Travel Package <span class="text-red-500">*</span></label>
                    <select id="package_type" name="package_type" required 
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                        onchange="updatePackageDetails()">
                        <option value="">Select a Travel Package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->type }}" 
                                    data-name="{{ $package->name }}" 
                                    data-price="{{ $package->price }}" 
                                    {{ old('package_type', $booking->package_type) == $package->type ? 'selected' : '' }}>
                                {{ $package->name }} - ${{ number_format($package->price, 2) }}
                            </option>
                        @endforeach
                    </select>
                    @error('package_type')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Link to User (Optional) -->
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Link to User (Optional)</label>
                    <select id="user_id" name="user_id" 
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Guest Booking (No User)</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id', $booking->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Package Name -->
                <div>
                    <label for="package_name" class="block text-sm font-medium text-gray-700 mb-1">Package Name <span class="text-red-500">*</span></label>
                    <input type="text" id="package_name" name="package_name" value="{{ old('package_name', $booking->package_name) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('package_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Package Price -->
                <div>
                    <label for="package_price" class="block text-sm font-medium text-gray-700 mb-1">Package Price <span class="text-red-500">*</span></label>
                    <input type="number" id="package_price" name="package_price" value="{{ old('package_price', $booking->package_price) }}" required step="0.01" min="0" 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('package_price')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pt-4 border-t border-gray-200">Customer Information</h2>
                </div>
                
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $booking->first_name) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('first_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $booking->last_name) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email', $booking->email) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $booking->phone) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pt-4 border-t border-gray-200">Billing Address</h2>
                </div>
                
                <!-- Address -->
                <div class="col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">Street Address <span class="text-red-500">*</span></label>
                    <input type="text" id="address" name="address" value="{{ old('address', $booking->address) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('address')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- City -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                    <input type="text" id="city" name="city" value="{{ old('city', $booking->city) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('city')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- State -->
                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700 mb-1">State <span class="text-red-500">*</span></label>
                    <select id="state" name="state" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">Select State</option>
                        <option value="AL" {{ old('state', $booking->state) == 'AL' ? 'selected' : '' }}>Alabama</option>
                        <option value="AK" {{ old('state', $booking->state) == 'AK' ? 'selected' : '' }}>Alaska</option>
                        <option value="AZ" {{ old('state', $booking->state) == 'AZ' ? 'selected' : '' }}>Arizona</option>
                        <option value="AR" {{ old('state', $booking->state) == 'AR' ? 'selected' : '' }}>Arkansas</option>
                        <option value="CA" {{ old('state', $booking->state) == 'CA' ? 'selected' : '' }}>California</option>
                        <option value="CO" {{ old('state', $booking->state) == 'CO' ? 'selected' : '' }}>Colorado</option>
                        <option value="CT" {{ old('state', $booking->state) == 'CT' ? 'selected' : '' }}>Connecticut</option>
                        <option value="DE" {{ old('state', $booking->state) == 'DE' ? 'selected' : '' }}>Delaware</option>
                        <option value="FL" {{ old('state', $booking->state) == 'FL' ? 'selected' : '' }}>Florida</option>
                        <option value="GA" {{ old('state', $booking->state) == 'GA' ? 'selected' : '' }}>Georgia</option>
                        <option value="HI" {{ old('state', $booking->state) == 'HI' ? 'selected' : '' }}>Hawaii</option>
                        <option value="ID" {{ old('state', $booking->state) == 'ID' ? 'selected' : '' }}>Idaho</option>
                        <option value="IL" {{ old('state', $booking->state) == 'IL' ? 'selected' : '' }}>Illinois</option>
                        <option value="IN" {{ old('state', $booking->state) == 'IN' ? 'selected' : '' }}>Indiana</option>
                        <option value="IA" {{ old('state', $booking->state) == 'IA' ? 'selected' : '' }}>Iowa</option>
                        <option value="KS" {{ old('state', $booking->state) == 'KS' ? 'selected' : '' }}>Kansas</option>
                        <option value="KY" {{ old('state', $booking->state) == 'KY' ? 'selected' : '' }}>Kentucky</option>
                        <option value="LA" {{ old('state', $booking->state) == 'LA' ? 'selected' : '' }}>Louisiana</option>
                        <option value="ME" {{ old('state', $booking->state) == 'ME' ? 'selected' : '' }}>Maine</option>
                        <option value="MD" {{ old('state', $booking->state) == 'MD' ? 'selected' : '' }}>Maryland</option>
                        <option value="MA" {{ old('state', $booking->state) == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                        <option value="MI" {{ old('state', $booking->state) == 'MI' ? 'selected' : '' }}>Michigan</option>
                        <option value="MN" {{ old('state', $booking->state) == 'MN' ? 'selected' : '' }}>Minnesota</option>
                        <option value="MS" {{ old('state', $booking->state) == 'MS' ? 'selected' : '' }}>Mississippi</option>
                        <option value="MO" {{ old('state', $booking->state) == 'MO' ? 'selected' : '' }}>Missouri</option>
                        <option value="MT" {{ old('state', $booking->state) == 'MT' ? 'selected' : '' }}>Montana</option>
                        <option value="NE" {{ old('state', $booking->state) == 'NE' ? 'selected' : '' }}>Nebraska</option>
                        <option value="NV" {{ old('state', $booking->state) == 'NV' ? 'selected' : '' }}>Nevada</option>
                        <option value="NH" {{ old('state', $booking->state) == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                        <option value="NJ" {{ old('state', $booking->state) == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                        <option value="NM" {{ old('state', $booking->state) == 'NM' ? 'selected' : '' }}>New Mexico</option>
                        <option value="NY" {{ old('state', $booking->state) == 'NY' ? 'selected' : '' }}>New York</option>
                        <option value="NC" {{ old('state', $booking->state) == 'NC' ? 'selected' : '' }}>North Carolina</option>
                        <option value="ND" {{ old('state', $booking->state) == 'ND' ? 'selected' : '' }}>North Dakota</option>
                        <option value="OH" {{ old('state', $booking->state) == 'OH' ? 'selected' : '' }}>Ohio</option>
                        <option value="OK" {{ old('state', $booking->state) == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                        <option value="OR" {{ old('state', $booking->state) == 'OR' ? 'selected' : '' }}>Oregon</option>
                        <option value="PA" {{ old('state', $booking->state) == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                        <option value="RI" {{ old('state', $booking->state) == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                        <option value="SC" {{ old('state', $booking->state) == 'SC' ? 'selected' : '' }}>South Carolina</option>
                        <option value="SD" {{ old('state', $booking->state) == 'SD' ? 'selected' : '' }}>South Dakota</option>
                        <option value="TN" {{ old('state', $booking->state) == 'TN' ? 'selected' : '' }}>Tennessee</option>
                        <option value="TX" {{ old('state', $booking->state) == 'TX' ? 'selected' : '' }}>Texas</option>
                        <option value="UT" {{ old('state', $booking->state) == 'UT' ? 'selected' : '' }}>Utah</option>
                        <option value="VT" {{ old('state', $booking->state) == 'VT' ? 'selected' : '' }}>Vermont</option>
                        <option value="VA" {{ old('state', $booking->state) == 'VA' ? 'selected' : '' }}>Virginia</option>
                        <option value="WA" {{ old('state', $booking->state) == 'WA' ? 'selected' : '' }}>Washington</option>
                        <option value="WV" {{ old('state', $booking->state) == 'WV' ? 'selected' : '' }}>West Virginia</option>
                        <option value="WI" {{ old('state', $booking->state) == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                        <option value="WY" {{ old('state', $booking->state) == 'WY' ? 'selected' : '' }}>Wyoming</option>
                    </select>
                    @error('state')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Zip -->
                <div>
                    <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">Zip Code <span class="text-red-500">*</span></label>
                    <input type="text" id="zip" name="zip" value="{{ old('zip', $booking->zip) }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('zip')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pt-4 border-t border-gray-200">Booking Details</h2>
                </div>
                
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select id="status" name="status" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="pending" {{ old('status', $booking->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ old('status', $booking->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ old('status', $booking->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Payment Method -->
                <div>
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method <span class="text-red-500">*</span></label>
                    <select id="payment_method" name="payment_method" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="credit_card" {{ old('payment_method', $booking->payment_method) == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="paypal" {{ old('payment_method', $booking->payment_method) == 'paypal' ? 'selected' : '' }}>PayPal</option>
                        <option value="bank_transfer" {{ old('payment_method', $booking->payment_method) == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    </select>
                    @error('payment_method')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Card Last Four -->
                <div>
                    <label for="card_last_four" class="block text-sm font-medium text-gray-700 mb-1">Last 4 Digits of Card (if applicable)</label>
                    <input type="text" id="card_last_four" name="card_last_four" value="{{ old('card_last_four', $booking->card_last_four) }}" maxlength="4" 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('card_last_four')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Notes -->
                <div class="col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Admin Notes</label>
                    <textarea id="notes" name="notes" rows="4" 
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('notes', $booking->notes) }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 flex justify-between">
                <div>
                    <span class="text-sm text-gray-500">Created: {{ $booking->created_at->format('M d, Y H:i') }}</span>
                    <span class="mx-2 text-gray-300">|</span>
                    <span class="text-sm text-gray-500">Last Updated: {{ $booking->updated_at->format('M d, Y H:i') }}</span>
                </div>
                
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Update Package Booking
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function updatePackageDetails() {
        const packageSelect = document.getElementById('package_type');
        const selectedOption = packageSelect.options[packageSelect.selectedIndex];
        
        if (selectedOption.value) {
            document.getElementById('package_name').value = selectedOption.getAttribute('data-name');
            // Only update price if it wasn't manually changed
            const priceInput = document.getElementById('package_price');
            if (priceInput.getAttribute('data-manual-change') !== 'true') {
                priceInput.value = selectedOption.getAttribute('data-price');
            }
        }
    }
    
    // Track if price was manually changed
    document.addEventListener('DOMContentLoaded', function() {
        const priceInput = document.getElementById('package_price');
        priceInput.addEventListener('input', function() {
            this.setAttribute('data-manual-change', 'true');
        });
    });
</script>
@endpush
@endsection