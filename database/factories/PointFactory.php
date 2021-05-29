<?php

namespace Database\Factories;

use App\Models\Point;
use Illuminate\Database\Eloquent\Factories\Factory;

class PointFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Point::class;

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
            'latitude' => $this->faker->latitude(37.9, 38.0),
            'longitude' => $this->faker->longitude(23.7, 23.8),
            'image' => 'https://picsum.photos/400/300?random='.random_int(0,2000),
        ];
    }
}
