@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10 space-y-12">

    {{-- Plants Table --}}
    <section>
       <h2 class="text-2xl font-semibold mb-4 text-gray-900">Plants</h2>
<div class="overflow-x-auto bg-white rounded-lg shadow-md">
    <table class="w-full table-fixed text-left text-sm divide-y divide-gray-200 text-gray-700">
        <thead class="bg-gray-100">
            <tr>
                <th class="w-1/6 px-4 py-3 font-semibold">Custom ID</th>
                <th class="w-2/6 px-4 py-3 font-semibold">Name</th>
                <th class="w-2/6 px-4 py-3 font-semibold">Growth Stage</th>
                <th class="w-1/6 px-4 py-3 font-semibold">Planting Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse ($plants as $plant)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $plant->custom_id ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $plant->name }}</td>
                    <td class="px-4 py-3">{{ $plant->growth_stage }}</td>
                    <td class="px-4 py-3">{{ optional($plant->planting_date)->format('Y-m-d') ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">No plants found.</td>
                </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $plants->links() }}
        </div>
    </section>

    {{-- Sensors Table --}}
    <section>
        <h2 class="text-2xl font-semibold mb-4 text-gray-900">Sensors</h2>
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200 text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Custom ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Plant Name</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Sensor Type</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Temperature</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Water Level</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($sensors as $sensor)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $sensor->custom_id ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $sensor->plant->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $sensor->sensor_type }}</td>
                            <td class="px-4 py-3">{{ $sensor->temperature }}</td>
                            <td class="px-4 py-3">{{ $sensor->water_level }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-400">No sensors found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $sensors->links() }}
        </div>
    </section>

    {{-- Transactions Table --}}
    <section>
        <h2 class="text-2xl font-semibold mb-4 text-gray-900">Transactions</h2>
        <div class="overflow-x-auto bg-white rounded-lg shadow-md">
            <table class="min-w-full divide-y divide-gray-200 text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold">ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Sensor ID</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Sensor Type</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold">Logged At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($transactions as $transaction)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $transaction->id }}</td>
                            <td class="px-4 py-3">{{ $transaction->sensor_id }}</td>
                            <td class="px-4 py-3">{{ $transaction->sensor->sensor_type ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $transaction->status }}</td>
                            <td class="px-4 py-3">{{ optional($transaction->logged_at)->format('Y-m-d H:i') ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-4 text-center text-gray-400">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </section>

</div>
@endsection
