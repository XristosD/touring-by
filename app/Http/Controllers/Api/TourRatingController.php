<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\TourRating;
use App\Models\TouringBy;

class TourRatingController extends Controller
{
    public function rate(TouringBy $touringBy, Request $request) {
        $validated = $request->validate([
            'rating' => 'required|numeric|integer|between:1,5',
        ]);

        $tourRating = new TourRating();
        $tourRating->user_id = $request->user()->id;
        $tourRating->touring_by_id = $touringBy->id;
        $tourRating->tour_id = $touringBy->tour->id;
        $tourRating->rating = $request->rating;
        $tourRating->save();

        return response(["message" => "Tour rated succesfully"], 200);
    }
}
