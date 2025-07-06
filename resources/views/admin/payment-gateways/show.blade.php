@extends('layouts.admin')

@section('title', 'Payment Gateway Details')

@section('content')
    <div class="container px-4 mx-auto">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Payment Gateway Details</h1>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-2 mt-4 sm:mt-0">
                <a href="{{ route('admin.payment-gateways.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-sm text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to List
                </a>
                <a href="{{ route('admin.payment-gateways.edit', $gateway->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Gateway
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-700">{{ $gateway->display_name }}</h2>
                <div class="flex space-x-2 mt-2 sm:mt-0">
                    @if($gateway->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            Inactive
                        </span>
                    @endif
                    
                    @if($gateway->is_default)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            Default
                        </span>
                    @endif
                </div>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/6 flex justify-center mb-6 md:mb-0">
                        @if($gateway->icon)
                            <img src="{{ asset('storage/' . $gateway->icon) }}" alt="{{ $gateway->name }}" class="h-24 w-auto object-contain">
                        @else
                            <div class="flex items-center justify-center h-24 w-24 rounded-full bg-gray-100">
                                <svg class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="md:w-5/6 md:pl-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Internal Name:</h3>
                                <p class="mt-1 text-base text-gray-900">{{ $gateway->name }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Gateway Type:</h3>
                                <p class="mt-1 text-base text-gray-900">{{ ucfirst(str_replace('_', ' ', $gateway->gateway_type)) }}</p>
                            </div>
                        </div>
                        
                        @if($gateway->description)
                            <div class="mt-6">
                                <h3 class="text-sm font-medium text-gray-500">Description:</h3>
                                <p class="mt-1 text-base text-gray-900">{{ $gateway->description }}</p>
                            </div>
                        @endif
                        
                        @if($gateway->instructions)
                            <div class="mt-6">
                                <h3 class="text-sm font-medium text-gray-500">Customer Instructions:</h3>
                                <p class="mt-1 text-base text-gray-900">{{ $gateway->instructions }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Gateway Configuration</h3>
                    @php 
                        $config = $gateway->getConfigArray();
                    @endphp
                    
                    @if(!empty($config))
                        <div class="overflow-x-auto rounded-lg border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/3">Setting</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($config as $key => $value)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ ucwords(str_replace('_', ' ', $key)) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if(in_array($key, ['api_key', 'secret', 'secret_key', 'webhook_secret', 'transaction_key', 'login_id']))
                                                    <span class="italic text-gray-400">***** (Hidden for security)</span>
                                                @elseif(is_bool($value))
                                                    {{ $value ? 'Yes' : 'No' }}
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="rounded-md bg-blue-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3 flex-1 md:flex md:justify-between">
                                    <p class="text-sm text-blue-700">
                                        No configuration settings found for this gateway.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection