@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">Plant List</h1>
            <div class="flex space-x-3">
                <a href="{{ route('plants.exportPDF') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200">
                    Download PDF
                </a>
                <a href="{{ route('plants.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Add Plant
                </a>
            </div>
        </div>

        <!-- 🔍 Search with Filter Dropdown -->
        <form action="{{ route('plants.index') }}" method="GET" class="mb-6 flex flex-wrap gap-3 items-center">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="form-input rounded px-4 py-2 border border-gray-300 shadow-sm w-1/3">

            <select name="field" class="form-select rounded px-4 py-2 border border-gray-300 shadow-sm">
                <option value="plant_id" {{ request('field') == 'custom_id' ? 'selected' : '' }}>Custom ID</option>
                <option value="plant_name" {{ request('field') == 'name' ? 'selected' : '' }}>Name</option>
                <option value="Location" {{ request('field') == 'plant_name' ? 'selected' : '' }}>Plant Name</option>
                <option value="growth_stage" {{ request('field') == 'growth_stage' ? 'selected' : '' }}>Growth Stage</option>
                <option value="planting_date" {{ request('field') == 'planting_date' ? 'selected' : '' }}>Planting Date</option>
            </select>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Search</button>
        </form>

        @if (session('success'))
            <div class="bg-green-600 text-white px-6 py-4 rounded-lg shadow-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="w-full table-auto border-separate border-spacing-y-2">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Custom ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Plant Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Growth Stage</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Planting Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Temperature (°C)</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($plants as $plant)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $plant->custom_id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $plant->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $plant->plant_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $plant->growth_stage }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $plant->planting_date->format('Y-m-d') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $plant->temperature }}°C</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex space-x-2">
                                <!-- ✅ Edit Button (Green) -->
                                <a href="{{ route('plants.edit', $plant->id) }}"
                                   class="block bg-green-600 hover:bg-green-700 text-black font-semibold px-4 py-1 rounded shadow">
                                    Edit
                                </a>
                        
                                <!-- ❌ Delete Button (Red) -->
                                <form action="{{ route('plants.destroy', $plant->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this plant?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="block bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-1 rounded shadow">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                       
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-6 text-center text-gray-500 bg-gray-50">
                            <div class="flex justify-center items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-7.536 5.879a1 1 0 001.415 0 3 3 0 014.242 0 1 1 0 001.415-1.415 5 5 0 00-7.072 0 1 1 0 000 1.415z" clip-rule="evenodd" />
                                </svg>
                                <span>No plants found</span>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination links -->
        <div class="mt-6">
            {{ $plants->links() }}
        </div>
    </div>
@endsection
