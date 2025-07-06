@extends('layouts.admin')

@section('title', 'Create Package Booking')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Create Package Booking</h1>
        <a href="{{ route('admin.bookings.index', ['type' => 'packages']) }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to List
        </a>
    </div>

    <!-- Booking Form -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form method="POST" action="{{ route('admin.bookings.store') }}" class="p-6">
            @csrf
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
                                    {{ old('package_type') == $package->type ? 'selected' : '' }}>
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
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Hidden fields for package details -->
                <input type="hidden" id="package_name" name="package_name" value="{{ old('package_name') }}">
                <input type="hidden" id="package_price" name="package_price" value="{{ old('package_price') }}">
                
                <div class="col-span-2">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 pt-4 border-t border-gray-200">Customer Information</h2>
                </div>
                
                <!-- First Name -->
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('first_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Last Name -->
                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('email')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Phone -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-red-500">*</span></label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required 
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
                    <input type="text" id="address" name="address" value="{{ old('address') }}" required 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('address')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- City -->
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City <span class="text-red-500">*</span></label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" required 
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
                        <option value="AL" {{ old('state') == 'AL' ? 'selected' : '' }}>Alabama</option>
                        <option value="AK" {{ old('state') == 'AK' ? 'selected' : '' }}>Alaska</option>
                        <option value="AZ" {{ old('state') == 'AZ' ? 'selected' : '' }}>Arizona</option>
                        <option value="AR" {{ old('state') == 'AR' ? 'selected' : '' }}>Arkansas</option>
                        <option value="CA" {{ old('state') == 'CA' ? 'selected' : '' }}>California</option>
                        <option value="CO" {{ old('state') == 'CO' ? 'selected' : '' }}>Colorado</option>
                        <option value="CT" {{ old('state') == 'CT' ? 'selected' : '' }}>Connecticut</option>
                        <option value="DE" {{ old('state') == 'DE' ? 'selected' : '' }}>Delaware</option>
                        <option value="FL" {{ old('state') == 'FL' ? 'selected' : '' }}>Florida</option>
                        <option value="GA" {{ old('state') == 'GA' ? 'selected' : '' }}>Georgia</option>
                        <option value="HI" {{ old('state') == 'HI' ? 'selected' : '' }}>Hawaii</option>
                        <option value="ID" {{ old('state') == 'ID' ? 'selected' : '' }}>Idaho</option>
                        <option value="IL" {{ old('state') == 'IL' ? 'selected' : '' }}>Illinois</option>
                        <option value="IN" {{ old('state') == 'IN' ? 'selected' : '' }}>Indiana</option>
                        <option value="IA" {{ old('state') == 'IA' ? 'selected' : '' }}>Iowa</option>
                        <option value="KS" {{ old('state') == 'KS' ? 'selected' : '' }}>Kansas</option>
                        <option value="KY" {{ old('state') == 'KY' ? 'selected' : '' }}>Kentucky</option>
                        <option value="LA" {{ old('state') == 'LA' ? 'selected' : '' }}>Louisiana</option>
                        <option value="ME" {{ old('state') == 'ME' ? 'selected' : '' }}>Maine</option>
                        <option value="MD" {{ old('state') == 'MD' ? 'selected' : '' }}>Maryland</option>
                        <option value="MA" {{ old('state') == 'MA' ? 'selected' : '' }}>Massachusetts</option>
                        <option value="MI" {{ old('state') == 'MI' ? 'selected' : '' }}>Michigan</option>
                        <option value="MN" {{ old('state') == 'MN' ? 'selected' : '' }}>Minnesota</option>
                        <option value="MS" {{ old('state') == 'MS' ? 'selected' : '' }}>Mississippi</option>
                        <option value="MO" {{ old('state') == 'MO' ? 'selected' : '' }}>Missouri</option>
                        <option value="MT" {{ old('state') == 'MT' ? 'selected' : '' }}>Montana</option>
                        <option value="NE" {{ old('state') == 'NE' ? 'selected' : '' }}>Nebraska</option>
                        <option value="NV" {{ old('state') == 'NV' ? 'selected' : '' }}>Nevada</option>
                        <option value="NH" {{ old('state') == 'NH' ? 'selected' : '' }}>New Hampshire</option>
                        <option value="NJ" {{ old('state') == 'NJ' ? 'selected' : '' }}>New Jersey</option>
                        <option value="NM" {{ old('state') == 'NM' ? 'selected' : '' }}>New Mexico</option>
                        <option value="NY" {{ old('state') == 'NY' ? 'selected' : '' }}>New York</option>
                        <option value="NC" {{ old('state') == 'NC' ? 'selected' : '' }}>North Carolina</option>
                        <option value="ND" {{ old('state') == 'ND' ? 'selected' : '' }}>North Dakota</option>
                        <option value="OH" {{ old('state') == 'OH' ? 'selected' : '' }}>Ohio</option>
                        <option value="OK" {{ old('state') == 'OK' ? 'selected' : '' }}>Oklahoma</option>
                        <option value="OR" {{ old('state') == 'OR' ? 'selected' : '' }}>Oregon</option>
                        <option value="PA" {{ old('state') == 'PA' ? 'selected' : '' }}>Pennsylvania</option>
                        <option value="RI" {{ old('state') == 'RI' ? 'selected' : '' }}>Rhode Island</option>
                        <option value="SC" {{ old('state') == 'SC' ? 'selected' : '' }}>South Carolina</option>
                        <option value="SD" {{ old('state') == 'SD' ? 'selected' : '' }}>South Dakota</option>
                        <option value="TN" {{ old('state') == 'TN' ? 'selected' : '' }}>Tennessee</option>
                        <option value="TX" {{ old('state') == 'TX' ? 'selected' : '' }}>Texas</option>
                        <option value="UT" {{ old('state') == 'UT' ? 'selected' : '' }}>Utah</option>
                        <option value="VT" {{ old('state') == 'VT' ? 'selected' : '' }}>Vermont</option>
                        <option value="VA" {{ old('state') == 'VA' ? 'selected' : '' }}>Virginia</option>
                        <option value="WA" {{ old('state') == 'WA' ? 'selected' : '' }}>Washington</option>
                        <option value="WV" {{ old('state') == 'WV' ? 'selected' : '' }}>West Virginia</option>
                        <option value="WI" {{ old('state') == 'WI' ? 'selected' : '' }}>Wisconsin</option>
                        <option value="WY" {{ old('state') == 'WY' ? 'selected' : '' }}>Wyoming</option>
                    </select>
                    @error('state')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Zip -->
                <div>
                    <label for="zip" class="block text-sm font-medium text-gray-700 mb-1">Zip Code <span class="text-red-500">*</span></label>
                    <input type="text" id="zip" name="zip" value="{{ old('zip') }}" required 
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
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
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
                        <option value="credit_card" {{ old('payment_method') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                        <option value="paypal" {{ old('payment_method') == 'paypal' ? 'selected' : '' }}>PayPal</option>
                        <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    </select>
                    @error('payment_method')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Card Last Four -->
                <div>
                    <label for="card_last_four" class="block text-sm font-medium text-gray-700 mb-1">Last 4 Digits of Card (if applicable)</label>
                    <input type="text" id="card_last_four" name="card_last_four" value="{{ old('card_last_four') }}" maxlength="4" 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    @error('card_last_four')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Notes -->
                <div class="col-span-2">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Admin Notes</label>
                    <textarea id="notes" name="notes" rows="4" 
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 pt-6 border-t border-gray-200 text-right">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Create Package Booking
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
            document.getElementById('package_price').value = selectedOption.getAttribute('data-price');
        } else {
            document.getElementById('package_name').value = '';
            document.getElementById('package_price').value = '';
        }
    }
    
    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        updatePackageDetails();
    });
</script>
@endpush
@endsection