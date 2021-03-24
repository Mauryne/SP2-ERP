<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => ucfirst($this->faker->company),
            'streetNumber' => $this->faker->numberBetween(1,10),
            'street' => $this->faker->word,
            'postalCode' => $this->faker->numberBetween(10000,90000),
            'city' => $this->faker->city,
            'telephoneNumber' => '0707070707',
            'email' => $this->faker->email,
        ];
    }
}
