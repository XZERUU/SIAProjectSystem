@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10 bg-gray-900 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-white mb-6">Add New Sensor for <span class="text-blue-300">{{ $plant->name }}</span></h2>

    @if ($errors->any())
        <div class="bg-red-600 text-white p-4 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('plants.sensors.store', ['plant' => $plant->id]) }}" class="space-y-6">
        @csrf

        <!-- Custom ID -->
        <div>
            <label for="custom_id" class="block text-sm font-medium text-white">Custom ID</label>
            <input type="text" name="custom_id" id="custom_id" value="{{ old('custom_id') }}"
                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-600 text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- Sensor Type -->
        <div>
            <label for="sensor_type" class="block text-sm font-medium text-white">Sensor Type</label>
            <input type="text" name="sensor_type" id="sensor_type" required
                   value="{{ old('sensor_type') }}"
                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-600 text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- Temperature -->
        <div>
            <label for="temperature" class="block text-sm font-medium text-white">Temperature (°C)</label>
            <input type="number" step="0.1" name="temperature" id="temperature" required
                   value="{{ old('temperature') }}"
                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-600 text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- Water Level -->
        <div>
            <label for="water_level" class="block text-sm font-medium text-white">Water Level (L)</label>
            <input type="number" step="0.1" name="water_level" id="water_level" required
                   value="{{ old('water_level') }}"
                   class="mt-1 block w-full rounded-md bg-gray-800 border-gray-600 text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" />
        </div>

        <!-- Submit and Cancel -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('plants.sensors.index', ['plant' => $plant->id]) }}"
               class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded">
                Cancel
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
                Save Sensor
            </button>
        </div>
    </form>
</div>
@endsection
