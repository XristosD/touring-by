<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    public function path(){
        return '/admin/tours/' . $this->id;
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

    public function points(){
        return $this->belongsToMany(Point::class)->withPivot('route');
    }

    public function firstPoint(){
        return $this->points()->orderBy('point_tour.route', 'asc')->first();
    }

    public function nextPoint($lastRoute){
        // Returns the next point of the tour. Points are ordered by point_tour->route
        // lastRoute refers to poin_tour->route
        
        $routes = $this->routesOrderedAscArray();
        if($lastRoute === end($routes)){
            // if lastRoute is the last point at the routes array it means end of line reached
            throw new \Exception('No more points');
        }
        $index = array_search($lastRoute, $routes);
        if($index === false){
            return;
        }
        $nextRoute = $routes[$index+1];
        $nextPoint = $this->points()->where('point_tour.route', '=', $nextRoute)->first();
        return $nextPoint;
    }

    public function routesOrderedAscArray(){
        // return array of points route ordered asc. Only routes returned as array not Point object.

        $routesOrdered = $this->points()->orderBy('point_tour.route', 'asc')->get(['point_tour.route'])->makeHidden("pivot");
        $routesOrderedArray = $routesOrdered->map(function ($value){
            return data_get($value, "route");
        });
        return $routesOrderedArray->toArray();
    }

}
