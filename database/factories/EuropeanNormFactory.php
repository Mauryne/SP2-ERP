<?php

namespace Database\Factories;

use App\Models\EuropeanNorm;
use Illuminate\Database\Eloquent\Factories\Factory;

class EuropeanNormFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EuropeanNorm::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'picture' => $this->faker->imageUrl(),
        ];
    }
}
