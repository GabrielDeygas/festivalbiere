<?php 

namespace App\Repositories;

use App\Models\Review;

class ReviewRepository
{
    /**
     * Récupérer le nombre total de reviews
     */
    public function getTotalReviews()
    {
        return Review::count();
    }

    /**
     * Récupérer la note moyenne des rewiews
     */
    public function getAverageRating()
    {
        return Review::avg('note');
    }

    /**
     * Récupérer le nombre de reviews pour une bière
     *
     * @param int $beerId
     * @return int
     */
    public function getReviewCountByBeer(int $beerId): int
    {
        return Review::where('beer_id', $beerId)->count();
    }

    /**
     * Récupérer la note moyenne pour une bière
     *
     * @param int $beerId
     * @return float|null
     */
    public function getAverageRatingByBeer(int $beerId): ?float
    {
        return Review::where('beer_id', $beerId)->avg('note');
    }

    /**
     * Récupérer les reviews d'une bière avec pagination
     *
     * @param int $beerId
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedReviewsByBeer(int $beerId, int $perPage = 5)
    {
        return Review::where('beer_id', $beerId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }
}
