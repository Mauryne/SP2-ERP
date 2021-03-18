<?php

namespace Database\Factories;

use App\Models\Installation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InstallationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Installation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->date('Y-m-d'),
            'picture_path' => '1578_besd_afgf.jpg',
            'summary' => $this->faker->word,
            'user_id' => 1,
        ];
    }
}
