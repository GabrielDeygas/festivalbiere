<header class="bg-black mx-auto text-white p-4">
    <div class="container mx-auto flex items-center">
        <img src="{{ asset('storage/logo.png') }}" alt="Logo Bière Festival" class="h-16 w-auto">
        <nav class="flex w-full">
            <ul class="flex w-full justify-between text-xl space-x-4 font-bold">
                <div class="flex">
                    <li class="ml-10"><a href="{{ url('/') }}" class="hover:underline">Accueil</a></li>
                    <li class="ml-6"><a href="{{ route('recipe.index') }}" class="hover:underline">Recettes</a></li>
                </div>
                <div>
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                Déconnexion
                            </button>
                        </form>
                    @else
                    <div class="flex">
                        <li class="ml-2"><a href="{{ route('login') }}" class="hover:underline">Connexion</a></li>
                        <li class="ml-6"><a href="{{ route('register') }}" class="hover:underline">Inscription</a></li>
                    </div>
                    @endauth
                </div>
            </ul>
        </nav>
    </div>
</header>
