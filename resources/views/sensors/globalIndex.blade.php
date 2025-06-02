@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-white">All Sensors</h1>
            <div class="flex space-x-3">
                <a href="{{ route('plants.index') }}"
                   class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition duration-200">
                    Back to Plants
                </a>
                <a href="{{ route('plants.sensors.create', ['plant' => request('plant') ?: 0]) }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5 mr-1"
                         viewBox="0 0 20 20"
                         fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 
                                 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                              clip-rule="evenodd" />
                    </svg>
                    Add Sensor
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-600 text-white px-6 py-4 rounded-lg shadow-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="w-full table-auto border-separate border-spacing-y-2">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Sensor Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Temperature (°C)</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Water Level</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Plant Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($sensors as $sensor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $sensor->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $sensor->sensor_type }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ number_format($sensor->temperature, 2) }}°C</td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ number_format($sensor->water_level, 2) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ $sensor->plant->plant_name ?? '—' }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <div class="flex space-x-2">
                                    <a href="{{ route('plants.sensors.show', [$sensor->plant, $sensor]) }}"
                                       class="block bg-green-600 hover:bg-green-700 text-black font-semibold px-4 py-1 rounded shadow">
                                        View
                                    </a>
                                    <a href="{{ route('plants.sensors.edit', [$sensor->plant, $sensor]) }}"
                                       class="block bg-yellow-600 hover:bg-yellow-700 text-black font-semibold px-4 py-1 rounded shadow">
                                        Edit
                                    </a>
                                    <form action="{{ route('plants.sensors.destroy', [$sensor->plant, $sensor]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this sensor?');">
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
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500 bg-gray-50">
                                <div class="flex justify-center items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-5 w-5 text-gray-400"
                                         viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 
                                                 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 
                                                 0 012 0zm-7.536 5.879a1 1 0 001.415 0 3 
                                                 3 0 014.242 0 1 1 0 001.415-1.415 5 5 
                                                 0 00-7.072 0 1 1 0 000 1.415z"
                                              clip-rule="evenodd" />
                                    </svg>
                                    <span>No sensors found</span>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination links -->
        <div class="mt-6">
            {{ $sensors->links() }}
        </div>
    </div>
@endsection
