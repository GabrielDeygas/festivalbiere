<?php

namespace App\Http\Controllers;


use App\Models\Beer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\BeerRepository;
use App\Repositories\ReviewRepository;

class BeerController extends Controller
{

    protected $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
        $this->reviewRepository = $reviewRepository;
    }

    public function show($id)
    {
        $beer = Beer::with('country')->findOrFail($id);

        $reviewCount = $this->reviewRepository->getReviewCountByBeer($id);
        $averageRating = $this->reviewRepository->getAverageRatingByBeer($id);
        $reviews = $this->reviewRepository->getPaginatedReviewsByBeer($id);
        $userReview = $beer->reviews->where('user_id', auth()->id())->first();

        return view('beer.show', compact('beer', 'reviewCount', 'averageRating', 'reviews', 'userReview'));
    }



    // API part 

    public function getAll(): JsonResponse
    {
        $beers = Beer::all();
        return response()->json($beers);
    }
}
