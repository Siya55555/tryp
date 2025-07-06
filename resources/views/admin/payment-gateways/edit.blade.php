@extends('layouts.admin')

@section('title', 'Edit Payment Gateway')

@section('content')
    <div class="container px-4 mx-auto">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Edit Payment Gateway</h1>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('admin.payment-gateways.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-700">Gateway Details</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.payment-gateways.update', $gateway->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Internal Name <span class="text-red-500">*</span></label>
                            <input type="text" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                id="name" name="name" value="{{ old('name', $gateway->name) }}" required>
                            <p class="mt-1 text-sm text-gray-500">System name for the gateway. Used internally.</p>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="display_name" class="block text-sm font-medium text-gray-700">Display Name <span class="text-red-500">*</span></label>
                            <input type="text" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('display_name') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                id="display_name" name="display_name" value="{{ old('display_name', $gateway->display_name) }}" required>
                            <p class="mt-1 text-sm text-gray-500">Name shown to customers during checkout.</p>
                            @error('display_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="gateway_type" class="block text-sm font-medium text-gray-700">Gateway Type <span class="text-red-500">*</span></label>
                            <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('gateway_type') border-red-300 text-red-900 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                                id="gateway_type" name="gateway_type" required>
                                <option value="">-- Select Gateway Type --</option>
                                @foreach($gatewayTypes as $value => $label)
                                    <option value="{{ $value }}" {{ old('gateway_type', $gateway->gateway_type) == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('gateway_type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="icon" class="block text-sm font-medium text-gray-700">Gateway Icon</label>
                            <div class="mt-1 flex items-center">
                                @if($gateway->icon)
                                    <div class="mr-4">
                                        <img src="{{ asset('storage/' . $gateway->icon) }}" alt="{{ $gateway->name }}" class="h-10 w-auto object-contain">
                                    </div>
                                @endif
                                <input type="file" id="icon" name="icon" class="bg-white py-2 px-3 border border-gray-300 rounded-md shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 @error('icon') border-red-300 text-red-900 @enderror">
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Upload a new icon to replace the current one.</p>
                            @error('icon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" id="is_active" name="is_active" {{ old('is_active', $gateway->is_active) ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_active" class="font-medium text-gray-700">Active</label>
                                    <p class="text-gray-500">Enable or disable this payment gateway.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <input type="checkbox" id="is_default" name="is_default" {{ old('is_default', $gateway->is_default) ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="is_default" class="font-medium text-gray-700">Default Gateway</label>
                                    <p class="text-gray-500">Make this the default payment method.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                            id="description" name="description" rows="3">{{ old('description', $gateway->description) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Optional description for the payment method.</p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label for="instructions" class="block text-sm font-medium text-gray-700">Payment Instructions</label>
                        <textarea class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('instructions') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" 
                            id="instructions" name="instructions" rows="3">{{ old('instructions', $gateway->instructions) }}</textarea>
                        <p class="mt-1 text-sm text-gray-500">Instructions shown to customers during checkout.</p>
                        @error('instructions')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <hr class="my-8 border-gray-200">
                    
                    <div class="gateway-config-container mt-6">
                        @php 
                            $config = $gateway->getConfigArray();
                        @endphp

                        <!-- Stripe Configuration -->
                        <div class="gateway-config" id="stripe-config" style="display: none;">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Stripe Configuration</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="stripe_api_key" class="block text-sm font-medium text-gray-700">Publishable Key</label>
                                    <input type="text" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                                        id="stripe_api_key" name="stripe_api_key" value="{{ old('stripe_api_key', $config['api_key'] ?? '') }}">
                                </div>
                                <div>
                                    <label for="stripe_secret_key" class="block text-sm font-medium text-gray-700">Secret Key</label>
                                    <input type="password" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                                        id="stripe_secret_key" name="stripe_secret_key" value="{{ old('stripe_secret_key', $config['secret_key'] ?? '') }}">
                                    <p class="mt-1 text-sm text-gray-500">Leave blank to keep the current value.</p>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="stripe_webhook_secret" class="block text-sm font-medium text-gray-700">Webhook Secret</label>
                                <input type="password" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                                    id="stripe_webhook_secret" name="stripe_webhook_secret" value="{{ old('stripe_webhook_secret', $config['webhook_secret'] ?? '') }}">
                                <p class="mt-1 text-sm text-gray-500">Leave blank to keep the current value.</p>
                            </div>
                        </div>

                        <!-- PayPal Configuration -->
                        <div class="gateway-config" id="paypal-config" style="display: none;">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">PayPal Configuration</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="paypal_client_id" class="block text-sm font-medium text-gray-700">Client ID</label>
                                    <input type="text" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                                        id="paypal_client_id" name="paypal_client_id" value="{{ old('paypal_client_id', $config['client_id'] ?? '') }}">
                                </div>
                                <div>
                                    <label for="paypal_secret" class="block text-sm font-medium text-gray-700">Secret</label>
                                    <input type="password" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                                        id="paypal_secret" name="paypal_secret" value="{{ old('paypal_secret', $config['secret'] ?? '') }}">
                                    <p class="mt-1 text-sm text-gray-500">Leave blank to keep the current value.</p>
                                </div>
                            </div>
                            <div class="mb-6">
                                <label for="paypal_environment" class="block text-sm font-medium text-gray-700">Environment</label>
                                <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" 
                                    id="paypal_environment" name="paypal_environment">
                                    <option value="sandbox" {{ old('paypal_environment', $config['environment'] ?? '') == 'sandbox' ? 'selected' : '' }}>Sandbox (Testing)</option>
                                    <option value="production" {{ old('paypal_environment', $config['environment'] ?? '') == 'production' ? 'selected' : '' }}>Production (Live)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Authorize.net Configuration -->
                        <div class="gateway-config" id="authorize_net-config" style="display: none;">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Authorize.net Configuration</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                                <div>
                                    <label for="authorize_login_id" class="block text-sm font-medium text-gray-700">API Login ID</label>
                                    <input type="text" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                                        id="authorize_login_id" name="authorize_login_id" value="{{ old('authorize_login_id', $config['login_id'] ?? '') }}">
                                </div>
                                <div>
                                    <label for="authorize_transaction_key" class="block text-sm font-medium text-gray-700">Transaction Key</label>
                                    <input type="password" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" 
                                        id="authorize_transaction_key" name="authorize_transaction_key" value="{{ old('authorize_transaction_key', $config['transaction_key'] ?? '') }}">
                                    <p class="mt-1 text-sm text-gray-500">Leave blank to keep the current value.</p>
                                </div>
                            </div>
                            <div class="mb-6">
                                <div class="relative flex items-start">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" id="authorize_sandbox_mode" name="authorize_sandbox_mode" {{ old('authorize_sandbox_mode', $config['sandbox_mode'] ?? false) ? 'checked' : '' }} class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="authorize_sandbox_mode" class="font-medium text-gray-700">Sandbox Mode</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-start space-x-3 mt-8">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Update Gateway
                        </button>
                        <a href="{{ route('admin.payment-gateways.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Show/hide gateway configuration based on selected type
        $('#gateway_type').change(function() {
            var gatewayType = $(this).val();
            $('.gateway-config').hide();
            if (gatewayType) {
                $('#' + gatewayType + '-config').show();
            }
        });

        // Initialize on page load
        $('#gateway_type').trigger('change');
    });
</script>
@endpush