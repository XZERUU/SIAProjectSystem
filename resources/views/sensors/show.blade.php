@extends('layouts.app')

@section('title', "Sensor #{$sensor->id} Details")

@section('content')
  <h1 class="text-2xl font-semibold mb-4">
    Sensor #{{ $sensor->id }} ({{ $sensor->sensor_type }})
  </h1>

  <p><strong>Plant:</strong> {{ $plant->plant_name }}</p>
  <p><strong>Temperature:</strong> {{ number_format($sensor->temperature, 2) }} °C</p>
  <p><strong>Water Level:</strong> {{ number_format($sensor->water_level, 2) }}</p>
  <p><strong>Created At:</strong> {{ $sensor->created_at->format('Y-m-d H:i:s') }}</p>

  <a href="{{ route('plants.sensors.index', $plant) }}"
     class="mt-4 inline-block text-blue-600">
    ← Back to Sensors
  </a>
@endsection
