<section class="py-16 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">        <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center" style="color: {{ setting('primary_button_color', '#2563eb') }}">
            <span class="relative inline-block">
                Why Choose {{ setting('company_name', 'MyTravel') }}?
                <span class="absolute bottom-0 left-0 w-full h-1 bg-yellow-400"></span>
            </span>
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($whyChooseUs as $feature)
                <div class="bg-gray-50 p-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300">  
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center text-white" style="background-color: {{ setting('primary_button_color', '#2563eb') }}">
                        <i class="{{ $feature->icon }} text-xl"></i>
                    </div>                 
                    <h3 class="text-lg font-bold mb-3 text-center" style="color: {{ setting('primary_button_color', '#2563eb') }}">{{ $feature->title }}</h3>
                    <p class="text-gray-600 text-center text-sm">{{ $feature->description }}</p>
                </div>
            @empty                <!-- Fallback content if no features are defined -->             
            
            
                <div class="bg-gray-50 p-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center text-white" style="background-color: {{ setting('primary_button_color', '#2563eb') }}">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-center" style="color: {{ setting('primary_button_color', '#2563eb') }}">Trusted Vacations</h3>
                    <p class="text-gray-600 text-center text-sm">A-rated by the Better Business Bureau with a 4.8-star Google rating.</p>
                </div>                <div class="bg-gray-50 p-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center text-white" style="background-color: {{ setting('primary_button_color', '#2563eb') }}">
                        <i class="fas fa-globe text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-center" style="color: {{ setting('primary_button_color', '#2563eb') }}">Diverse Destinations</h3>
                    <p class="text-gray-600 text-center text-sm">Over 50 top destinations across the U.S., Caribbean, Mexico, and beyond.</p>
                </div>                <div class="bg-gray-50 p-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center text-white" style="background-color: {{ setting('primary_button_color', '#2563eb') }}">
                        <i class="fas fa-flag-usa text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-center" style="color: {{ setting('primary_button_color', '#2563eb') }}">U.S.-Based Support</h3>
                    <p class="text-gray-600 text-center text-sm">Our dedicated team is here to assist you 24/7.</p>
                </div><div class="bg-gray-50 p-6 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300">
                    <div class="w-12 h-12 mx-auto mb-4 rounded-full flex items-center justify-center text-white" style="background-color: {{ setting('primary_button_color', '#2563eb') }}">
                        <i class="fas fa-dollar-sign text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-3 text-center" style="color: {{ setting('primary_button_color', '#2563eb') }}">Affordable Quality</h3>
                    <p class="text-gray-600 text-center text-sm">Premium accommodations at budget-friendly prices.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>