<?php

namespace Database\Factories;

use App\Models\Guarantee;
use App\Models\RenewalGuarantee;
use Illuminate\Database\Eloquent\Factories\Factory;

class RenewalGuaranteeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RenewalGuarantee::class;

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
            'guarantee_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
