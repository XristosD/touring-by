<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\TouringBy;
use App\Models\TouringByPoint;
use \Exception;

class TouringByController extends Controller
{
    public function get(TouringBy $touringBy){
        return response()->json([
            'id' => $touringBy->id,
            'tour' => $touringBy->tour()
                                ->withCount('points')
                                ->get()
                                ->makeHidden(['created_at', 'updated_at', 'has_points', 'info', 'place_id'])
                                ->first(),
        ]);
    }

    public function getNew(Tour $tour, Request $request) {
        $touringBy = new TouringBy;
        $touringBy->user_id = $request->user()->id;
        $touringBy->tour_id = $tour->id;
        $touringBy->save();
        $touringBy->refresh();
        

        $firstPoint = $touringBy->tour->firstPoint();
        $touringByPoint = new TouringByPoint();
        $touringByPoint->touring_by_id = $touringBy->id;
        $touringByPoint->point_id = $firstPoint->id;
        $touringByPoint->save();

        $touringBy->curent_touring_by_point = $touringByPoint->id;
        $touringBy->save();


        return response()->json([
            'id' => $touringBy->id,
            'tour' => $touringBy->tour()
                                ->withCount('points')
                                ->get()
                                ->makeHidden(['created_at', 'updated_at', 'has_points', 'info', 'place_id'])
                                ->first(),
        ]);
    }

    public function currentTuringByPoint(TouringBy $touringBy, Request $request){

        $currentTouringByPoint = $touringBy->currentTouringByPoint();

        return response()->json($currentTouringByPoint->customBasicResponse());
    }

    public function nextTouringByPoint(TouringBy $touringBy, Request $request) {
        $currentTouringByPoint = $touringBy->currentTouringByPoint();
        if($request->has('skipcurrent')){
            $currentTouringByPoint->skiped = $request->boolean('skipcurrent');
            $currentTouringByPoint->save();
        }
        try {
            // last_point refers on the tour_point.route
            $lastRoute = \DB::table('point_tour')->select('route')
                                                ->where('tour_id', $touringBy->tour->id)
                                                ->where('point_id', $currentTouringByPoint->point->id)
                                                ->get();
            $nextPoint = $touringBy->tour->nextPoint($lastRoute[0]->route);
            // return $nextPoint->pivot->route;
            $touringByPoint = new TouringByPoint();
            $touringByPoint->touring_by_id = $touringBy->id;
            $touringByPoint->point_id = $nextPoint->id;
            $touringByPoint->save();
    
            $touringBy->curent_touring_by_point = $touringByPoint->id;
            $touringBy->save();
    
            return response()->json($touringByPoint->customBasicResponse());
        }
        catch(Exception $e){
            if ($e->getMessage() === 'No more points'){
                return response(null, 204);
            }
        }
    }

    public function completeTouringBy(TouringBy $touringBy, Request $request) {
        $touringBy->completed = true;
        $touringBy->save();
        return response(["message" => "TouringBy completed"], 200);
    }

    public function showTouringBy(TouringBy $touringBy, Request $request) {
        $touringBy = $touringBy->fresh();

        $touringBy->load([
            'user:id,name,email',
            'tour:id,name,place_id',
            'tour.place:id,name,image',
            'touringByPoint' => function ($query) {
                $query->where('skiped', false)->orderBy('created_at', 'asc')->select(['id','point_id','like','touring_by_id','hasImage']);
            },
            'touringByPoint.point:id,name,image',
        ])->makeHidden(['user_id', 'tour_id', 'curent_touring_by_point', 'updated_at']);
        $touringBy->user->makeHidden(['id']);
        $touringBy->tour->makeHidden(['place_id']);
        $touringBy->touringByPoint->map( function ($point) {
            $point->makeHidden(['point_id', 'touring_by_id']);
        } );
        $touringBy['user']['owner'] = $touringBy->user->id == $request->user()->id;

        return response()->json($touringBy);
    }

    public function index(Request $request){
        $queryBuilder = $request->user()->touringBy()->select(['id', 'tour_id', 'completed', 'created_at'])
                        ->with(['tour:id,place_id,name', 'tour.place:id,name'])
                        ->orderBy('created_at', 'desc');
        if($request->has('completed')){
            switch ($request->boolean('completed')){
                case true:
                    $queryBuilder->where('completed', '=', true);
                    break;
                case false:
                    $queryBuilder->where('completed', '=', false);
                    break;  
            }
        }
        $touringBies = $queryBuilder->simplePaginate(8);
        $touringBies->map(function ($item) {
            $item->makeHidden(['tour_id']);
            $item->tour->makeHidden(['id','place_id']);
            $item->tour->place->makeHidden(['id']);
        });
        return response()->json($touringBies);
    }
}
