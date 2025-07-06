<!-- resources/views/components/footer.blade.php -->
<footer class="text-white pt-16 pb-8" style="background: linear-gradient(to right, {{ $settings['footer_bg_color_from'] ?? '#1e3a8a' }}, {{ $settings['footer_bg_color_to'] ?? '#1e40af' }})">
    <div class="container mx-auto px-4">        <!-- Footer Top Section with Logo and Newsletter -->
        <div class="flex flex-col lg:flex-row justify-between items-center mb-12 pb-8 border-b border-white/20">
            <!-- Logo Area -->
            <div class="mb-8 lg:mb-0">
                <a href="/" class="flex items-center space-x-2">                    @if(isset($settings['site_logo']))
                        <img src="{{ $settings['site_logo'] }}" alt="{{ $settings['company_name'] ?? 'MyTravel' }}" class="">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M5.5 16a.5.5 0 01-.5-.5v-6a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v6a.5.5 0 01-.5.5h-1zm3 0a.5.5 0 01-.5-.5v-6a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v6a.5.5 0 01-.5.5h-1zm4.5-.5a.5.5 0 00.5-.5v-6a.5.5 0 00-.5-.5h-1a.5.5 0 00-.5.5v6a.5.5 0 00.5.5h1z"/>
                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14.5a6.5 6.5 0 110-13 6.5 6.5 0 010 13z" clip-rule="evenodd"/>
                        </svg>
                    @endif
                </a>
            </div>
              <!-- Newsletter Signup -->
            <div class="w-full lg:w-auto">
                <h3 class="font-bold text-xl mb-4 text-center lg:text-left">Subscribe to Our Newsletter</h3>                
                <form id="newsletter-form" class="flex flex-col sm:flex-row gap-2">
                    @csrf
                    <input 
                        type="email" 
                        name="email"
                        id="newsletter-email"
                        placeholder="Your email address" 
                        class="px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:ring-white/30 bg-white/90 text-gray-800 w-full"
                        required>                 
                    <button 
                        type="submit"
                        class="btn-primary text-white font-semibold px-6 py-3 rounded-lg transition duration-300 whitespace-nowrap">
                        Subscribe
                    </button>
                </form>
                <div id="newsletter-message" class="mt-3 text-sm hidden"></div>
                <p class="text-white/80 text-sm mt-3">Get exclusive travel deals and tips direct to your inbox.</p>
            </div>
        </div>
        
        <!-- Main Footer Links -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">            <!-- Company Info -->
            <div>                <h3 class="font-bold text-xl mb-6 relative inline-block">
                    <span class="relative z-10">About Us</span>
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-primary-600 to-primary-700 z-0"></span>
                </h3><p class="text-white/80 mb-6">{{ $settings['about_us_short'] ?? '' }}</p>
                <div class="flex space-x-4">                    <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-gradient-to-r hover:from-primary-600 hover:to-primary-700 flex items-center justify-center transition duration-300">
                        <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/>
                        </svg>                    </a>                    <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-gradient-to-r hover:from-primary-600 hover:to-primary-700 flex items-center justify-center transition duration-300">
                        <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                        </svg>
                    </a>                    <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-gradient-to-r hover:from-primary-600 hover:to-primary-700 flex items-center justify-center transition duration-300">
                        <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>                    <a href="#" class="w-10 h-10 rounded-full bg-white/20 hover:bg-gradient-to-r hover:from-primary-600 hover:to-primary-700 flex items-center justify-center transition duration-300">
                        <svg class="w-5 h-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/>
                        </svg>
                    </a>
                </div>            </div>              <!-- Vacation Bundles -->
            <div>                <h3 class="font-bold text-xl mb-6 relative inline-block">
                    <span class="relative z-10">Vacation Bundles</span>
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-primary-600 to-primary-700 z-0"></span>
                </h3>
                <ul class="space-y-3">
                    @php
                    // Get bundles directly from the database
                    $footerBundles = \App\Models\Admin\Bundle::where('status', 'active')
                                          ->orderBy('created_at', 'desc')
                                          ->take(6)
                                          ->get();
                    @endphp
                    
                    @foreach($footerBundles as $bundle)
                    <li>                        <a href="{{ route('bundles.show', $bundle->slug) }}" class="flex items-center text-white/80 hover:text-white transition-colors group">
                            <span class="w-2 h-2 bg-gradient-to-r from-primary-600 to-primary-700 rounded-full mr-2 group-hover:scale-125 transition-transform duration-300"></span>
                            {{ $bundle->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div><!-- Resources Links -->
            <div>                <h3 class="font-bold text-xl mb-6 relative inline-block">
                    <span class="relative z-10">Resources</span>
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-primary-600 to-primary-700 z-0"></span>
                </h3>
                <ul class="space-y-3">
                    <li>                        <a href="/blog" class="flex items-center text-white/80 hover:text-white transition-colors group">
                            <span class="w-2 h-2 bg-gradient-to-r from-primary-600 to-primary-700 rounded-full mr-2 group-hover:scale-125 transition-transform duration-300"></span>
                            Blog
                        </a></li>
                    <li>                        <a href="/faq" class="flex items-center text-white/80 hover:text-white transition-colors group">
                            <span class="w-2 h-2 bg-gradient-to-r from-primary-600 to-primary-700 rounded-full mr-2 group-hover:scale-125 transition-transform duration-300"></span>
                            FAQs
                        </a></li>
                    <li>                        <a href="/privacy-policy" class="flex items-center text-white/80 hover:text-white transition-colors group">
                            <span class="w-2 h-2 bg-gradient-to-r from-primary-600 to-primary-700 rounded-full mr-2 group-hover:scale-125 transition-transform duration-300"></span>
                            Privacy Policy
                        </a>
                    </li>
                    <li>                        <a href="/contact" class="flex items-center text-white/80 hover:text-white transition-colors group">
                            <span class="w-2 h-2 bg-gradient-to-r from-primary-600 to-primary-700 rounded-full mr-2 group-hover:scale-125 transition-transform duration-300"></span>
                            Contact
                        </a>
                    </li>
                </ul>
            </div>
              <!-- Contact Info -->
            <div>                <h3 class="font-bold text-xl mb-6 relative inline-block">
                    <span class="relative z-10">Contact Us</span>
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-primary-600 to-primary-700 z-0"></span>
                </h3>
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <div class="bg-white/20 rounded-full p-2 mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <span class="text-white/80">{{ $settings['company_address'] ?? '' }}</span>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-white/20 rounded-full p-2 mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <span class="text-white/80">{{ $settings['company_phone'] ?? '' }}</span>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-white/20 rounded-full p-2 mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-white/80">{{ $settings['company_email'] ?? '' }}</span>
                    </li>
                    <li class="flex items-start">
                        <div class="bg-white/20 rounded-full p-2 mr-3 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-white/80">{{ $settings['office_hours'] ?? '' }}</span>
                    </li>
                </ul>
            </div>
        </div>
          <!-- Payment Methods -->
        <div class="border-t border-white/20 pt-8 pb-8 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <p class="text-white/80 text-sm">We accept all major payment methods:</p>
                <div class="flex space-x-4 mt-3">
                    <div class="bg-white rounded h-8 w-12 flex items-center justify-center shadow-sm">
                        <span class="text-gray-800 font-bold text-xs">VISA</span>
                    </div>
                    <div class="bg-white rounded h-8 w-12 flex items-center justify-center shadow-sm">
                        <span class="text-gray-800 font-bold text-xs">MC</span>
                    </div>
                    <div class="bg-white rounded h-8 w-12 flex items-center justify-center shadow-sm">
                        <span class="text-gray-800 font-bold text-xs">AMEX</span>
                    </div>
                    <div class="bg-white rounded h-8 w-12 flex items-center justify-center shadow-sm">
                        <span class="text-gray-800 font-bold text-xs">PayPal</span>
                    </div>
                </div>
            </div>            
            <div class="text-center md:text-right">
                <p class="text-white/80 text-xs">&copy; 2025 {{ setting('company_name', 'MyTravel') }}. All rights reserved.</p>
            </div>        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const newsletterForm = document.getElementById('newsletter-form');
    const newsletterMessage = document.getElementById('newsletter-message');
    const emailInput = document.getElementById('newsletter-email');
    const submitButton = newsletterForm.querySelector('button[type="submit"]');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = emailInput.value.trim();
            if (!email) {
                showMessage('Please enter your email address.', 'error');
                return;
            }
            
            // Disable form during submission
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Subscribing...';
            
            // Create FormData
            const formData = new FormData();
            formData.append('email', email);
            formData.append('_token', document.querySelector('input[name="_token"]').value);
            
            // Submit via fetch
            fetch('{{ route("newsletter.subscribe") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showMessage(data.message, 'success');
                    emailInput.value = '';
                } else {
                    showMessage(data.message || 'An error occurred. Please try again.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showMessage('An error occurred. Please try again.', 'error');
            })
            .finally(() => {
                // Re-enable form
                submitButton.disabled = false;
                submitButton.innerHTML = 'Subscribe';
            });
        });
    }
    
    function showMessage(message, type) {
        newsletterMessage.className = `mt-3 text-sm ${type === 'success' ? 'text-green-300' : 'text-red-300'}`;
        newsletterMessage.textContent = message;
        newsletterMessage.classList.remove('hidden');
        
        // Hide message after 5 seconds
        setTimeout(() => {
            newsletterMessage.classList.add('hidden');
        }, 5000);
    }
});
</script>