@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-black rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-white">
        {{ isset($plant) ? 'Edit Plant Record' : 'Add New Plant' }}
    </h2>

    <form method="POST" action="{{ isset($plant) ? route('plants.update', $plant->id) : route('plants.store') }}">
        @csrf
        @if(isset($plant))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Custom ID -->
            <div>
                <label for="custom_id" class="block text-sm font-medium text-white">Custom ID</label>
                <input type="text" name="custom_id" id="custom_id" required
                       value="{{ old('custom_id', $plant->custom_id ?? '') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-white">Name</label>
                <input type="text" name="name" id="name" required
                       value="{{ old('name', $plant->name ?? '') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Plant Name -->
            <div>
                <label for="plant_name" class="block text-sm font-medium text-white">Plant Name</label>
                <input type="text" name="plant_name" id="plant_name" required
                       value="{{ old('plant_name', $plant->plant_name ?? '') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Growth Stage -->
            <div>
                <label for="growth_stage" class="block text-sm font-medium text-white">Growth Stage</label>
                <select name="growth_stage" id="growth_stage" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Stage</option>
                    @foreach($growthStages as $stage)
                        <option value="{{ $stage }}"
                            {{ old('growth_stage', $plant->growth_stage ?? '') == $stage ? 'selected' : '' }}>
                            {{ $stage }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Planting Date -->
            <div>
                <label for="planting_date" class="block text-sm font-medium text-white">Planting Date</label>
                <input type="date" name="planting_date" id="planting_date" required
                       value="{{ old('planting_date', isset($plant) ? $plant->planting_date->format('Y-m-d') : '') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Temperature -->
            <div>
                <label for="temperature" class="block text-sm font-medium text-white">Temperature (°C)</label>
                <input type="number" name="temperature" id="temperature" step="0.1"
                       value="{{ old('temperature', $plant->temperature ?? '') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <!-- Buttons -->
        <div class="mt-6 flex justify-start gap-3">
            <button type="submit"
                    class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Save
            </button>
            <a href="{{ route('plants.index') }}"
               class="inline-flex items-center px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
