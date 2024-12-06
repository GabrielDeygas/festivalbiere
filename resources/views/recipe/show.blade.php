@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">{{ $recipe->name }}</h1>

    <div class="bg-white p-4 rounded-lg shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Ingrédients</h2>
        <p class="text-gray-600">{{ $recipe->ingredients }}</p>
    </div>

    <div class="bg-white p-4 rounded-lg shadow mt-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Étapes</h2>
        <p class="text-gray-600">{{ $recipe->steps }}</p>
    </div>

    <a href="{{ route('recipe.index') }}" class="mt-4 inline-block p-2 bg-gray-500 text-white rounded hover:bg-gray-600">
        Retour à la liste des recettes
    </a>
</div>
@endsection
