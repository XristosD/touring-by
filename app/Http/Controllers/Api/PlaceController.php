<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PlaceController extends Controller
{
    public function index(){

        $places = DB::table('places')->select('id','name','description','image')->simplePaginate(8);
        return $places;
    }

    public function indexTour(Place $place){
        $tours = $place->tours()->select('id','name','description')->where('has_points', true)->withCount('points')->get();
        return [
            'tours' => $tours,
            'length' => $tours->count(),
        ];
    }
}
