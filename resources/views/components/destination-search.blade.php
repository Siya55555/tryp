<div class="search-bar p-6 rounded-2xl shadow-2xl">
    <form action="{{ route('destinations.search') }}" method="GET">
        <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
            <div class="flex-1">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-map-marker-alt text-blue-600"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Where would you like to go?" 
                        class="w-full pl-10 pr-4 py-4 border-0 rounded-xl focus:ring-2 focus:ring-blue-500 shadow-inner bg-white"
                        autocomplete="off"
                        id="destination-search"
                    >
                    <div id="search-results" class="absolute z-50 w-full bg-white mt-1 rounded-xl shadow-lg hidden max-h-60 overflow-y-auto"></div>
                </div>
            </div>
            
            <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-8 py-4 rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-800 transition-all shadow-lg">
                <i class="fas fa-search mr-2"></i> Search
            </button>
        </div>
    </form>
    
    <div class="flex flex-wrap justify-center mt-6 gap-4 text-gray-700">
        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow">
            <i class="fas fa-calendar-check mr-2 text-blue-600"></i>
            <span>No Blackout Dates</span>
        </div>
        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow">
            <i class="fas fa-clock mr-2 text-blue-600"></i>
            <span>18 Months To Book</span>
        </div>
        <div class="flex items-center bg-white px-4 py-2 rounded-full shadow">
            <i class="fas fa-tag mr-2 text-blue-600"></i>
            <span>Price Guaranteed</span>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('destination-search');
        const searchResults = document.getElementById('search-results');
        
        let typingTimer;
        const doneTypingInterval = 300; // ms
        
        // On keyup, start the countdown
        searchInput.addEventListener('keyup', function() {
            clearTimeout(typingTimer);
            if (searchInput.value) {
                typingTimer = setTimeout(fetchResults, doneTypingInterval);
            } else {
                searchResults.innerHTML = '';
                searchResults.classList.add('hidden');
            }
        });
        
        // Function to fetch results
        function fetchResults() {
            const query = searchInput.value;
            
            if (query.length < 2) return;
            
            fetch(`/api/destinations/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    
                    if (data.length > 0) {
                        searchResults.classList.remove('hidden');
                        
                        data.forEach(destination => {
                            const div = document.createElement('div');
                            div.className = 'p-3 hover:bg-blue-50 cursor-pointer flex items-center';
                            div.innerHTML = `
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-gray-200 mr-3 flex-shrink-0">
                                    <img src="${destination.main_image}" alt="${destination.name}" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800">${destination.name}</div>
                                    <div class="text-sm text-gray-500">${destination.location}</div>
                                </div>
                            `;
                            
                            div.addEventListener('click', function() {
                                window.location.href = `/destinations/${destination.id}`;
                            });
                            
                            searchResults.appendChild(div);
                        });
                    } else {
                        searchResults.classList.remove('hidden');
                        const div = document.createElement('div');
                        div.className = 'p-3 text-gray-500';
                        div.textContent = 'No destinations found for "' + query + '"';
                        searchResults.appendChild(div);
                    }
                })
                .catch(error => {
                    console.error('Error fetching results:', error);
                });
        }
        
        // Hide results when clicking outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.classList.add('hidden');
            }
        });
    });
</script>
@endpush