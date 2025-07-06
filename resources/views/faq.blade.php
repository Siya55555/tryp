@extends('layouts.app')

@section('title', 'Frequently Asked Questions')

@section('content')

<section class="relative h-64 md:h-96 overflow-hidden">
        <!-- Background Image Slideshow -->
        <div class="slideshow-container absolute inset-0">
            <div class="slideshow-slide absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out">
                <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                    alt="Contact Us Hero 1" 
                    class="w-full h-full object-cover">
            </div>
            <div class="slideshow-slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                    alt="Contact Us Hero 2" 
                    class="w-full h-full object-cover">
            </div>
            <div class="slideshow-slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                <img src="https://images.unsplash.com/photo-1510414842594-a61c69b5ae57?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                    alt="Contact Us Hero 3" 
                    class="w-full h-full object-cover">
            </div>
            <!-- Semi-transparent gradient overlay instead of solid black -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-black/20 z-10"></div>
        </div>
        
        <!-- Hero Content -->
        <div class="container mx-auto px-4 h-full flex items-center justify-center relative z-20">
            <h1 class="text-4xl md:text-6xl font-bold text-white text-center drop-shadow-lg">Frequently Asked Questions</h1>
        </div>
    </section>


    <!-- FAQ Tabs Section -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4 max-w-5xl">
            <!-- Navigation Tabs -->
            <div class="flex flex-wrap mb-8 gap-2">
            <button id="all-faqs" class="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center hover:bg-blue-700 transition-colors">
                <i class="fas fa-list-ul mr-2"></i> All Questions
            </button>

            @foreach($faqCategories->keys() as $category)
                <button data-category="{{ Str::slug($category) }}" class="category-filter bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center hover:bg-blue-800 transition-colors">
                    {{ $category }}
                </button>
            @endforeach
            </div>

            <!-- FAQ Accordion -->
            <div class="space-y-4">
               
            @foreach($faqCategories as $category => $faqs)
                @foreach($faqs as $faq)
                    <div class="border border-gray-200 rounded-lg overflow-hidden faq-item" 
                         data-category="{{ Str::slug($category) }}">
                        <button class="w-full flex items-center justify-between p-4 bg-gray-50 hover:bg-gray-100 transition-colors">                            <span class="flex items-center text-left">
                                <i class="fas fa-question-circle text-blue-600 mr-3"></i>
                                <span class="font-medium">{{ $faq->question }}</span>
                            </span>
                            <i class="fas fa-chevron-down text-blue-600"></i>
                        </button>
                        <div class="p-4 bg-white" style="display: none; max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out;">
                            <p class="text-gray-700">{{ $faq->answer }}</p>
                        </div>
                    </div>
                @endforeach
            @endforeach
              
            </div>
                
        </div>
    </section>

    <x-vacations-booked-counter  />

@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const faqItems = document.querySelectorAll('.faq-item');
    const filterButtons = document.querySelectorAll('.category-filter');
    const allFaqsButton = document.getElementById('all-faqs');

    // Accordion functionality
    faqItems.forEach(item => {
        const button = item.querySelector('button');
        const content = item.querySelector('div.p-4');
        const icon = button.querySelector('.fas.fa-chevron-down');
        
        button.addEventListener('click', function() {
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                content.style.display = 'none';
                icon.classList.remove('transform', 'rotate-180');
            } else {
                content.style.display = 'block';
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.classList.add('transform', 'rotate-180');
            }
        });
    });

    // Category filtering
    function filterFAQs(category) {
        faqItems.forEach(item => {
            if (category === 'all' || item.dataset.category === category) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // All FAQs button
    allFaqsButton.addEventListener('click', () => filterFAQs('all'));

    // Category filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterFAQs(button.dataset.category);
        });
    });
});
</script>
@endpush