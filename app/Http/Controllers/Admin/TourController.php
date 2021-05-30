<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Place;
use DB;

class TourController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $tours = Tour::all();

        return view( 'tours.index', [
            'tours' => $tours
        ]);
    }

    public function create()
    {
        $places = Place::select('id', 'name')->get();
        return view('tours.create', [
            'places' => $places,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:tours|max:255',
            'description' => 'required',
            'place' => 'required|exists:App\Models\Place,id'
        ]);
        $tour = new Tour();

        $tour->name = $request->input('name');
        $tour->info = $request->input('info');
        $tour->description = $request->input('description');
        $tour->place_id = $request->input('place');
        $tour->save();
        

        return redirect('/admin/tours/'.$tour->id);
    }

    public function show(Tour $tour){
        return view('tours.show', ['tour' => $tour]);
    }

    public function showRoute(Tour $tour, Request $request){
        $routes = $tour->points()->select('latitude AS lat', 'longitude', 'name', 'point_tour.route')
        ->get()
        ->makeHidden('pivot');
        // foreach($routes as $route){
        //     $route->lat = floatval($route->lat);
        //     $route->lng = floatval($route->lmg);
        // }
        return response()->json($routes);
    }

    public function editRoute(Tour $tour){
        return view('tours.edit-route', ['tour' => $tour]);
    }

    public function getRoute(Tour $tour, Request $request){
        $routes = $tour->place->points()->select('latitude as lat', 'longitude as lng', 'name', 'points.id', 'point_tour.route')
        ->leftjoin('point_tour', function ($join) use ( $tour ){
            $join->on('points.id', '=', 'point_tour.point_id')
            ->where('point_tour.tour_id','=', $tour->id);
        })
        ->get()
        ->makeHidden('pivot')
        ->each(function ($item, $key){
            return $item->route = $item->route ?: 0;
        });
        foreach($routes as $route){
            $route->lat = floatval($route->lat);
            $route->lng = floatval($route->lmg);
        }
        return response()->json($routes);
    }

    public function storeRoute(Tour $tour, Request $request){
        DB::table('point_tour')->where('tour_id', '=', $tour->id)->delete();
        $routes = [];
        if(!empty($request->input('route'))){
            foreach($request->input('route') as $route => $id){
                $routes[$id] = [ 'route' => $route ];
            }
            $tour->has_points = TRUE;
        }
        else{
            $tour->has_points = FALSE;
        }
        
        $tour->save();
        $tour->points()->attach($routes);
        
        return view('tours.show', ['tour' => $tour]);
        
    }
}
