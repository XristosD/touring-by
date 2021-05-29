<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouringBy extends Model
{
    use HasFactory;

    protected $casts = [
        'completed' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function sharedUsers(){
        return $this->hasMany(SharedTouringBy::class);
    }

    public function touringByPoint(){
        return $this->hasMany(TouringByPoint::class);
    }

    public function currentTouringByPoint(){
        return TouringByPoint::findOrFail($this->curent_touring_by_point);
    }

}
