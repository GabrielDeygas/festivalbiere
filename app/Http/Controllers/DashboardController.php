<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getTotalBeers()
    {
        $totalBeers = Beer::count();

        return response()->json([
            'total_beers' => $totalBeers
        ]);
    }

    public function getAverageRatingForAllBeers()
    {
        $averageRating = Review::avg('note');

        return response()->json([
            'average_rating' => round($averageRating, 2),
        ]);
    }


    public function getAverageRating($beerId)
    {
        $averageRating = Review::where('beer_id', $beerId)->avg('note');

        return response()->json([
            'beer_id' => $beerId,
            'average_rating' => round($averageRating, 2)
        ]);
    }

    public function getTotalReviews()
    {
        $totalReviews = Review::count();

        return response()->json([
            'total_reviews' => $totalReviews
        ]);
    }

    public function getReviewsByBeer($beerId)
    {
        $totalReviews = Review::where('beer_id', $beerId)->count();

        return response()->json([
            'beer_id' => $beerId,
            'total_reviews' => $totalReviews,
        ]);
    }

    public function getTotalUsers()
    {
        $totalUsers = User::count();

        return response()->json([
            'total_users' => $totalUsers
        ]);
    }

    public function getBeerTypes()
    {
        $beerTypes = Beer::select('type', Beer::raw('COUNT(*) as count'))
            ->groupBy('type')
            ->get();

        return response()->json($beerTypes);
    }


}
