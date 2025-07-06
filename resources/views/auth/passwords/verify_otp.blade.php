@extends('layouts.app')

@section('title', 'Verify OTP')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center mb-6">
                <i class="fas fa-mobile-alt text-white text-2xl"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Verify OTP</h2>
            <p class="text-gray-600">Enter the code sent to your email</p>
        </div>

        <!-- OTP Verification Form -->
        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            
            <!-- Info Message -->
            <div class="mb-6 text-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                <i class="fas fa-info-circle text-blue-500 mb-2"></i>
                <p class="text-sm text-blue-700">
                    We've sent a 6-digit verification code to your email address for password reset verification.
                </p>
            </div>
            
            <form method="POST" action="{{ route('password.verify.post') }}" class="space-y-6">
                @csrf
                
                <!-- Email Field (Read-only) -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700">
                        Email Address
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required readonly
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-700 bg-gray-50 cursor-not-allowed">
                    </div>
                    @error('email')
                        <p class="text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <!-- OTP Field -->
                <div class="space-y-2">
                    <label for="otp" class="block text-sm font-semibold text-gray-700">
                        Verification Code
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-key text-gray-400"></i>
                        </div>
                        <input id="otp" type="text" name="otp" value="{{ old('otp') }}" required 
                            placeholder="Enter 6-digit code"
                            maxlength="6"
                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 ease-in-out text-center text-2xl font-mono tracking-widest">
                    </div>
                    @error('otp')
                        <p class="text-sm text-red-600 flex items-center">
                            <i class="fas fa-exclamation-circle mr-1"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                
                <!-- Verify Button -->
                <div>
                    <button type="submit" 
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-semibold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200 ease-in-out transform hover:scale-105">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-check text-white"></i>
                        </span>
                        Verify OTP
                    </button>
                </div>
            </form>
            
            <!-- Divider -->
            <div class="mt-8 relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white text-gray-500">Didn't receive the code?</span>
                </div>
            </div>
            
            <!-- Request New Code -->
            <div class="mt-6 text-center">
                <a href="{{ route('password.request') }}" 
                    class="inline-flex items-center px-4 py-2 border border-blue-600 text-sm font-medium rounded-lg text-blue-600 bg-white hover:bg-blue-50 transition duration-200 ease-in-out">
                    <i class="fas fa-redo mr-2"></i>
                    Request New Code
                </a>
            </div>
        </div>
        
        <!-- Help Section -->
        <div class="bg-white rounded-lg shadow-sm p-4 border border-gray-200">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <i class="fas fa-question-circle text-blue-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-gray-900">Having trouble?</h3>
                    <div class="mt-1 text-sm text-gray-700">
                        <p>Check your spam folder or contact support if you don't receive the code within 5 minutes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection