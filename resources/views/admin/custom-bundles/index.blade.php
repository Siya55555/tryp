@extends('layouts.admin')

@section('title', 'Custom Bundle Types')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Custom Bundle Types</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.custom-bundles.manage-destinations') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-map-marker-alt mr-2"></i> Manage Destinations
            </a>
            <a href="{{ route('admin.custom-bundles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                <i class="fas fa-plus mr-2"></i> Add New Bundle Type
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Price
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Status
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Features
                    </th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($bundleTypes as $bundleType)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $bundleType->name }}</div>
                        <div class="text-sm text-gray-500">{{ $bundleType->slug }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">${{ number_format($bundleType->price, 2) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $bundleType->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $bundleType->active ? 'Active' : 'Inactive' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-900">
                            @if(is_array($bundleType->features) && count($bundleType->features) > 0)
                                <ul class="list-disc pl-5">
                                    @foreach(array_slice($bundleType->features, 0, 2) as $feature)
                                        <li>{{ $feature }}</li>
                                    @endforeach
                                    @if(count($bundleType->features) > 2)
                                        <li>+{{ count($bundleType->features) - 2 }} more...</li>
                                    @endif
                                </ul>
                            @else
                                <span class="text-gray-500 italic">No features defined</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('admin.custom-bundles.edit', $bundleType) }}" class="text-blue-600 hover:text-blue-900">
    <i class="fas fa-edit"></i> Edit
</a>
                            <form action="{{ route('admin.custom-bundles.destroy', $bundleType->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this bundle type?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        No bundle types found. <a href="{{ route('admin.custom-bundles.create') }}" class="text-blue-600 hover:text-blue-900">Create one</a>.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection