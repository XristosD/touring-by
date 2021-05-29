<?php

namespace Database\Factories;

use App\Models\Tour;
use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class TourFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tour::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetName ,
            'info' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(4),
            'place_id' => Place::get('id')->pluck('id')->random(1)->first(),
            'has_points' => true,
        ];
    }
}
