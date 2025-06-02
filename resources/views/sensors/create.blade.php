{{-- resources/views/sensors/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-black rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-white">
        {{ isset($sensor) ? "Edit Sensor #{$sensor->id}" : "Add New Sensor for \"{$plant->plant_name}\"" }}
    </h2>

    <form
        method="POST"
        action="{{ isset($sensor)
            ? route('plants.sensors.update', [$plant, $sensor])
            : route('plants.sensors.store', $plant) }}"
    >
        @csrf
        @if(isset($sensor))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Sensor Type -->
            <div>
                <label for="sensor_type" class="block text-sm font-medium text-white">Sensor Type</label>
                <input
                    type="text"
                    name="sensor_type"
                    id="sensor_type"
                    required
                    value="{{ old('sensor_type', $sensor->sensor_type ?? '') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
                @error('sensor_type')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Temperature -->
            <div>
                <label for="temperature" class="block text-sm font-medium text-white">Temperature (°C)</label>
                <input
                    type="number"
                    name="temperature"
                    id="temperature"
                    step="0.1"
                    required
                    value="{{ old('temperature', $sensor->temperature ?? '') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
                @error('temperature')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Water Level -->
            <div>
                <label for="water_level" class="block text-sm font-medium text-white">Water Level</label>
                <input
                    type="number"
                    name="water_level"
                    id="water_level"
                    step="0.1"
                    required
                    value="{{ old('water_level', $sensor->water_level ?? '') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
                @error('water_level')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- (Optional) If you want to display Plant Name as read-only -->
            <div>
                <label class="block text-sm font-medium text-white">Plant</label>
                <input
                    type="text"
                    value="{{ $plant->plant_name }}"
                    readonly
                    class="mt-1 block w-full bg-gray-800 border-gray-600 text-gray-200 rounded-md shadow-sm cursor-not-allowed"
                >
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex justify-start gap-3">
            <button type="submit"
                    class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                Save Sensor
            </button>
            <a href="{{ route('plants.sensors.index', $plant) }}"
               class="inline-flex items-center px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
