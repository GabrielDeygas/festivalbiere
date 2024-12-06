<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Beers
Route::get('/beer/{id}', [BeerController::class, 'show'])->name('beer.show');
Route::post('/beer/{id}/review', [ReviewController::class, 'create'])->name('beer.review.create')->middleware('auth');

// Reviews
Route::delete('/beer/{beer}/review', [ReviewController::class, 'destroy'])->name('beer.review.destroy')->middleware('auth');

// Recipes
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipe.index');
Route::get('/recipes/show/{recipe}', [RecipeController::class, 'show'])->name('recipe.show');
Route::get('/recipes/creation', [RecipeController::class, 'creation'])->name('recipe.creation')->middleware('auth');
Route::post('/recipes', [RecipeController::class, 'create'])->name('recipe.create')->middleware('auth');
Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipe.destroy')->middleware('auth');

// Auth 
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
