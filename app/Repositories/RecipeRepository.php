<?php 

namespace App\Repositories;


use App\Models\Recipe;

class RecipeRepository
{
    /**
     * Récupérer les recettes avec ou sans recherche
     *
     * @param string|null $search
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getRecipes(?string $search, int $perPage = 10)
    {
        return Recipe::when($search, function ($query, $search) {
            return $query->where('name', 'like', '%' . $search . '%');
        })->paginate($perPage);
    }

}
