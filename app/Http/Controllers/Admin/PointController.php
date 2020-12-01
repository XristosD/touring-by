<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Point;

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
        $points = point::all();
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
                'image' => 'required|image|dimensions:min_width=300,min_height=400',
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
            ]);
            $point = new Point();

            $point->name = $request->input('name');
            $point->info = $request->input('info');
            $point->description = $request->input('description');
            $point->latitude = $request->input('latitude');
            $point->longitude = $request->input('longitude');
            $point->image = $request->file('image')->store('public/images');
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
        return view('points.show', ['point' => $point]);
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
        $points = point::all();
        return view('points.index', ['points' => $points]);
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
}
