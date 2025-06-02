@extends('layouts.app')

@section('title', "Transactions for Sensor #{$sensor->id}")

@section('content')
  <h1 class="text-2xl font-semibold mb-4">
    Transactions for Sensor #{{ $sensor->id }}
  </h1>

  <a href="{{ route('sensors.transactions.create', $sensor) }}"
     class="bg-green-600 text-white px-4 py-2 rounded mb-4 inline-block">
    + Add Transaction
  </a>

  <table class="min-w-full bg-white rounded shadow overflow-x-auto">
    <thead class="bg-gray-100">
      <tr>
        <th class="px-4 py-2">ID</th>
        <th class="px-4 py-2">Logged At</th>
        <th class="px-4 py-2">Status</th>
        <th class="px-4 py-2">Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($transactions as $transaction)
        <tr>
          <td class="border px-4 py-2">{{ $transaction->id }}</td>
          <td class="border px-4 py-2">{{ $transaction->logged_at->format('Y-m-d H:i:s') }}</td>
          <td class="border px-4 py-2">{{ $transaction->status }}</td>
          <td class="border px-4 py-2">
            <a href="{{ route('sensors.transactions.show', [$sensor, $transaction]) }}"
               class="text-blue-600">View</a>
            <a href="{{ route('sensors.transactions.edit', [$sensor, $transaction]) }}"
               class="text-green-600 ml-2">Edit</a>
            <form method="POST"
                  action="{{ route('sensors.transactions.destroy', [$sensor, $transaction]) }}"
                  class="inline">
              @csrf
              @method('DELETE')
              <button type="submit" class="text-red-600 ml-2">Delete</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="text-center py-4">No transactions found.</td>
        </tr>
      @endforelse
    </tbody>
  </table>

  <div class="mt-4">
    {{ $transactions->links() }}
  </div>
@endsection
