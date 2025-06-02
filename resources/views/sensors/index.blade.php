@extends('layouts.app')

@section('title', "Sensors for \"{$plant->plant_name}\"")

@section('content')
  <h1 class="text-2xl font-semibold mb-4">
    Sensors for: {{ $plant->plant_name }}
  </h1>

  <a href="{{ route('plants.sensors.create', $plant) }}"
     class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
    + Add Sensor
  </a>

  <table class="min-w-full bg-white rounded shadow overflow-x-auto">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Type</th>
        <th class="px-4 py-2">Temp (°C)</th>
        <th class="px-4 py-2">Water Level</th>
        <th class="px-4 py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($sensors as $sensor)
        <tr>
          <td class="border px-4 py-2">{{ $sensor->id }}</td>
          <td class="border px-4 py-2">{{ $sensor->sensor_type }}</td>
          <td class="border px-4 py-2">{{ number_format($sensor->temperature, 2) }}</td>
          <td class="border px-4 py-2">{{ number_format($sensor->water_level, 2) }}</td>
          <td class="border px-4 py-2">
            <a href="{{ route('plants.sensors.show', [$plant, $sensor]) }}"
               class="text-blue-600">View</a>
            <a href="{{ route('plants.sensors.edit', [$plant, $sensor]) }}"
               class="text-green-600 ml-2">Edit</a>
            <form method="POST"
                  action="{{ route('plants.sensors.destroy', [$plant, $sensor]) }}"
                  class="inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 ml-2">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="text-center py-4">No sensors found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-4">
    {{ $sensors->links() }}
  </div>
@endsection
