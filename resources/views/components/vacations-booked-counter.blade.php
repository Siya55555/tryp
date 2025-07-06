<!-- Vacations Booked Counter - Matched to MyTravel Theme -->
<section class="counter-bg py-16 sm:py-20 lg:py-24 overflow-hidden relative">
    <!-- Background with MyTravel blue gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-blue-600 via-blue-500 to-blue-700 opacity-95"></div>
    
    <!-- Subtle wave patterns -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="opacity-10">
            <path fill="#ffffff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,224C1248,203,1344,181,1392,170.7L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
    
    <div class="container mx-auto px-4 max-w-7xl relative z-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-12">
            <!-- Counter Text -->
            <div class="w-full md:w-1/2 text-center md:text-left">
                <div class="max-w-lg mx-auto md:mx-0 transform transition-all duration-500 hover:-translate-y-1">
                    <div class="inline-block text-lg sm:text-xl font-medium uppercase tracking-wider mb-2 text-white counter-shadow relative">
                        <span class="relative z-10">OVER</span>
                        <span class="absolute bottom-0 left-0 w-full h-1 bg-yellow-400 transform -skew-x-12"></span>
                    </div>
                    <div class="counter-number text-5xl sm:text-6xl md:text-8xl font-extrabold mb-6 text-white counter-shadow flex flex-wrap justify-center md:justify-start items-baseline">
                        <span id="counter" class="inline-block">665,245</span>
                        <span class="inline-block text-teal-500 relative ml-1">
                            <span class="animate-ping absolute h-full w-full rounded-full bg-teal-500 opacity-30"></span>
                            <span class="relative secondary-text-color" >+</span>
                        </span>
                    </div>
                    <div class="text-xl sm:text-2xl font-medium counter-shadow leading-tight text-white">
                        VACATIONS BOOKED THROUGH 
                        <span class="block mt-2 text-white font-bold text-3xl sm:text-4xl tracking-tight">{{ setting('company_name', 'MyTravel') }}</span>
                        <span class="block mt-2 relative">
                            AND COUNTING
                            <span class="absolute -right-2 -bottom-2 h-4 w-4 bg-yellow-400 rounded-full opacity-70 animate-pulse"></span>
                        </span>
                    </div>
                    
                    <!-- Features badges - matching style from your website -->
                    <div class="flex flex-wrap gap-3 mt-6 justify-center md:justify-start">
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm text-dark rounded-full px-4 py-2 text-sm font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            No Blackout Dates
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm text-dark rounded-full px-4 py-2 text-sm font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            18 Months To Book
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-blur-sm text-dark rounded-full px-4 py-2 text-sm font-medium flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Price Guaranteed
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Image -->
            <div class="w-full md:w-1/2 transform transition-all duration-500 hover:scale-105 relative">
                <div class="absolute -inset-4 bg-white rounded-2xl opacity-10 blur-xl"></div>
                <div class="relative group">
                    <div class="absolute -inset-1  secondary-text-color rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-1000"></div>
                    <div class="relative">
                        <img src="https://images.unsplash.com/photo-1716703373229-b0e43de7dd5c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Reservations team" class="rounded-2xl shadow-2xl mx-auto">
                        
                        <!-- Badge - styled like the current site -->
                        <div class="absolute -bottom-4 -right-3 bg-yellow-400 text-white font-bold py-2 px-4 rounded-lg shadow-lg flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Trusted Service</span>
                        </div>
                        
                        <!-- Stats badge - styled like the stats on your site -->
                        <div class="absolute -top-4 -left-3 bg-white secondary-text-color font-bold py-2 px-4 rounded-lg shadow-lg flex items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 " viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span>5 Star Reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
       
    </div>
</section>

<style>
.counter-shadow {
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

@keyframes float-slow {
    0%, 100% { transform: translateY(0) translateX(0); }
    50% { transform: translateY(-10px) translateX(5px); }
}

.animate-float {
    animation: float-slow 6s ease-in-out infinite;
}
</style>

<script>
// Enhanced counter animation with easing
const counterElement = document.getElementById('counter');
const targetValue = 665245;
let currentValue = 665000;
let startTime = null;
const duration = 5000; // 2 seconds for animation

function easeOutExpo(t) {
    return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
}

function animate(timestamp) {
    if (!startTime) startTime = timestamp;
    const elapsed = timestamp - startTime;
    const progress = Math.min(elapsed / duration, 1);
    
    // Apply easing function for more natural movement
    const easedProgress = easeOutExpo(progress);
    
    // Calculate current value based on eased progress
    currentValue = Math.floor(665000 + (targetValue - 665000) * easedProgress);
    
    // Update with thousands separator
    counterElement.textContent = currentValue.toLocaleString();
    
    if (progress < 1) {
        window.requestAnimationFrame(animate);
    }
}

// Start the animation when the element is visible
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            window.requestAnimationFrame(animate);
            observer.disconnect();
        }
    });
}, { threshold: 0.1 });

observer.observe(counterElement);
</script>