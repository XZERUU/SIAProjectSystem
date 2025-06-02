@extends('layouts.app')

@section('title', "Edit Sensor #{$sensor->id} for \"{$plant->plant_name}\"")

@section('content')
  <h1 class="text-2xl font-semibold mb-4">
    Edit Sensor #{{ $sensor->id }} for: {{ $plant->plant_name }}
  </h1>

  <form method="POST" action="{{ route('plants.sensors.update', [$plant, $sensor]) }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Sensor Type</label>
      <input type="text" name="sensor_type" value="{{ old('sensor_type', $sensor->sensor_type) }}"
             class="w-full border rounded px-3 py-2" required>
      @error('sensor_type')
        <p class="text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Temperature (°C)</label>
      <input type="number" name="temperature" step="0.01" 
             value="{{ old('temperature', $sensor->temperature) }}"
             class="w-full border rounded px-3 py-2" required>
      @error('temperature')
        <p class="text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Water Level</label>
      <input type="number" name="water_level" step="0.01" 
             value="{{ old('water_level', $sensor->water_level) }}"
             class="w-full border rounded px-3 py-2" required>
      @error('water_level')
        <p class="text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
      Update Sensor
    </button>
  </form>
@endsection
