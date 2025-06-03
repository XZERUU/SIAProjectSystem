@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-8">

    {{-- Header --}}
    <div class="text-center">
        <h1 class="text-4xl font-bold text-gray-900 dark:text-white">Admin Dashboard</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">Overview of the ecosystem statistics</p>
    </div>

    {{-- Stats Section --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

        {{-- Total Plants --}}
        <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
            <h2 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-1">Total Plants</h2>
            <p class="text-4xl font-bold text-green-600 dark:text-green-400">{{ $totalPlants }}</p>
            <a href="{{ route('plants.index') }}" class="mt-3 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                View Details
            </a>
        </div>

        {{-- Total Sensors --}}
        <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
            <h2 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-1">Total Sensors</h2>
            <p class="text-4xl font-bold text-blue-600 dark:text-blue-400">{{ $totalSensors }}</p>
            <a href="{{ route('sensors.globalIndex') }}" class="mt-3 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                View Details
            </a>
        </div>

        {{-- Total Transactions --}}
        <div x-data="{ open: false }" class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
            <h2 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-1">Total Transactions</h2>
            <p class="text-4xl font-bold text-red-600 dark:text-red-400">{{ $totalTransactions }}</p>
            <a href="{{ route('transactions.globalIndex') }}" class="mt-3 inline-block text-sm text-blue-600 dark:text-blue-400 hover:underline">
                View Details
            </a>
        </div>

    </div>
</div>
@endsection
