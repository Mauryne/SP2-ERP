<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\Intervention;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterventionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Intervention::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'streetNumber' => $this->faker->numberBetween(1,10),
            'street' => $this->faker->word,
            'postalCode' => $this->faker->numberBetween(10000,90000),
            'city' => $this->faker->city,
            'date' => $this->faker->date('Y-m-d'),
            'comment' => $this->faker->word,
            'externalProvider' => $this->faker->boolean,
            'device_id' => $this->faker->numberBetween(1, 50),
        ];
    }
}
