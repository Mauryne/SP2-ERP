<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\RenewalContract;
use Illuminate\Database\Eloquent\Factories\Factory;

class RenewalContractFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RenewalContract::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'duration' => $this->faker->numberBetween(1,5),
            'signatureDate' => $this->faker->date('Y-m-d'),
            'contract_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
