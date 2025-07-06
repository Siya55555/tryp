@extends('layouts.admin')

@section('title', 'CAPTCHA Settings')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Cloudflare Turnstile CAPTCHA Settings</h1>
    
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif          <form action="{{ route('admin.settings.captcha.update') }}" method="POST">
            @csrf
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">API Configuration</h2>
                <p class="text-gray-600 mb-4">
                    Enter your Cloudflare Turnstile API credentials. You can get these from your 
                    <a href="https://dash.cloudflare.com/?to=/:account/turnstile" target="_blank" class="text-blue-600 hover:underline">
                        Cloudflare Dashboard
                    </a>.                </p>                  <div class="flex items-center mb-4">
                    <input type="checkbox" id="enabled" name="enabled" value="1" 
                           {{ isset($settings) && (is_object($settings) ? $settings->enabled : ($settings['enabled'] ?? false)) ? 'checked' : '' }} 
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="enabled" class="ml-2 block text-sm text-gray-700">
                        Enable CAPTCHA Protection
                    </label>
                </div>
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">                    <div>                        <label for="site_key" class="block text-sm font-medium text-gray-700 mb-1">Site Key</label>
                        <input type="text" name="site_key" id="site_key" 
                               value="{{ isset($settings) ? (is_object($settings) ? $settings->site_key : ($settings['site_key'] ?? '')) : '' }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('site_key')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                      <div>                        <label for="secret_key" class="block text-sm font-medium text-gray-700 mb-1">Secret Key</label>
                        <input type="password" name="secret_key" id="secret_key" 
                               value="{{ isset($settings) ? (is_object($settings) ? $settings->secret_key : ($settings['secret_key'] ?? '')) : '' }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('secret_key')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Form Protection Settings</h2>
                <p class="text-gray-600 mb-4">
                    Choose which forms should be protected by CAPTCHA.
                </p>
                  <div class="space-y-3">                    <div class="flex items-center">
                        <input type="checkbox" id="enable_on_login" name="enable_on_login" value="1" 
                               {{ isset($settings) && (is_object($settings) ? $settings->enable_on_login : ($settings['enable_on_login'] ?? false)) ? 'checked' : '' }} 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="enable_on_login" class="ml-2 block text-sm text-gray-700">
                            Login Form
                        </label>
                    </div>                      <div class="flex items-center">
                        <input type="checkbox" id="enable_on_register" name="enable_on_register" value="1" 
                               {{ isset($settings) && (is_object($settings) ? $settings->enable_on_register : ($settings['enable_on_register'] ?? false)) ? 'checked' : '' }} 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="enable_on_register" class="ml-2 block text-sm text-gray-700">
                            Registration Form
                        </label>
                    </div>                      <div class="flex items-center">
                        <input type="checkbox" id="enable_on_contact" name="enable_on_contact" value="1" 
                               {{ isset($settings) && (is_object($settings) ? $settings->enable_on_contact : ($settings['enable_on_contact'] ?? false)) ? 'checked' : '' }} 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="enable_on_contact" class="ml-2 block text-sm text-gray-700">
                            Contact Form
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg mb-6">
                <h3 class="text-sm font-medium text-gray-700 mb-2">How to implement Cloudflare Turnstile</h3>
                <ol class="list-decimal list-inside text-sm text-gray-600 space-y-1">
                    <li>Create a site in your Cloudflare Turnstile dashboard</li>
                    <li>Copy the Site Key and Secret Key</li>
                    <li>Paste them in the fields above</li>
                    <li>Check the forms you want to protect</li>
                    <li>Save the settings</li>
                </ol>
            </div>
            
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
