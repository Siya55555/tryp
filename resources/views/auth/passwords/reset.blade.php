@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-lock text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Set New Password</h2>
            <p class="text-gray-600">Create a strong password for your account</p>
        </div>

        <!-- Password Reset Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <!-- Security Notice -->
            <div class="mb-6 text-center p-4 bg-green-50 rounded-lg border border-green-200">
                <i class="fas fa-check-circle text-green-500 mb-2"></i>
                <p class="text-sm text-green-700">
                    Your identity has been verified. Please set your new password below.
                </p>
            </div>
            
            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                
                <input type="hidden" name="email" value="{{ $email }}">
                
                <!-- New Password Field -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-gray-700">
                        New Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password" type="password" name="password" required 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                            placeholder="Enter your new password">
                    </div>
                    @error('password')
                        <p class="text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                    <!-- Password Requirements -->
                    <div class="mt-2 text-xs text-gray-600 bg-gray-50 p-3 rounded-lg">
                        <p class="font-medium mb-1">Password must contain:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li>At least 8 characters</li>
                            <li>Mix of uppercase and lowercase letters</li>
                            <li>At least one number</li>
                            <li>At least one special character</li>
                        </ul>
                    </div>
                </div>
                
                <!-- Confirm Password Field -->
                <div class="space-y-2">
                    <label for="password-confirm" class="block text-sm font-semibold text-gray-700">
                        Confirm New Password
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input id="password-confirm" type="password" name="password_confirmation" required 
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out"
                            placeholder="Confirm your new password">
                    </div>
                </div>
                
                <!-- Reset Password Button -->
                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 ease-in-out transform hover:scale-105">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-key text-white"></i>
                        </span>
                        Update Password
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Security Tips -->
        <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-lightbulb text-yellow-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">Security Tips</h3>
                    <div class="mt-2 text-sm text-gray-700">
                        <ul class="list-disc list-inside space-y-1">
                            <li>Use a unique password you haven't used before</li>
                            <li>Consider using a password manager</li>
                            <li>Don't share your password with anyone</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection