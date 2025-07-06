@extends('layouts.admin')

@section('title', 'Manage Custom Bundle Destinations')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manage Custom Bundle Destinations</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.destinations.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i> Add New Destination
            </a>
            <a href="{{ route('admin.custom-bundles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-arrow-left mr-2"></i> Back to Bundle Types
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <form action="{{ route('admin.custom-bundles.update-destinations') }}" method="POST">
            @csrf
            
            <div class="p-6">
                <p class="text-gray-700 mb-4">
                    Configure which destinations are available for custom bundles and specify whether they are domestic or international.
                </p>
                
                <!-- Filter Controls -->
                <div class="mb-6 flex flex-wrap gap-4 items-center">
                    <div class="relative">
                        <input type="text" id="filter-name" placeholder="Filter by name" 
                            class="w-full md:w-64 rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 pl-10">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                    
                    <select id="filter-type" class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">All Types</option>
                        <option value="domestic">Domestic</option>
                        <option value="international">International</option>
                    </select>
                    
                    <select id="filter-display" class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <option value="">All Display Status</option>
                        <option value="1">Displayed in Custom Bundles</option>
                        <option value="0">Hidden from Custom Bundles</option>
                    </select>
                    
                    <button type="button" id="clear-filters" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-times-circle mr-1"></i> Clear Filters
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <input type="checkbox" id="select-all" 
                                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2">Display</span>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Image
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <div class="flex items-center">
                                        <span>Destination</span>
                                        <button type="button" id="sort-name" class="ml-1 text-gray-400 hover:text-gray-700">
                                            <i class="fas fa-sort"></i>
                                        </button>
                                    </div>
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Type
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="destinations-table-body">
                            @forelse($destinations as $destination)
                            <tr class="destination-row" 
                                data-name="{{ strtolower($destination->name) }}" 
                                data-type="{{ $destination->destination_type ?? 'domestic' }}" 
                                data-display="{{ $destination->display_in_custom_bundles ? '1' : '0' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="hidden" name="destinations[{{ $loop->index }}][id]" value="{{ $destination->id }}">
                                    <input type="checkbox" name="destinations[{{ $loop->index }}][display_in_custom_bundles]" value="1"
                                        {{ $destination->display_in_custom_bundles ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 display-checkbox">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="h-12 w-16 rounded overflow-hidden bg-gray-100">
                                        @if($destination->main_image)
                                            <img src="{{ filter_var($destination->main_image, FILTER_VALIDATE_URL) ? $destination->main_image : asset($destination->main_image) }}" 
                                                alt="{{ $destination->name }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center bg-gray-200 text-gray-500">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $destination->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $destination->location }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select name="destinations[{{ $loop->index }}][destination_type]" 
                                        class="rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 destination-type-select">
                                        <option value="domestic" {{ ($destination->destination_type ?? 'domestic') == 'domestic' ? 'selected' : '' }}>Domestic</option>
                                        <option value="international" {{ ($destination->destination_type ?? 'domestic') == 'international' ? 'selected' : '' }}>International</option>
                                    </select>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    No destinations found. <a href="{{ route('admin.destinations.create') }}" class="text-blue-600 hover:text-blue-900">Create one</a>.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Submit Button -->
            <div class="px-6 py-4 bg-gray-50 flex items-center justify-between">
                <div>
                    <button type="button" id="select-all-domestic" class="text-blue-600 hover:text-blue-800 mr-4">
                        <i class="fas fa-check-circle mr-1"></i> Select All Domestic
                    </button>
                    <button type="button" id="select-all-international" class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-check-circle mr-1"></i> Select All International
                    </button>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Filter functionality
        const filterName = document.getElementById('filter-name');
        const filterType = document.getElementById('filter-type');
        const filterDisplay = document.getElementById('filter-display');
        const clearFilters = document.getElementById('clear-filters');
        const rows = document.querySelectorAll('.destination-row');
        
        function applyFilters() {
            const nameFilter = filterName.value.toLowerCase();
            const typeFilter = filterType.value;
            const displayFilter = filterDisplay.value;
            
            rows.forEach(row => {
                const name = row.dataset.name;
                const type = row.dataset.type;
                const display = row.dataset.display;
                
                const nameMatch = name.includes(nameFilter);
                const typeMatch = !typeFilter || type === typeFilter;
                const displayMatch = !displayFilter || display === displayFilter;
                
                if (nameMatch && typeMatch && displayMatch) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            });
        }
        
        filterName.addEventListener('input', applyFilters);
        filterType.addEventListener('change', applyFilters);
        filterDisplay.addEventListener('change', applyFilters);
        
        clearFilters.addEventListener('click', function() {
            filterName.value = '';
            filterType.value = '';
            filterDisplay.value = '';
            rows.forEach(row => row.classList.remove('hidden'));
        });
        
        // Select all functionality
        const selectAll = document.getElementById('select-all');
        const displayCheckboxes = document.querySelectorAll('.display-checkbox');
        
        selectAll.addEventListener('change', function() {
            const isChecked = this.checked;
            displayCheckboxes.forEach(checkbox => {
                const row = checkbox.closest('tr');
                if (!row.classList.contains('hidden')) {
                    checkbox.checked = isChecked;
                }
            });
        });
        
        // Select all by type
        document.getElementById('select-all-domestic').addEventListener('click', function() {
            selectByType('domestic');
        });
        
        document.getElementById('select-all-international').addEventListener('click', function() {
            selectByType('international');
        });
        
        function selectByType(type) {
            rows.forEach(row => {
                if (row.dataset.type === type && !row.classList.contains('hidden')) {
                    const checkbox = row.querySelector('.display-checkbox');
                    checkbox.checked = true;
                }
            });
        }
        
        // Sort by name
        let sortAscending = true;
        document.getElementById('sort-name').addEventListener('click', function() {
            const tbody = document.getElementById('destinations-table-body');
            const rowsArray = Array.from(rows);
            
            rowsArray.sort((a, b) => {
                const nameA = a.dataset.name;
                const nameB = b.dataset.name;
                
                if (sortAscending) {
                    return nameA.localeCompare(nameB);
                } else {
                    return nameB.localeCompare(nameA);
                }
            });
            
            sortAscending = !sortAscending;
            this.innerHTML = `<i class="fas fa-sort-${sortAscending ? 'up' : 'down'}"></i>`;
            
            rowsArray.forEach(row => tbody.appendChild(row));
        });
        
        // Update data attributes when type changes
        document.querySelectorAll('.destination-type-select').forEach(select => {
            select.addEventListener('change', function() {
                const row = this.closest('tr');
                row.dataset.type = this.value;
            });
        });
    });
</script>
@endpush