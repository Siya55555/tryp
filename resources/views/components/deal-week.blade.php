<!-- resources/views/components/deal-week.blade.php -->
@php
    use App\Models\Admin\DealOfWeek;
    use Carbon\Carbon;
    
    // Get the active deal of the week
    $deal = DealOfWeek::where('status', 'active')
        ->where(function($query) {
            $query->whereNull('expires_at')
                  ->orWhere('expires_at', '>', Carbon::now());
        })
        ->first();
@endphp

@if($deal)
<section class="container mx-auto py-4 sm:py-8 px-2 sm:px-4" id="deal-week">
    <!-- Mobile view similar to image, desktop/tablet views unchanged -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden flex flex-col md:flex-row relative">
        <!-- Mobile Image (Full Width on top for small screens) -->
        <div class="w-full md:hidden relative">
            @if($deal->image)
                <img src="{{ filter_var($deal->image, FILTER_VALIDATE_URL) ? $deal->image : asset('storage/' . $deal->image) }}" 
                     alt="{{ $deal->title }}" class="w-full h-48 object-cover">
            @else
                <img src="{{ asset('images/las-vegas-strip.jpg') }}" alt="Deal of the Week" class="w-full h-48 object-cover">
            @endif
            
            <!-- Mobile Price Tag (Simple rectangle in top right like in image) -->
            <div class="absolute top-0 right-0 bg-yellow-400 text-gray-800 font-bold px-3 py-2">
                <div class="text-xs uppercase">Only</div>
                <div class="text-xl">${{ $deal->discount_price ?: $deal->price }}</div>
            </div>
        </div>

        <!-- Left Content -->
        <div class="p-4 sm:p-6 md:w-1/2 flex flex-col justify-between">
            <!-- Title designed like in image for mobile -->
            <div>
                <!-- Title with no "Bundle Deal of the Week" on mobile -->
                <h3 class="hidden sm:block text-blue-600 text-xs sm:text-sm font-semibold uppercase tracking-wider mb-2">Bundle Deal of the Week</h3>
                <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800 mb-3 sm:mb-4">{{ $deal->title }}</h2>
                
                @if($deal->subtitle)
                    <p class="text-gray-600 mb-4">{{ $deal->subtitle }}</p>
                @endif
                
                <!-- Features list with blue markers -->
                <ul class="text-gray-700 space-y-2 sm:space-y-3 text-sm sm:text-base">
                    @foreach($deal->features as $feature)
                        <li class="flex items-start">
                            <span class="text-blue-600 mr-2 text-lg flex-shrink-0">•</span> 
                            <span>{!! $feature !!}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Mobile buttons styled like in image (full width) -->
            <div class="mt-4 sm:mt-6 flex flex-col sm:flex-row gap-3 sm:gap-4">
                <a href="{{ route('bundles.index') }}" class="w-full sm:w-auto border-2 border-blue-600 text-blue-600 px-4 sm:px-6 py-2 rounded-full sm:rounded-full font-semibold hover:bg-blue-600 hover:text-white transition duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 text-sm sm:text-base">LEARN MORE</a>
                <a href="{{ $deal->cta_link ?: '/bundles' }}" class="w-full sm:w-auto bg-blue-600 text-white px-4 sm:px-6 py-2 rounded-full sm:rounded-full font-semibold hover:bg-blue-700 transition duration-300 shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 text-sm sm:text-base">{{ $deal->cta_text ?: 'BOOK NOW' }}</a>
            </div>

            <!-- Mobile countdown styled like in image -->
            @if($deal->expires_at)
                <div class="mt-4 sm:mt-6">
                    <p class="text-center sm:text-left text-black sm:text-yellow-600 font-bold uppercase text-xs sm:text-sm tracking-wider">ACT NOW! OFFER EXPIRES IN:</p>
                    <div class="flex justify-center sm:justify-start space-x-2 mt-2" id="countdown-timer" data-expires="{{ $deal->expires_at->format('Y-m-d H:i:s') }}">
                        <div class="sm:bg-gray-100 rounded-none sm:rounded-lg p-1 sm:p-2 text-center w-12 sm:w-16 sm:shadow-sm">
                            <span class="block text-lg sm:text-xl font-bold text-gray-800" id="days">00</span>
                            <span class="block text-xs text-gray-600">Days</span>
                        </div>
                        <div class="sm:bg-gray-100 rounded-none sm:rounded-lg p-1 sm:p-2 text-center w-12 sm:w-16 sm:shadow-sm">
                            <span class="block text-lg sm:text-xl font-bold text-gray-800" id="hours">00</span>
                            <span class="block text-xs text-gray-600">Hours</span>
                        </div>
                        <div class="sm:bg-gray-100 rounded-none sm:rounded-lg p-1 sm:p-2 text-center w-12 sm:w-16 sm:shadow-sm">
                            <span class="block text-lg sm:text-xl font-bold text-gray-800" id="minutes">00</span>
                            <span class="block text-xs text-gray-600">Minutes</span>
                        </div>
                        <div class="sm:bg-gray-100 rounded-none sm:rounded-lg p-1 sm:p-2 text-center w-12 sm:w-16 sm:shadow-sm">
                            <span class="block text-lg sm:text-xl font-bold text-gray-800" id="seconds">00</span>
                            <span class="block text-xs text-gray-600">Seconds</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Desktop/Tablet Right Image (hidden on mobile) -->
        <div class="hidden md:block md:w-2/2 relative min-h-[200px] sm:min-h-[250px] md:min-h-[300px]">
            @if($deal->image)
                <img 
                    src="{{ asset('storage/' . $deal->image) }}"
                    alt="{{ $deal->title }}" class="w-full h-full object-cover absolute">
            @else
                <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-md flex items-center justify-center">
                    <i class="fas fa-image text-gray-400"></i>
                </div>
            @endif
            <div class="ml-4">
                <div class="text-sm font-medium text-gray-900">{{ $deal->title }}</div>
                <div class="text-sm text-gray-500">{{ $deal->subtitle }}</div>
            </div>
            <!-- Torn Edge Overlay - Only for larger screens -->
            <div class="absolute inset-y-0 left-0 md:-left-5 hidden md:block" style="z-index: 10; overflow: hidden;">
                <!-- Different sizes for different screens -->
                <div class="hidden md:block lg:hidden" style="width: 100%; height: 100%;">
                    <img src="{{ asset('images/torn-edge.png') }}" alt="Torn Edge Effect" class="h-full object-cover object-right" style="width: auto; max-width: none;">
                </div>
                <div class="hidden lg:block xl:hidden" style=" height: 100%;">
                    <img src="{{ asset('images/torn-edge.png') }}" alt="Torn Edge Effect" class="h-full object-cover object-right" style="width: auto; max-width: none;">
                </div>
                <div class="hidden xl:block" style=" height: 100%;">
                    <img src="{{ asset('images/torn-edge.png') }}" alt="Torn Edge Effect" class="h-full object-cover object-right" style="width: auto; max-width: none;">
                </div>
            </div>
            
            <!-- Price Tag with Pop Effect - Desktop/Tablet Only -->
            <div class="absolute top-4 right-4 bg-yellow-400 text-gray-800 font-bold px-5 py-3 rounded-full transform rotate-6 shadow-lg border-2 border-yellow-500">
                <div class="text-xs uppercase">Special Price</div>
                <div class="text-xl md:text-lg">Only ${{ $deal->discount_price ?: $deal->price }}</div>
            </div>
            
            <!-- Bottom Content Badge - Desktop/Tablet Only -->
            <div class="absolute bottom-4 right-4 bg-white bg-opacity-90 px-4 py-2 rounded-lg shadow-md">
                <p class="text-blue-600 font-semibold text-sm">18+ Destinations Available</p>
            </div>
        </div>
    </div>
</section>

<!-- Dynamic countdown script -->
@if($deal->expires_at)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const countdownTimer = document.getElementById('countdown-timer');
        const expiresDate = new Date(countdownTimer.dataset.expires).getTime();
        
        function updateCountdown() {
            // Get current date and time
            const now = new Date().getTime();
            
            // Calculate time remaining
            const distance = expiresDate - now;
            
            // If countdown is finished
            if (distance < 0) {
                document.getElementById("days").innerHTML = "00";
                document.getElementById("hours").innerHTML = "00";
                document.getElementById("minutes").innerHTML = "00";
                document.getElementById("seconds").innerHTML = "00";
                document.getElementById("countdown-timer").innerHTML = "<p class='text-blue-600 font-bold'>OFFER EXPIRED</p>";
                clearInterval(timer);
                return;
            }
            
            // Calculate days, hours, minutes, seconds
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            // Display the result
            document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
            document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
            document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
            document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');
        }
        
        // Update the countdown every second
        updateCountdown(); // Run once immediately
        const timer = setInterval(updateCountdown, 1000);
    });
</script>
@endif
@endif