@extends('layouts.admin')

@section('title', 'Contact Settings')

@section('content')
<div class="py-6 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="border-b border-gray-200 bg-gray-50 px-4 py-5 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Contact Settings</h3>
        </div>
        
        <div class="px-4 py-5 sm:p-6">
            @if(session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('admin.contact-settings.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-y-6 gap-x-8 md:grid-cols-2">
                    <div>
                        <div class="mb-6">
                            <label for="service_number" class="block text-sm font-medium text-gray-700">Service Number</label>
                            <input type="text" name="service_number" id="service_number" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                   @error('service_number') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   value="{{ old('service_number', $contactSettings->service_number) }}" 
                                   maxlength="20">
                            @error('service_number')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="sales_office_number" class="block text-sm font-medium text-gray-700">Sales Office Number</label>
                            <input type="text" name="sales_office_number" id="sales_office_number" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                   @error('sales_office_number') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   value="{{ old('sales_office_number', $contactSettings->sales_office_number) }}" 
                                   maxlength="20">
                            @error('sales_office_number')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="po_box_address" class="block text-sm font-medium text-gray-700">PO Box Address</label>
                            <input type="text" name="po_box_address" id="po_box_address" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                   @error('po_box_address') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   value="{{ old('po_box_address', $contactSettings->po_box_address) }}" 
                                   maxlength="100">
                            @error('po_box_address')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div>
                        <div class="mb-6">
                            <label for="work_hours_weekday" class="block text-sm font-medium text-gray-700">Weekday Working Hours</label>
                            <input type="text" name="work_hours_weekday" id="work_hours_weekday" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                   @error('work_hours_weekday') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   value="{{ old('work_hours_weekday', $contactSettings->work_hours_weekday) }}" 
                                   maxlength="50" placeholder="e.g. Monday-Friday: 9:00 AM - 5:00 PM">
                            @error('work_hours_weekday')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="work_hours_weekend" class="block text-sm font-medium text-gray-700">Weekend Working Hours</label>
                            <input type="text" name="work_hours_weekend" id="work_hours_weekend" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                   @error('work_hours_weekend') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   value="{{ old('work_hours_weekend', $contactSettings->work_hours_weekend) }}" 
                                   maxlength="50" placeholder="e.g. Saturday-Sunday: 10:00 AM - 3:00 PM">
                            @error('work_hours_weekend')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="contact_email" class="block text-sm font-medium text-gray-700">Contact Email (Public-facing)</label>
                            <input type="email" name="contact_email" id="contact_email" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                   @error('contact_email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   value="{{ old('contact_email', $contactSettings->contact_email) }}" 
                                   maxlength="100" placeholder="e.g. info@example.com">
                            @error('contact_email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-6">
                            <label for="contact_recipient_email" class="block text-sm font-medium text-gray-700">Contact Form Recipient Email</label>
                            <input type="email" name="contact_recipient_email" id="contact_recipient_email" 
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                   @error('contact_recipient_email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                   value="{{ old('contact_recipient_email', $contactSettings->contact_recipient_email) }}" 
                                   maxlength="100" placeholder="e.g. contact@example.com">
                            <p class="mt-2 text-sm text-gray-500">
                                This email address will receive messages sent through the contact form.
                            </p>
                            @error('contact_recipient_email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <!-- Add this after the existing grid in index.blade.php -->
                <div class="mt-8 border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Email Configuration</h3>
                    <p class="text-sm text-gray-500 mb-6">Configure the mail settings for sending emails from the contact form.</p>
                    
                    <div class="grid grid-cols-1 gap-y-6 gap-x-8 md:grid-cols-2">
                        <div>
                            <div class="mb-6">
                                <label for="mail_mailer" class="block text-sm font-medium text-gray-700">Mail Mailer</label>
                                <input type="text" name="mail_mailer" id="mail_mailer" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                    @error('mail_mailer') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                    value="{{ old('mail_mailer', $contactSettings->mail_mailer) }}" 
                                    placeholder="e.g. smtp">
                                @error('mail_mailer')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="mail_host" class="block text-sm font-medium text-gray-700">Mail Host</label>
                                <input type="text" name="mail_host" id="mail_host" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                    @error('mail_host') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                    value="{{ old('mail_host', $contactSettings->mail_host) }}" 
                                    placeholder="e.g. smtp.hostinger.com">
                                @error('mail_host')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="mail_port" class="block text-sm font-medium text-gray-700">Mail Port</label>
                                <input type="text" name="mail_port" id="mail_port" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                    @error('mail_port') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                    value="{{ old('mail_port', $contactSettings->mail_port) }}" 
                                    placeholder="e.g. 465">
                                @error('mail_port')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="mail_encryption" class="block text-sm font-medium text-gray-700">Mail Encryption</label>
                                <input type="text" name="mail_encryption" id="mail_encryption" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                    @error('mail_encryption') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                    value="{{ old('mail_encryption', $contactSettings->mail_encryption) }}" 
                                    placeholder="e.g. tls">
                                @error('mail_encryption')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div>
                            <div class="mb-6">
                                <label for="mail_username" class="block text-sm font-medium text-gray-700">Mail Username</label>
                                <input type="text" name="mail_username" id="mail_username" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                    @error('mail_username') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                    value="{{ old('mail_username', $contactSettings->mail_username) }}" 
                                    placeholder="e.g. noreply@example.com">
                                @error('mail_username')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="mail_password" class="block text-sm font-medium text-gray-700">Mail Password</label>
                                <input type="password" name="mail_password" id="mail_password" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                    @error('mail_password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                    value="{{ old('mail_password', $contactSettings->mail_password) }}" 
                                    placeholder="Enter password">
                                <p class="mt-1 text-xs text-gray-500">Leave blank to keep the current password.</p>
                                @error('mail_password')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="mail_from_address" class="block text-sm font-medium text-gray-700">From Email Address</label>
                                <input type="email" name="mail_from_address" id="mail_from_address" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                    @error('mail_from_address') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                    value="{{ old('mail_from_address', $contactSettings->mail_from_address) }}" 
                                    placeholder="e.g. noreply@example.com">
                                @error('mail_from_address')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-6">
                                <label for="mail_from_name" class="block text-sm font-medium text-gray-700">From Name</label>
                                <input type="text" name="mail_from_name" id="mail_from_name" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm
                                    @error('mail_from_name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500 @enderror" 
                                    value="{{ old('mail_from_name', $contactSettings->mail_from_name) }}" 
                                    placeholder="e.g. MyTravel Support">
                                @error('mail_from_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-5 border-t border-gray-200">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="h-4 w-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection