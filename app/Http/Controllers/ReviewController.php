<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Beer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function create(Request $request, $id)
    {
        $validated = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string|max:500',
        ]);

        Review::create([
            'beer_id' => $id,
            'user_id' => auth()->id(),
            'note' => $validated['note'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('beer.show', $id)->with('success', 'Your review has been submitted!');
    }

    public function destroy(Request $request, $beerId)
    {
        $review = Review::where('beer_id', $beerId)
            ->where('user_id', auth()->id())
            ->first();

        if (!$review) {
            return redirect()->back()->with('error', 'Vous n\'avez pas noté cette bière.');
        }

        $review->delete();

        return redirect()->back()->with('success', 'Votre note a été supprimée avec succès.');
    }


    // API part

    public function store(Request $request, Beer $beer)
    {
            $validated = $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'description' => 'nullable|string|max:1000',
        ]);

        $review = Review::create([
            'note' => $validated['note'],
            'description' => $validated['description'] ?? null,
            'user_id' => Auth::id(),
            'beer_id' => $beer->id,
        ]);

        return response()->json([
            'message' => 'Review created successfully',
            'review' => $review,
        ], 201);
    }
}
