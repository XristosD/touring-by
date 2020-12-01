<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Place::class;

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
            'image' => 'public/images/5QLBIY4FJetDj6kFQhIj20Sl9lSgjrgC4mo6a5B9.jpeg',
        ];
    }
}
