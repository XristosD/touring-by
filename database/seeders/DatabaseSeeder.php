<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Place;
use App\Models\Point;
use App\Models\Tour;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create one admin
        \DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' =>  Hash::make('pass'),
            'remember_token' => Str::random(10),
        ]);

        


        Place::factory()->times(20)->create();

        Point::factory()->times(60)->create();

        $points = Point::all();

        foreach (Place::all() as $place){
            $ids = $points->pluck('id')->random(20)->toArray();
            $place->points()->attach($ids);
        }

        Tour::factory()->times(80)->create();

        foreach(Tour::all() as $tour){
            $route = 1;
            $points = $tour->place->points->random(10);

            foreach($points as $point){
                $tour->points()->attach( $point->id, [ 'route'=> $route++ ] );
            }

            // $tour->attach(
            //     $points->mapWithKeys(function ($point) use($route) { 
            //         return [$point->id => ['route'=> $route++]];
            //     })
            // );

        }

        // $points = Point::select('id')->get();
        // $place = Place::first();
        // $place->points()->attach($points);
    }
}
