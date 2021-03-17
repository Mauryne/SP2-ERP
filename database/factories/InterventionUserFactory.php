<?php

namespace Database\Factories;

use App\Models\InterventionUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class InterventionUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InterventionUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 2),
            'maintenance_id' => $this->faker->numberBetween(1, 40),
        ];
    }
}
