@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Inscription</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Nom :</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full p-2 border rounded">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium">Email :</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full p-2 border rounded">
            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium">Mot de passe :</label>
            <input type="password" id="password" name="password" class="w-full p-2 border rounded">
            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-gray-700 font-medium">Confirmez le mot de passe :</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border rounded">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">S'inscrire</button>
    </form>
</div>
@endsection
