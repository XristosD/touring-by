<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Point extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'info',
        'description',
        'image',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'latitude' => 'double',
        'longitude' => 'double',
    ];

    public function path(){
        return '/admin/points/' . $this->id;
    }

    public function public_image_path(){
        // return Storage::url($this->image);
        return Storage::disk('s3')->url($this->image);
    }

    public function places(){
        return $this->belongsToMany(Place::class);
    }

    public function tours(){
        return $this->belongsToMany(Tour::class)->withPivot('route');
    }
}
