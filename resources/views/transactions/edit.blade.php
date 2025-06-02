@extends('layouts.app')

@section('title', "Edit Transaction #{$transaction->id}")

@section('content')
  <h1 class="text-2xl font-semibold mb-4">
    Edit Transaction #{{ $transaction->id }} for Sensor #{{ $sensor->id }}
  </h1>

  <form method="POST" action="{{ route('sensors.transactions.update', [$sensor, $transaction]) }}">
    @csrf
    @method('PUT')

    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Logged At (Date & Time)</label>
      <input type="datetime-local" name="logged_at" 
             value="{{ old('logged_at', $transaction->logged_at->format('Y-m-d\TH:i')) }}"
             class="w-full border rounded px-3 py-2" required>
      @error('logged_at')
        <p class="text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium mb-1">Status</label>
      <input type="text" name="status"
             value="{{ old('status', $transaction->status) }}"
             class="w-full border rounded px-3 py-2" required>
      @error('status')
        <p class="text-red-600 text-sm">{{ $message }}</p>
      @enderror
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
      Update Transaction
    </button>
  </form>
@endsection
