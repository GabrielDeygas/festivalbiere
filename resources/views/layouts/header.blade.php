<header class="bg-blue-500 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">Bière Festival</h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="{{ url('/') }}" class="hover:underline">Accueil</a></li>
                <li><a href="{{ route('recipe.index') }}" class="hover:underline">Recettes</a></li>
                @auth
                        <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <li><a href="{{ route('login') }}" class="hover:underline">Connexion</a></li>
                    <li><a href="{{ route('register') }}" class="hover:underline">Inscription</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>