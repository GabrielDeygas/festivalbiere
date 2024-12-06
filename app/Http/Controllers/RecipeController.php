<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Repositories\RecipeRepository;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{

    protected $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * Afficher toutes les recettes
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $recipes = $this->recipeRepository->getRecipes($search);

        return view('recipe.index', compact('recipes', 'search'));
    }

    /**
     * Afficher une recette spécifique
     */
    public function show(Recipe $recipe)
    {
        return view('recipe.show', compact('recipe'));
    }

    /**
     * Afficher le formulaire pour créer une recette
     */
    public function creation()
    {
        return view('recipe.creation');
    }

    /**
     * Enregistrer une nouvelle recette
     */
    public function create(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'ingredients' => 'required|string|max:1000',
            'steps' => 'required|string|max:2000',
        ]);

        Recipe::create([
            'name' => $validated['name'],
            'ingredients' => $validated['ingredients'],
            'steps' => $validated['steps'],
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('recipe.index')->with('success', 'Recette créée avec succès.');
    }
    
    public function destroy(Recipe $recipe)
    {
        if ($recipe->user_id !== auth()->id()) {
            return redirect()->route('recipes.index')->with('error', 'Vous ne pouvez pas supprimer cette recette.');
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recette supprimée avec succès.');
    }


    // API part

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ingredients' => 'required|string|max:2000',
            'steps' => 'required|string|max:5000',
        ]);

        $recipe = Recipe::create([
            'ingredients' => $validated['ingredients'],
            'steps' => $validated['steps'],
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Recipe created successfully',
            'recipe' => $recipe,
        ], 201);
    }
}