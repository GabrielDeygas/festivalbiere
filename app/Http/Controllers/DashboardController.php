<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Review;
use App\Models\User;
use App\Repositories\BeerRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    protected $beerRepo;
    protected $reviewRepo;
    protected $userRepo;

    public function __construct(BeerRepository $beerRepo, ReviewRepository $reviewRepo, UserRepository $userRepo)
    {
        $this->beerRepo = $beerRepo;
        $this->reviewRepo = $reviewRepo;
        $this->userRepo = $userRepo;
    }

    public function getTotalBeers()
    {
        $totalBeers = $this->beerRepo->getTotalBeers();

        return response()->json([
            'total_beers' => $totalBeers
        ]);
    }

    public function getAverageRatingForAllBeers()
    {
        $averageRating =  $this->reviewRepo->getAverageRating();

        return response()->json([
            'average_rating' => round($averageRating, 2),
        ]);
    }

    public function getAverageRating($beerId)
    {
        $averageRating = $this->reviewRepo->getAverageRatingByBeer($beerId);

        return response()->json([
            'beer_id' => $beerId,
            'average_rating' => round($averageRating, 2)
        ]);
    }

    public function getTotalReviews()
    {
        $totalReviews = $this->reviewRepo->getTotalReviews();

        return response()->json([
            'total_reviews' => $totalReviews
        ]);
    }

    public function getReviewsByBeer($beerId)
    {
        $totalReviews = $this->reviewRepo->getReviewCountByBeer($beerId);

        return response()->json([
            'beer_id' => $beerId,
            'total_reviews' => $totalReviews,
        ]);
    }

    public function getTotalUsers()
    {
        $totalUsers = $this->userRepo->getTotalUsers();

        return response()->json([
            'total_users' => $totalUsers
        ]);
    }

    public function getBeerTypes()
    {
        $beerTypes = $this->beerRepo->getBeerTypes();

        return response()->json($beerTypes);
    }
}
