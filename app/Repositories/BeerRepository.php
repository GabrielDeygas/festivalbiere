<?php

namespace App\Repositories;

use App\Models\Beer;

class BeerRepository
{
    /**
     * Récupérer toutes les bières avec pagination
     *
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllBeers(int $perPage = 10)
    {
        return Beer::paginate($perPage);
    }

     /**
     * Récupérer toutes les bières avec pagination et filtres combinés
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getBeers(array $filters = [], int $perPage = 10)
    {
        $query = Beer::query();

        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (!empty($filters['origin'])) {
            $query->where('country_id', $filters['origin']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        return $query->paginate($perPage);
    }

    /**
     * Filtrer les bières par nom
     *
     * @param string $name
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filterByName(string $name, int $perPage = 10)
    {
        return Beer::where('name', 'like', '%' . $name . '%')->paginate($perPage);
    }

    /**
     * Filtrer les bières par origine (country_id)
     *
     * @param int $countryId
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filterByOrigin(int $countryId, int $perPage = 10)
    {
        return Beer::where('country_id', $countryId)->paginate($perPage);
    }

    /**
     * Filtrer les bières par type
     *
     * @param string $type
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filterByType(string $type, int $perPage = 10)
    {
        return Beer::where('type', $type)->paginate($perPage);
    }

    /**
     * Filtrer les bières par catégorie
     *
     * @param string $category
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filterByCategory(string $category, int $perPage = 10)
    {
        return Beer::where('category', $category)->paginate($perPage);
    }

    /**
     * Récupérer les 5 bières avec le plus de notes
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTop5MostRatedBeers()
    {
        return Beer::withCount('reviews')
            ->orderBy('reviews_count', 'desc')
            ->take(5)
            ->get();
    }

   /**
     * Récupérer les 5 bières avec la meilleure note moyenne
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTop5RatedBeers()
    {
        return Beer::withAvg('reviews', 'note')
            ->orderByDesc('reviews_avg_note')
            ->take(5)
            ->get();
    }

    /**
     * Récupérer le nombre total de bières
     */
    public function getTotalBeers()
    {
        return Beer::count();
    }

    /**
     * Récupérer le nombre des différents types de bières
     */
    public function getBeerTypes()
    {
        $beerTypes = Beer::select('type', Beer::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->get();

        return $beerTypes;
    }
}
