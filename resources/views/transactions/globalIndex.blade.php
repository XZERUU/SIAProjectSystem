@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10 space-y-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-white">All Transactions</h1>
        <div class="flex space-x-3">
            <a href="{{ route('transactions.exportPDF') }}"
               class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition duration-200">
                Download PDF
            </a>
            <a href="{{ route('sensors.transactions.create', ['sensor' => request('sensor') ?? $firstSensorId]) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create +
            </a>
        </div>
    </div>

    <form method="GET" action="{{ route('transactions.globalIndex') }}" class="flex flex-wrap items-center gap-4 mb-6">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search status or sensor ID..." 
               class="px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500 flex-grow min-w-[200px]" />

        <select name="sensor" onchange="this.form.submit()" class="px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Sensors</option>
            @foreach($sensors as $sensorOption)
                <option value="{{ $sensorOption->id }}" {{ request('sensor') == $sensorOption->id ? 'selected' : '' }}>
                    {{ $sensorOption->sensor_type }} (ID: {{ $sensorOption->id }})
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
            Search
        </button>
    </form>

    <div class="overflow-x-auto bg-white rounded-lg shadow-md">
        <table class="w-full table-auto border-separate border-spacing-y-2">
            <thead>
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Sensor ID</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Sensor Type</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Logged At</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($transactions as $transaction)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $transaction->id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $transaction->sensor_id }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $transaction->sensor->sensor_type ?? 'N/A' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $transaction->status }}</td>
                        <td class="px-6 py-4 text-sm text-gray-800">{{ $transaction->logged_at->format('Y-m-d H:i') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <div class="flex space-x-2">
                                <a href="{{ route('sensors.transactions.show', [$transaction->sensor, $transaction]) }}"
                                   class="block bg-green-600 hover:bg-green-700 text-black font-semibold px-4 py-1 rounded shadow">
                                    View
                                </a>
                                <a href="{{ route('sensors.transactions.edit', [$transaction->sensor, $transaction]) }}"
                                   class="block bg-yellow-600 hover:bg-yellow-700 text-black font-semibold px-4 py-1 rounded shadow">
                                    Edit
                                </a>
                                <form action="{{ route('sensors.transactions.destroy', [$transaction->sensor, $transaction]) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this transaction?');">
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 100-2 1 1 0 000 2zm7-1a1 1 0 11-2 0 1 1 0 012 0zm-7.536 5.879a1 1 0 001.415 0 3 3 0 014.242 0 1 1 0 001.415-1.415 5 5 0 00-7.072 0 1 1 0 000 1.415z" clip-rule="evenodd" />
                                </svg>
                                <span>No transactions found</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $transactions->links() }}
    </div>
</div>
@endsection
