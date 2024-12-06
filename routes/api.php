<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Beers 
Route::get('/beers', [BeerController::class, 'getAll']);


// Reviews
Route::middleware('auth:sanctum')->post('/beers/{beer}/review', [ReviewController::class, 'store']);


// Recipes
Route::middleware('auth:sanctum')->post('/add-recipes', [RecipeController::class, 'store']);

// Dashboard
Route::get('/stats/total-beers', [DashboardController::class, 'getTotalBeers']);
Route::get('/stats/average-rating-beers', [DashboardController::class, 'getAverageRatingForAllBeers']);
Route::get('/stats/average-rating/{beer}', [DashboardController::class, 'getAverageRating']);
Route::get('/stats/total-reviews', [DashboardController::class, 'getTotalReviews']);
Route::get('/stats/reviews/{beer}', [DashboardController::class, 'getReviewsByBeer']);
Route::get('/stats/total-users', [DashboardController::class, 'getTotalUsers']);
Route::get('/stats/beer-types', [DashboardController::class, 'getBeerTypes']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
