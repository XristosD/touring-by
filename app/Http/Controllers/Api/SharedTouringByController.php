<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TouringBy;
use App\Models\SharedTouringBy;

class SharedTouringByController extends Controller
{
    public function shareTouringByToUser(TouringBy $touringBy, User $user, Request $request){
        if($request->user()->id === $user->id || SharedTouringBy::where('user_id','=',$user->id)->where('touring_by_id','=',$touringBy->id)->exists()){
            return response("invalid data", 404);
        }
        $sharedTouringBy = new SharedTouringBy;
        $sharedTouringBy->user_id = $user->id;
        $sharedTouringBy->touring_by_id = $touringBy->id;
        $sharedTouringBy->save();
    }

    public function indexShared(Request $request){
        $id = $request->user()->sharedTouringBies()->select('touring_by_id')->get()->map(function ($item) {
            return $item['touring_by_id'];
        });
        $sharedTouringBies = TouringBy::whereIn('id',$id)->select(['id','completed','created_at','tour_id','user_id'])
                                            ->with(['user:id,name,email','tour:id,name,place_id','tour.place:id,name'])
                                            ->orderBy('created_at', 'desc')
                                            ->simplePaginate(8);
        $data = $sharedTouringBies->makeHidden(['tour_id','user_id']);
        $data->map(function ($item) {
            $item->user->makeHidden(['id']);
            $item->tour->makeHidden(['id','place_id']);
            $item->tour->place->makeHidden(['id']);
        });
        $sharedTouringBies->data = $data;
        return response()->json($sharedTouringBies);
    }
}
