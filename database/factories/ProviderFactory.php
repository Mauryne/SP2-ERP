<?php

namespace Database\Factories;

use App\Models\Provider;
use Illuminate\Database\Eloquent\Factories\Factory;

class providerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'streetNumber' => $this->faker->numberBetween(1,10),
            'street' => $this->faker->word,
            'postalCode' => $this->faker->numberBetween(10000,90000),
            'city' => $this->faker->city,
            'telephoneNumber' => $this->faker->numberBetween(0601010101,0701010101),
            'email' => $this->faker->email,
        ];
    }
}
