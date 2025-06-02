@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 text-white">
    <h1 class="text-2xl font-bold mb-6">Update Profile</h1>

    @if(session('success'))
        <div class="bg-green-600 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Fixed from PUT to PATCH -->

        <div class="mb-4">
            <label class="block mb-2 text-white">Name</label>
            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" class="border p-2 w-full bg-gray-800 text-white">
        </div>

        <div class="mb-4">
            <label class="block mb-2 text-white">Email</label>
            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="border p-2 w-full bg-gray-800 text-white">
        </div>
        
        <div class="mb-4">
            <label class="block mb-2 text-white">Avatar</label>
            <input type="file" name="avatar" class="border p-2 w-full bg-gray-800 text-white">
        </div>

        @if(auth()->user()->avatar)
        <div class="mb-4">
            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="w-20 h-20 rounded-full">
        </div>
        @endif


        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Profile</button>
    </form>
</div>
@endsection
