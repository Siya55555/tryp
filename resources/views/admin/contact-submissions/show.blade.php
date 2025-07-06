@extends('layouts.admin')

@section('title', 'View Contact Submission')

@section('page-title', 'View Contact Submission')
@section('page-description', 'View and reply to contact form submission')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.contact-submissions.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-md inline-block">
            <i class="fas fa-arrow-left mr-1"></i> Back to List
        </a>
    </div>

    <!-- Submission Details Card -->
    <div class="bg-white shadow rounded-lg overflow-hidden mb-6">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-800">Submission Details</h3>
            <div class="flex space-x-2">
                <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full 
                    {{ $submission->status === 'new' ? 'bg-blue-100 text-blue-800' : 
                      ($submission->status === 'read' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                    {{ ucfirst($submission->status) }}
                </span>
                
                @if($submission->replied_at)
                    <span class="px-3 py-1 inline-flex text-sm font-semibold rounded-full bg-gray-100 text-gray-800">
                        Replied: {{ $submission->replied_at->format('M d, Y H:i') }}
                    </span>
                @endif
            </div>
        </div>
        
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Name</h4>
                    <p class="text-lg text-gray-800">{{ $submission->first_name }} {{ $submission->last_name }}</p>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Package Holder</h4>
                    <p class="text-lg text-gray-800">{{ $submission->package_holder === 'yes' ? 'Yes' : 'No' }}</p>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Email</h4>
                    <p class="text-lg text-gray-800">
                        <a href="mailto:{{ $submission->email }}" class="text-blue-600 hover:text-blue-900">
                            {{ $submission->email }}
                        </a>
                    </p>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Phone</h4>
                    <p class="text-lg text-gray-800">
                        <a href="tel:{{ $submission->phone }}" class="text-blue-600 hover:text-blue-900">
                            {{ $submission->phone }}
                        </a>
                    </p>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500 mb-1">Submitted On</h4>
                    <p class="text-lg text-gray-800">{{ $submission->created_at->format('F d, Y H:i:s') }}</p>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-6">
                <h4 class="text-sm font-medium text-gray-500 mb-2">Message</h4>
                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <p class="text-gray-800 whitespace-pre-line">{{ $submission->message }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Reply Form -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800">Reply to {{ $submission->first_name }}</h3>
        </div>
        
        <div class="p-6">
            @if ($submission->status === 'replied')
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                You have already replied to this message on {{ $submission->replied_at->format('F d, Y H:i') }}.
                            </p>
                        </div>
                    </div>
                </div>
            @endif
            
            <form action="{{ route('admin.contact-submissions.reply', $submission->id) }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <input type="text" name="subject" id="subject" 
                        value="{{ old('subject', 'Re: Your message to MyTravel') }}"
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                              @error('subject') border-red-500 @enderror"
                        required>
                    @error('subject')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="mb-4">
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                    <textarea name="message" id="message" rows="8" 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500
                              @error('message') border-red-500 @enderror"
                        required>{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                    
                    <p class="mt-2 text-sm text-gray-500">
                        This message will be sent to {{ $submission->email }}.
                    </p>
                </div>
                
                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-md">
                        <i class="fas fa-paper-plane mr-1"></i> Send Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection