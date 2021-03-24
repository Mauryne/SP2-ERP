<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class saleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'date' => $this->faker->date('Y-m-d'),
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'state' => $this->faker->word,
            'device_id' => $this->faker->numberBetween(1, 50),
            'customer_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
