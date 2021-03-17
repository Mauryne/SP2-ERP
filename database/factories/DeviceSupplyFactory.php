<?php

namespace Database\Factories;

use App\Models\DeviceSupply;
use Illuminate\Database\Eloquent\Factories\Factory;

class deviceSupplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeviceSupply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supply_id' => $this->faker->numberBetween(1, 20),
            'device_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
