@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Recettes de Bières</h1>

    <a href="{{ route('recipe.creation') }}" class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
        Ajouter une nouvelle recette
    </a>

    <form method="GET" action="{{ route('recipe.index') }}" class="mb-6">
        <input
            type="text"
            name="search"
            placeholder="Rechercher une recette..."
            value="{{ $search ?? '' }}"
            class="p-2 border rounded w-full md:w-1/3"
        />
        <button
            type="submit"
            class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600 mt-2 md:mt-0 md:ml-2"
        >
            Rechercher
        </button>
    </form>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @foreach ($recipes as $recipe)
            <div class="bg-white p-4 rounded-lg shadow relative">
                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $recipe->name }}</h2>
                <p class="text-gray-600 mb-4">{{ Str::limit($recipe->ingredients, 100) }}</p>
    
                <a href="{{ route('recipe.show', $recipe->id) }}" class="text-blue-500 hover:underline">
                    Voir la recette
                </a>
    
                @if (auth()->id() === $recipe->user_id)
                    <form method="POST" action="{{ route('recipe.destroy', $recipe->id) }}" class="absolute top-4 right-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette recette ?');" 
                                class="p-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Supprimer
                        </button>
                    </form>
                @endif
            </div>
        @endforeach
    </div>
    

    <div class="mt-6">
        {{ $recipes->links() }}
    </div>
</div>
@endsection
