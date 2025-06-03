@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">

    {{-- Header & Actions --}}
    <div class="flex justify-between items-center mb-6 flex-wrap gap-3">
        <h1 class="text-3xl font-bold text-white">Sensor List</h1>

        <div class="flex gap-3 ml-auto">
            {{-- PDF Button --}}
            <a href="{{ route('sensors.pdf') }}" 
               class="flex items-center bg-white text-yellow-600 border border-yellow-500 hover:bg-yellow-500 hover:text-black px-4 py-2 rounded transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                PDF
            </a>

            {{-- Add Sensor --}}
            @if($plants->count())
                <a href="{{ route('plants.sensors.create', $plants->first()->id) }}" 
                   class="flex items-center bg-white bg-yellow-500 hover:bg-yellow-600 text-black px-4 py-2 rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Sensor
                </a>
            @endif
        </div>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('sensors.globalIndex') }}" class="mb-6 flex flex-wrap justify-center sm:justify-start items-center gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." 
               class="px-4 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring focus:ring-yellow-500" />

        <select name="field" class="px-4 py-2 border border-gray-300 rounded shadow-sm focus:outline-none focus:ring focus:ring-yellow-500">
            <option value="custom_id" {{ request('field') == 'custom_id' ? 'selected' : '' }}>Custom ID</option>
            <option value="plant_name" {{ request('field') == 'plant_name' ? 'selected' : '' }}>Plant Name</option>
            <option value="sensor_type" {{ request('field') == 'sensor_type' ? 'selected' : '' }}>Sensor Type</option>
            <option value="temperature" {{ request('field') == 'temperature' ? 'selected' : '' }}>Temperature</option>
            <option value="water_level" {{ request('field') == 'water_level' ? 'selected' : '' }}>Water Level</option>
        </select>

        <button type="submit" class="bg-yellow-500 text-black px-4 py-2 rounded hover:bg-yellow-600 transition">
            Search
        </button>
    </form>

    {{-- Table --}}
    <div class="flex justify-center w-100%">
        <div class="overflow-x-auto bg-white rounded-lg shadow-md w-full max-w-5xl ">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium">Custom ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Plant Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Sensor Type</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Temperature</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Water Level</th>
                        <th class="px-6 py-3 text-left text-sm font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-200">
                    @forelse ($sensors as $sensor)
                        <tr class="hover:bg-gray-100">
                            <td class="px-6 py-4">{{ $sensor->custom_id ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $sensor->plant->plant_name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $sensor->sensor_type }}</td>
                            <td class="px-6 py-4">{{ $sensor->temperature }}</td>
                            <td class="px-6 py-4">{{ $sensor->water_level }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('plants.sensors.edit', [$sensor->plant_id, $sensor->id]) }}" 
                                   class="bg-gray-300 px-3 py-1 rounded hover:bg-gray-400">Edit</a>
                                <form action="{{ route('plants.sensors.destroy', [$sensor->plant_id, $sensor->id]) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this sensor?')" 
                                            class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-gray-500">No sensors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-6">
        {{ $sensors->appends(request()->query())->links() }}
    </div>
</div>
@endsection
