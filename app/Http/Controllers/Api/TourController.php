<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Point;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    public function indexPoint(Tour $tour) {
        $points = $tour->points()->simplePaginate(8);
        $data = $points->makeHidden(['pivot', 'created_at', 'updated_at']);
        $points->data = $data;
        return $points;
    }
}
