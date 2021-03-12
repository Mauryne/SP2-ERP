<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Device;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'initialDuration' => $this->faker->numberBetween(1, 5),
            'customer_id' => $this->faker->numberBetween(1, 5),// correspond à customer_id de device -> faire table pivot relation ternaire
        ];
    }
}
