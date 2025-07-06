@extends('layouts.admin')

@section('title', 'Compose Newsletter')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Compose Newsletter</h1>
                        <p class="text-gray-600 mt-1">Create and send newsletters to your subscribers</p>
                    </div>
                    <a href="{{ route('admin.email-subscriptions.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200 text-sm font-medium">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Subscriptions
                    </a>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Form Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <form method="POST" action="{{ route('admin.email-subscriptions.send') }}" id="newsletter-form">
                            @csrf
                            
                            <!-- Newsletter Subject -->
                            <div class="mb-6">
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">
                                    Newsletter Subject <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    name="subject" 
                                    id="subject" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 @error('subject') border-red-500 @enderror" 
                                    value="{{ old('subject') }}" 
                                    placeholder="Enter newsletter subject..."
                                    required>
                                @error('subject')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Recipients Selection -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 mb-4">
                                    Recipients <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="relative">
                                        <input 
                                            class="peer sr-only" 
                                            type="radio" 
                                            name="recipients" 
                                            id="all_active" 
                                            value="all_active" 
                                            {{ old('recipients', 'all_active') === 'all_active' ? 'checked' : '' }}>
                                        <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50" for="all_active">
                                            <div class="flex items-center h-5">
                                                <div class="w-4 h-4 border-2 rounded-full peer-checked:border-blue-500 peer-checked:bg-blue-500 relative">
                                                    <div class="w-2 h-2 bg-white rounded-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100"></div>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="font-medium text-gray-900">All Active Subscribers</div>
                                                <div class="text-sm text-gray-600">{{ $activeSubscriptions }} subscribers</div>
                                            </div>
                                        </label>
                                    </div>
                                    
                                    <div class="relative">
                                        <input 
                                            class="peer sr-only" 
                                            type="radio" 
                                            name="recipients" 
                                            id="selected" 
                                            value="selected" 
                                            {{ old('recipients') === 'selected' ? 'checked' : '' }}>
                                        <label class="flex items-start p-4 border-2 rounded-lg cursor-pointer transition-all duration-200 peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:bg-gray-50" for="selected">
                                            <div class="flex items-center h-5">
                                                <div class="w-4 h-4 border-2 rounded-full peer-checked:border-blue-500 peer-checked:bg-blue-500 relative">
                                                    <div class="w-2 h-2 bg-white rounded-full absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 opacity-0 peer-checked:opacity-100"></div>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="font-medium text-gray-900">Selected Subscribers</div>
                                                <div class="text-sm text-gray-600">Choose specific subscribers</div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Email Selection -->
                            <div id="email-selection" class="mb-6 hidden">
                                <label class="block text-sm font-medium text-gray-700 mb-3">Select Subscribers</label>
                                <div class="flex flex-col sm:flex-row gap-3 mb-4">
                                    <div class="flex-1">
                                        <input 
                                            type="text" 
                                            id="email-search" 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                            placeholder="Search subscribers by email...">
                                    </div>
                                    <button type="button" id="load-emails" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 font-medium whitespace-nowrap">
                                        <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                        Load Subscribers
                                    </button>
                                </div>
                                
                                <div id="email-list" class="border border-gray-300 rounded-lg p-4 max-h-80 overflow-y-auto bg-gray-50">
                                    <div class="text-center py-8 text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <p>Click "Load Subscribers" to see available email addresses</p>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <span class="text-sm text-gray-600">
                                        Selected: <span id="selected-email-count" class="font-medium">0</span> subscribers
                                    </span>
                                </div>
                            </div>

                            <!-- Newsletter Content -->
                            <div class="mb-6">
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                                    Newsletter Content <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    name="content" 
                                    id="content" 
                                    rows="15" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-y @error('content') border-red-500 @enderror" 
                                    placeholder="Write your newsletter content here..."
                                    required>{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                                <p class="text-sm text-gray-600 mt-2">
                                    You can use HTML tags for formatting. The newsletter will be sent in a styled template.
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-3">
                                <button type="submit" class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 font-medium" id="send-newsletter">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Send Newsletter
                                </button>
                                <button type="button" class="flex-1 sm:flex-none inline-flex items-center justify-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-200 font-medium" onclick="previewNewsletter()">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    Preview
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Live Preview -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            Live Preview
                        </h3>
                    </div>
                    <div class="p-6">
                        <div id="newsletter-preview" class="border border-gray-200 rounded-lg p-4 min-h-96 bg-gray-50">
                            <div class="text-center py-12 text-gray-500">
                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                                <p>Preview will appear here as you type</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Newsletter Tips -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                            </svg>
                            Newsletter Tips
                        </h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">Keep subject lines under 50 characters</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">Use clear, engaging content</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">Include call-to-action buttons</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">Test with different recipients</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-3 mt-0.5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">Preview before sending</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-hidden">
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
            <h3 class="text-xl font-semibold text-gray-900">Newsletter Preview</h3>
            <button type="button" class="p-2 hover:bg-gray-100 rounded-lg transition-colors duration-200" onclick="closePreviewModal()">
                <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="p-6 overflow-y-auto max-h-96">
            <div id="full-preview" class="bg-white"></div>
        </div>
        <div class="flex items-center justify-end gap-3 p-6 border-t border-gray-200">
            <button type="button" class="px-6 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-200 font-medium" onclick="closePreviewModal()">
                Close
            </button>
            <button type="button" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 font-medium" onclick="sendNewsletter()">
                Send Newsletter
            </button>
        </div>
    </div>
</div>

@push('styles')
<style>
.email-item {
    transition: all 0.2s;
}
.email-item:hover {
    background-color: #f9fafb;
}
.email-item.selected {
    background-color: #eff6ff;
    border-color: #3b82f6;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const recipientRadios = document.querySelectorAll('input[name="recipients"]');
    const emailSelection = document.getElementById('email-selection');
    const emailSearch = document.getElementById('email-search');
    const loadEmailsBtn = document.getElementById('load-emails');
    const emailList = document.getElementById('email-list');
    const selectedEmailCount = document.getElementById('selected-email-count');
    const subjectInput = document.getElementById('subject');
    const contentTextarea = document.getElementById('content');
    const previewDiv = document.getElementById('newsletter-preview');

    // Toggle email selection visibility
    recipientRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            emailSelection.classList.toggle('hidden', this.value !== 'selected');
        });
    });

    // Initialize
    if (document.querySelector('input[name="recipients"]:checked').value === 'selected') {
        emailSelection.classList.remove('hidden');
    }

    // Load subscribers
    loadEmailsBtn.addEventListener('click', function() {
        const search = emailSearch.value;
        
        this.disabled = true;
        this.innerHTML = '<svg class="w-4 h-4 animate-spin inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>Loading...';
        
        fetch(`{{ route('admin.email-subscriptions.get-subscriptions') }}?search=${encodeURIComponent(search)}`)
            .then(response => response.json())
            .then(data => {
                displayEmails(data);
            })
            .catch(error => {
                console.error('Error:', error);
                emailList.innerHTML = '<div class="text-red-600 text-center p-6">Error loading subscribers</div>';
            })
            .finally(() => {
                this.disabled = false;
                this.innerHTML = '<svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>Load Subscribers';
            });
    });

    function displayEmails(emails) {
        if (emails.length === 0) {
            emailList.innerHTML = '<div class="text-gray-500 text-center p-6">No subscribers found</div>';
            return;
        }

        let html = `
            <div class="flex gap-2 mb-4">
                <button type="button" class="px-3 py-1.5 text-sm bg-blue-100 hover:bg-blue-200 text-blue-700 rounded-md transition-colors duration-200" onclick="selectAllEmails()">Select All</button>
                <button type="button" class="px-3 py-1.5 text-sm bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-md transition-colors duration-200" onclick="deselectAllEmails()">Deselect All</button>
            </div>
        `;
        
        emails.forEach(email => {
            html += `
                <div class="email-item p-3 border border-gray-200 rounded-lg mb-2 hover:bg-gray-50 transition-colors duration-200" data-email-id="${email.id}">
                    <label class="flex items-center cursor-pointer">
                        <input class="form-checkbox h-4 w-4 text-blue-600 transition duration-150 ease-in-out email-checkbox" type="checkbox" name="selected_emails[]" value="${email.id}" id="email_${email.id}">
                        <span class="ml-3 text-sm text-gray-700">${email.email}</span>
                    </label>
                </div>
            `;
        });
        
        emailList.innerHTML = html;
        
        // Add event listeners to checkboxes
        const checkboxes = emailList.querySelectorAll('.email-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    }

    function updateSelectedCount() {
        const checked = emailList.querySelectorAll('.email-checkbox:checked');
        selectedEmailCount.textContent = checked.length;
    }

    // Live preview functionality
    function updatePreview() {
        const subject = subjectInput.value || 'Newsletter Subject';
        const content = contentTextarea.value || 'Newsletter content will appear here...';
        
        previewDiv.innerHTML = `
            <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
                <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
                    <h2 style="margin: 0; font-size: 24px;">${escapeHtml(subject)}</h2>
                </div>
                <div style="padding: 20px; background: white; border: 1px solid #e5e7eb; border-top: none;">
                    ${content}
                </div>
                <div style="padding: 15px; background: #f9fafb; text-align: center; font-size: 12px; color: #6b7280; border-radius: 0 0 8px 8px;">
                    <p style="margin: 0 0 8px 0;">You received this newsletter because you subscribed to our updates.</p>
                    <p style="margin: 0;"><a href="#" style="color: #6b7280; text-decoration: underline;">Unsubscribe</a></p>
                </div>
            </div>
        `;
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }

    // Update preview on input
    subjectInput.addEventListener('input', updatePreview);
    contentTextarea.addEventListener('input', updatePreview);
    
    // Initial preview
    updatePreview();

    // Form validation
    document.getElementById('newsletter-form').addEventListener('submit', function(e) {
        const recipients = document.querySelector('input[name="recipients"]:checked').value;
        
        if (recipients === 'selected') {
            const selectedEmails = document.querySelectorAll('input[name="selected_emails[]"]:checked');
            if (selectedEmails.length === 0) {
                e.preventDefault();
                alert('Please select at least one subscriber or choose "All Active Subscribers".');
                return;
            }
        }
        
        if (!confirm('Are you sure you want to send this newsletter?')) {
            e.preventDefault();
        }
    });
});

// Global functions for select all/deselect all
function selectAllEmails() {
    const checkboxes = document.querySelectorAll('.email-checkbox');
    checkboxes.forEach(checkbox => checkbox.checked = true);
    document.getElementById('selected-email-count').textContent = checkboxes.length;
}

function deselectAllEmails() {
    const checkboxes = document.querySelectorAll('.email-checkbox');
    checkboxes.forEach(checkbox => checkbox.checked = false);
    document.getElementById('selected-email-count').textContent = '0';
}

function previewNewsletter() {
    const subject = document.getElementById('subject').value || 'Newsletter Subject';
    const content = document.getElementById('content').value || 'Newsletter content will appear here...';
    
    document.getElementById('full-preview').innerHTML = `
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto;">
            <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 20px; text-align: center; border-radius: 8px 8px 0 0;">
                <h2 style="margin: 0; font-size: 24px;">${subject}</h2>
            </div>
            <div style="padding: 20px; background: white; border: 1px solid #e5e7eb; border-top: none;">
                ${content}
            </div>
            <div style="padding: 15px; background: #f9fafb; text-align: center; font-size: 12px; color: #6b7280; border-radius: 0 0 8px 8px;">
                <p style="margin: 0 0 8px 0;">You received this newsletter because you subscribed to our updates.</p>
                <p style="margin: 0;"><a href="#" style="color: #6b7280; text-decoration: underline;">Unsubscribe</a></p>
            </div>
        </div>
    `;
    
    document.getElementById('previewModal').classList.remove('hidden');
    document.getElementById('previewModal').classList.add('flex');
}

function closePreviewModal() {
    document.getElementById('previewModal').classList.add('hidden');
    document.getElementById('previewModal').classList.remove('flex');
}

function sendNewsletter() {
    document.getElementById('newsletter-form').submit();
}
</script>
@endpush
@endsection