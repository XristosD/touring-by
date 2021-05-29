<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TouringBy;
use App\Models\TouringByPoint;
use App\Models\Tour;
use Illuminate\Support\Facades\Storage;

class TouringByPointController extends Controller
{
    public function like(TouringByPoint $touringByPoint){
        $touringByPoint->like = true;
        $touringByPoint->save();
        return response(["message" => "TouringByPoint liked"], 200);
    }

    public function unLike(TouringByPoint $touringByPoint){
        $touringByPoint->like = false;
        $touringByPoint->save();
        return response(["message" => "TouringByPoint unliked"], 200);
    }

    public function skip(TouringByPoint $touringByPoint){
        $touringByPoint->skiped = true;
        $touringByPoint->save();
        return response(["message" => "TouringByPoint skiped"], 200);
    }

    public function unSkiped(TouringByPoint $touringByPoint){
        $touringByPoint->skiped = false;
        $touringByPoint->save();
        return response(["message" => "TouringByPoint unskiped"], 200);
    }

    public function uploadImage(TouringByPoint $touringByPoint, Request $request){
        if($request->hasFile('image') && $request->file('image')->isValid()){
            $validatedData = $request->validate([
                'image' => 'required|image|dimensions:max_width=1800,max_height=1800',
            ]);

            if($touringByPoint->hasImage){
                // only one image per TouringByPoint allowed. Delete old one
                Storage::disk('s3')->delete($touringByPoint->image);
            }
            else{
                $touringByPoint->hasImage = true;
            }

            $touringByPoint->image = $request->file('image')->store('images', 's3');
            $touringByPoint->save();
            return response(["message" => "TouringByPoint image uploaded"], 200);
        }
    }

    public function image(TouringByPoint $touringByPoint, Request $request) {
        if(!$touringByPoint->hasImage){
            return response(null, 204);
        }
        return Storage::disk('s3')->response( $touringByPoint->image );
    }

}
