<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

// use Faker\Factory as FakerFactory;
// use Faker\Generator as FakerGenerator;
// use Salopot\ImageGenerator\ImageSources\Local;
// use Salopot\ImageGenerator\ImageSources\Remote;

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
            'image' => 'https://picsum.photos/400/300?random='.random_int(0,2000),
        ];
    }
}
