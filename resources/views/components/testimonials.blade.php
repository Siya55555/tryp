    <!-- Testimonials -->
    <section class="py-16 bg-gradient-to-r from-blue-50 to-indigo-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-blue-600 mb-12 text-center">
                <span class="relative inline-block">
                    SEE WHY GUESTS SAY THEY LOVE US!
                    <span class="absolute bottom-0 left-0 w-full h-1 bg-yellow-400"></span>
                </span>
            </h2>
            
            <div class="bg-white rounded-3xl shadow-xl p-8">
                <div class="mb-8 text-center">
                    <div class="inline-flex items-center bg-yellow-100 px-4 py-2 rounded-full mb-2">
                    <i class="fas fa-star text-yellow-500 mr-2"></i>
                    <span class="font-medium">
                        {{ number_format($testimonials->avg('rating'), 1) }} out of 5 based on {{ $testimonials->count() }} reviews
                    </span>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($testimonials as $testimonial)
                <div class="testimonial-card bg-gradient-to-br from-white to-blue-50 p-6 rounded-2xl shadow-lg">
                    <div class="flex text-yellow-400 mb-4">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'text-gray-300' }}"></i>
                        @endfor
                    </div>
                    
                    <p class="text-gray-600 mb-4">
                        {{ $testimonial->description }}
                    </p>
                    
                    <div class="flex items-center mt-6">
                        @if($testimonial->image)
                           
                                 <img class="w-12 h-12 rounded-full object-cover mr-3" src="{{ filter_var($testimonial->image, FILTER_VALIDATE_URL) ? $testimonial->image : asset($testimonial->image) }}" alt="{{ $testimonial->name }}">

                        @else
                            <div class="w-12 h-12 bg-blue-500 rounded-full mr-3 flex items-center justify-center text-white font-medium">
                                {{ substr($testimonial->name, 0, 2) }}
                            </div>
                        @endif
                        
                        <div>
                            <div class="font-medium">{{ $testimonial->name }}</div>
                            @if($testimonial->location)
                                <div class="text-xs text-gray-500">{{ $testimonial->location }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
                
                @if($testimonials->count() > 8)
            <div class="text-center mt-10">
                <button class="px-8 py-3 bg-blue-100 text-blue-700 rounded-full font-medium hover:bg-blue-200 transition-colors">
                    <i class="fas fa-plus-circle mr-2"></i> Load More Reviews
                </button>
            </div>
            @endif
            </div>
        </div>
    </section>