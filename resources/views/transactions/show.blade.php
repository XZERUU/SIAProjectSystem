@extends('layouts.app')

@section('title', "Transaction #{$transaction->id} Details")

@section('content')
  <h1 class="text-2xl font-semibold mb-4">
    Transaction #{{ $transaction->id }}
  </h1>

  <p><strong>Sensor ID:</strong> {{ $sensor->id }}</p>
  <p><strong>Logged At:</strong> {{ $transaction->logged_at->format('Y-m-d H:i:s') }}</p>
  <p><strong>Status:</strong> {{ $transaction->status }}</p>
  <p><strong>Created At:</strong> {{ $transaction->created_at->format('Y-m-d H:i:s') }}</p>

  <a href="{{ route('sensors.transactions.index', $sensor) }}"
     class="mt-4 inline-block text-blue-600">
    ← Back to Transactions
  </a>
@endsection
