<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Point;
use App\Models\Place;

class PointController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = point::withCount('places')->get();
        return view('points.index', ['points' => $points]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('points.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $validatedData = $request->validate([
                'name' => 'required|unique:points|max:255',
                'description' => 'required',
                'image' => 'required|image|dimensions:min_width=400,min_height=300',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);
            $point = new Point();

            $point->name = $request->input('name');
            $point->info = $request->input('info');
            $point->description = $request->input('description');
            $point->latitude = $request->input('latitude');
            $point->longitude = $request->input('longitude');
            $path= $request->file('image')->store('images', 's3');
            $point->image = Storage::disk('s3')->url($path);
            Storage::disk('s3')->setVisibility($path, 'public');
            $point->save();

            return redirect('/admin/points/'.$point->id);

        }
        return back()->withInput()->withErrors(['upload problem'=>'image upload problem']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function show(Point $point)
    {
        return view('points.show', ['point' => $point]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function edit(Point $point)
    {
        $point->load('places');
        return view('points.edit', ['point' => $point]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Point $point)
    {
        $validatedData = $request->validate([
            'name' => 'max:255',
            'image' => 'image|dimensions:min_width=300,min_height=400',
        ]);
        $point->name = $request->input('name');
        $point->info = $request->input('info');
        $point->description = $request->input('description');
        if($request->hasFile('image')){
            if( $request->file('image')->isValid() ){
                Storage::delete($point->image);
                $point->image = $request->file('image')->store('public/images');
            }
            else{
                return back()->withInput()->withErrors(['upload problem'=>'image upload problem']);
            }
        }
        $point->save();
        return redirect()->action(
            [PointController::class, 'show'], ['point' => $point]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Point  $point
     * @return \Illuminate\Http\Response
     */
    public function destroy(Point $point)
    {
        Storage::delete($point->image);
        $point->delete();
        return redirect()->action([
            PointController::class, 'index',
        ]);
    }

    public function changeLocation(Point $point){
        return view('points.location', ['point' => $point]);
    }

    public function storeLocation(Point $point, Request $request){
        $validatedData = $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        $point->latitude = $request->input('latitude');
        $point->longitude = $request->input('longitude');
        $point->save();

        return redirect('/admin/points/'.$point->id);
    }

    public function editPlaces(Point $point){
        $belongingPlaces = $point->places;
        $notBelongingPlaces = \App\Models\Place::all()->diff($belongingPlaces);
        //dd($belongingPoints, $notBelongingPoints);
        return view('points.edit-places', [
            'point' => $point,
            'belongingPlaces' => $belongingPlaces,
            'notBelongingPlaces' => $notBelongingPlaces,
        ]);
    }

    public function addPlaces(Point $point, Request $request){
        $placesToAdd = Place::find($request->addedPlaces);
        if($placesToAdd){
            $point->places()->saveMany($placesToAdd);
        }
        return redirect()->back();
    }

    public function removePlaces(Point $point, Request $request){
        $placesToRemove = Place::find($request->removedPlaces);
        if($placesToRemove){
            $point->places()->detach($placesToRemove);
        }
        return redirect()->back();
    }

}
