@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Créer une Recette</h1>

    <form method="POST" action="{{ route('recipe.create') }}">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium">Nom de la Recette :</label>
            <input type="text" id="name" name="name" class="p-2 border rounded w-full" value="{{ old('name') }}">
            @error('name')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="ingredients" class="block text-gray-700 font-medium">Ingrédients :</label>
            <textarea id="ingredients" name="ingredients" class="p-2 border rounded w-full" rows="4">{{ old('ingredients') }}</textarea>
            @error('ingredients')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="steps" class="block text-gray-700 font-medium">Étapes :</label>
            <textarea id="steps" name="steps" class="p-2 border rounded w-full" rows="6">{{ old('steps') }}</textarea>
            @error('steps')
                <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Enregistrer la Recette
        </button>
    </form>
</div>
@endsection
