<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\Guarantee;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuaranteeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Guarantee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'initialDuration' => $this->faker->numberBetween(1,5),
        ];
    }
}
