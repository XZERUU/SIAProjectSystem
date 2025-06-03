@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-black rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6 text-white">
        {{ isset($transaction) ? "Edit Transaction #{$transaction->id}" : "Add New Transaction" }}
    </h2>

    @if ($errors->any())
    <div class="bg-red-600 text-white p-4 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ isset($transaction) ? route('sensors.transactions.update', [$sensor, $transaction]) : route('sensors.transactions.store', $sensor) }}">
        @csrf
        @if(isset($transaction))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- Logged At -->
            <div>
                <label for="logged_at" class="block text-sm font-medium text-white">Logged At</label>
                <input
                    type="datetime-local"
                    name="logged_at"
                    id="logged_at"
                    required
                    value="{{ old('logged_at', isset($transaction) ? $transaction->logged_at->format('Y-m-d\TH:i') : '') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-white">Status</label>
                <input
                    type="text"
                    name="status"
                    id="status"
                    required
                    value="{{ old('status', $transaction->status ?? '') }}"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                >
            </div>

            <!-- Sensor ID (readonly) -->
            <div>
                <label class="block text-sm font-medium text-white">Sensor ID</label>
                <input
                    type="text"
                    value="{{ $sensor->id }}"
                    readonly
                    class="mt-1 block w-full bg-gray-800 border-gray-600 text-gray-200 rounded-md shadow-sm cursor-not-allowed"
                >
            </div>

            <!-- Sensor Type (readonly) -->
            <div>
                <label class="block text-sm font-medium text-white">Sensor Type</label>
                <input
                    type="text"
                    value="{{ $sensor->sensor_type }}"
                    readonly
                    class="mt-1 block w-full bg-gray-800 border-gray-600 text-gray-200 rounded-md shadow-sm cursor-not-allowed"
                >
            </div>

        </div>

        <!-- Buttons -->
        <div class="mt-6 flex justify-start gap-3">
            <button type="submit"
                    class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Save Transaction
            </button>
            <a href="{{ route('sensors.transactions.index', $sensor) }}"
               class="inline-flex items-center px-5 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
