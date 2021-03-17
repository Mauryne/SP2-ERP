<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class purchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'quantity' => $this->faker->numberBetween(1,10),
            'supply_id' => $this->faker->numberBetween(1, 20),
            'provider_id' => $this->faker->numberBetween(1, 30),
        ];
    }
}
