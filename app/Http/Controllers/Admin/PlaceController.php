<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
{
    public function __construct(){
        $this->middleware('auth:admin');
    }

    public function index(){
        $places = Place::all();
        return view('places.index', ['places' => $places]);
    }

    public function create(){
        return view('places.create');
    }

    public function store(Request $request){

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $validatedData = $request->validate([
                'name' => 'required|unique:places|max:255',
                'description' => 'required',
                'image' => 'required|image|dimensions:min_width=300,min_height=400',
            ]);
            $place = new Place();

            $place->name = $request->input('name');
            $place->info = $request->input('info');
            $place->description = $request->input('description');
            $place->image = $request->file('image')->store('public/images');
            $place->save();

            return redirect('/admin/places/'.$place->id);

        }
        return back()->withInput()->withErrors(['upload problem'=>'image upload problem']);
        
    }

    public function show(Place $place){
        return view('places.show', ['place' => $place]);
    }

    public function edit(Place $place){
        return view('places.edit', ['place' => $place]);
    }

    public function update(Place $place, Request $request){
        $validatedData = $request->validate([
            'name' => 'max:255',
            'image' => 'image|dimensions:min_width=300,min_height=400',
        ]);
        $place->name = $request->input('name');
        $place->info = $request->input('info');
        $place->description = $request->input('description');
        if($request->hasFile('image')){
            if( $request->file('image')->isValid() ){
                Storage::delete($place->image);
                $place->image = $request->file('image')->store('public/images');
            }
            else{
                return back()->withInput()->withErrors(['upload problem'=>'image upload problem']);
            }
        }
        $place->save();
        return view('places.show', ['place' => $place]);
    }

    public function destroy(Place $place){
        Storage::delete($place->image);
        $place->delete();
        return view('places.index');
    }
}