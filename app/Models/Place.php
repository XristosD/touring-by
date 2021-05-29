<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'info',
        'description',
        'image',
    ];

    public function path(){
        return '/admin/places/' . $this->id;
    }

    public function public_image_path(){
        return Storage::disk('s3')->url($this->image);
        // return $this->image;
    }

    public function points(){
        return $this->belongsToMany(Point::class);
    }

    public function tours(){
        return $this->hasMany(Tour::class);
    }
}
