<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouringByPoint extends Model
{
    use HasFactory;

    protected $casts = [
        'hasImage' => 'boolean',
        'like' => 'boolean'
    ];

    public function customBasicResponse(){
        return [
            'id' => $this->id,
            'like' => (bool) $this->like,
            'hasImage' => (bool) $this->hasImage,
            'hasNext' => (boolean)($this->touringBy->touringByPoint->count() < $this->touringBy->tour->points->count()),
            'point' => $this->point->makeHidden(['created_at', 'updated_at','info'])
        ];
    }

    public function touringBy(){
        return $this->belongsTo(TouringBy::class);
    }

    public function point(){
        return $this->belongsTo(Point::class);
    }
}
