<?php

namespace Database\Factories;

use App\Models\ContractCustomerDevice;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractCustomerDeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContractCustomerDevice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'device_id' => $this->faker->numberBetween(1, 50),
            'customer_id' => $this->faker->numberBetween(1, 5),
            'contract_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
