@extends('layouts.app')

@section('title', $beer->name)

@section('content')
    <div class="container mx-auto p-4">

        <a href="{{ route('home') }}" class="mt-4 mb-4 inline-block p-2 bg-blue-500 text-white rounded hover:bg-gray-600">
            Back to Beers
        </a>

        <div class="bg-white p-6 rounded-lg shadow">
            <h1 class="text-3xl font-bold mb-4">{{ $beer->name }}</h1>
            <p class="text-gray-600 mb-2"><strong>Type:</strong> {{ $beer->type }}</p>
            <p class="text-gray-600 mb-2"><strong>Categorie:</strong> {{ $beer->category }}</p>
            <p class="text-gray-600 mb-2"><strong>Origine:</strong> {{ $beer->country->name ?? 'N/A' }}</p>
            <p class="text-gray-600 mb-2"><strong>Description:</strong> {{ $beer->description ?? 'No description available.' }}</p>

            <p class="text-gray-600 mb-2"><strong>Nombre d'avis:</strong> {{ $reviewCount }}</p>

            <p class="text-gray-600 mb-2">
                <strong>Average Rating:</strong>
                {{ $averageRating ? round($averageRating, 2) . ' ⭐' : 'Pas encore de note' }}
            </p>
        </div>

        @auth
            @if (!$userReview)
                <div class="bg-gray-100 p-6 rounded-lg shadow mt-6">
                    <h2 class="text-2xl font-bold mb-4">Leave a Review</h2>

                    <form method="POST" action="{{ route('beer.review.create', $beer->id) }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-gray-700 font-medium">Your Rating (1 to 5):</label>
                            <div class="flex space-x-1" id="stars">
                                <span data-value="1" class="cursor-pointer text-gray-300 text-3xl transition duration-200">&#9733;</span>
                                <span data-value="2" class="cursor-pointer text-gray-300 text-3xl transition duration-200">&#9733;</span>
                                <span data-value="3" class="cursor-pointer text-gray-300 text-3xl transition duration-200">&#9733;</span>
                                <span data-value="4" class="cursor-pointer text-gray-300 text-3xl transition duration-200">&#9733;</span>
                                <span data-value="5" class="cursor-pointer text-gray-300 text-3xl transition duration-200">&#9733;</span>
                            </div>
                            <input type="hidden" name="note" id="note" value="0">
                            <p class="text-red-500 text-sm hidden" id="error-message">Please select a rating</p>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-medium">Your Comment:</label>
                            <textarea id="description" name="description" class="p-2 border rounded w-full" rows="3"></textarea>
                            @error('description')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Submit Review
                        </button>
                    </form>
                </div>
            @else
            <div class="bg-gray-100 p-6 rounded-lg shadow mt-6">
                <h2 class="text-2xl font-bold mb-4">Votre Avis</h2>
    
                <p class="text-gray-700 mb-2">
                    <strong>Votre Note :</strong> {{ $userReview->note }} ⭐
                </p>
    
                <p class="text-gray-700 mb-4">
                    <strong>Votre Commentaire :</strong> {{ $userReview->description }}
                </p>
    
                <form method="POST" action="{{ route('beer.review.destroy', $beer->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Supprimer mon Avis
                    </button>
                </form>
            </div>
            @endif
        @else
            <p class="text-gray-600 mt-6">
                Il faut vous connecter afin de mettre une note.
            </p>
        @endauth

        <div class="bg-gray-100 p-6 rounded-lg shadow mt-6">
            <h2 class="text-2xl font-bold mb-4">Reviews</h2>
            @forelse ($reviews as $review)
                <div class="mb-4 border-b pb-4">
                    <p class="text-gray-800"><strong>Note:</strong> {{ $review->note }} ⭐</p>
                    <p class="text-gray-600"><strong>Comment:</strong> {{ $review->description }}</p>
                    <p class="text-gray-500 text-sm">Reviewed by User ID: {{ $review->user->name }} on {{ $review->created_at->format('d M Y') }}</p>
                </div>
            @empty
                <p class="text-gray-600">No reviews yet.</p>
            @endforelse

            <div class="mt-4">
                {{ $reviews->links() }}
            </div>
        </div>

        <a href="{{ route('home') }}" class="mt-4 inline-block p-2 bg-gray-500 text-white rounded hover:bg-gray-600">
            Back to Beers
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('#stars span');
    const input = document.getElementById('note');
    const errorMessage = document.getElementById('error-message');

    let selectedRating = 0;

    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            updateStars(star.dataset.value);
        });

        star.addEventListener('mouseout', () => {
            updateStars(selectedRating);
        });

        star.addEventListener('click', () => {
            selectedRating = star.dataset.value;
            input.value = selectedRating;
            errorMessage.classList.add('hidden');
        });
    });

    function updateStars(rating) {
        stars.forEach(star => {
            star.classList.remove('text-yellow-400', 'text-gray-300');
            if (star.dataset.value <= rating) {
                star.classList.add('text-yellow-400');
            } else {
                star.classList.add('text-gray-300');
            }
        });
    }
});
    </script>
@endsection