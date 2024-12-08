@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container mx-auto p-4">
        <div class="w-full h-50 bg-black">
            <img src="{{ asset('storage/banneer.png') }}" alt="Bannière Bière Festival" class="w-full">
        </div>
        <h1 class="text-3xl font-bold mt-6 mb-6">Nos bières</h1>

        <form method="GET" action="{{ route('home') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <input type="text" name="name" value="{{ request('name') }}" placeholder="Nom de la bière"
                class="p-2 border rounded">

            <select name="origin" class="p-2 border rounded">
                <option value="">Tout pays</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}" {{ request('origin') == $country->id ? 'selected' : '' }}>
                        {{ $country->name }}
                    </option>
                @endforeach
            </select>

            <select name="type" class="p-2 border rounded">
                <option value="">Tout types</option>
                @foreach (['Blonde', 'Brune', 'IPA', 'Porter', 'Lager'] as $type)
                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </select>

            <select name="category" class="p-2 border rounded">
                <option value="">Toutes catégories</option>
                @foreach (['Belgian Ale', 'India Pale Ale', 'Pilsner', 'Dark Ale'] as $category)
                    <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                        {{ $category }}
                    </option>
                @endforeach
            </select>

            <div class="flex gap-2">
                <button type="submit" class="p-2 bg-orange-400 text-white rounded">Filtrer</button>
            </div>
        </form>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($beers as $beer)
                <div class="bg-white p-4 rounded-lg shadow">
                    <a href="{{ route('beer.show', $beer->id) }}">


                        @if ($beer->img)
                            <img src="{{ Storage::url($beer->img) }}" alt="Image of {{ $beer->name }}"
                                class="w-full h-48 object-cover rounded-lg mb-4">
                        @else
                            <img src="{{ asset('images/default-beer.jpg') }}" alt="Default Image"
                                class="w-full h-48 object-cover rounded-lg mb-4">
                        @endif

                        <h2 class="text-xl text-orange-600 font-semibold">
                            {{ $beer->name }}
                        </h2>
                        <p class="text-gray-600">Type: {{ $beer->type }}</p>
                        <p class="text-gray-600">Categorie: {{ $beer->category }}</p>
                        <p class="text-gray-600">Origine: {{ $beer->country->name ?? 'Non renseigné' }}</p>
                    </a>
                </div>
            @endforeach
        </div>


        <div class="mt-6">
            {{ $beers->links() }}
        </div>
    </div>
@endsection
