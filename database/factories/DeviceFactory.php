<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\Device;
use App\Models\EuropeanNorm;
use App\Models\Installation;
use App\Models\Type;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Device::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'serialNumber' => $this->faker->word,
            'productReference' => $this->faker->word,
            'saleDate' => null, // si customer_id = null, saleDate = null
            'installation_id' => null, //si un id pris ne peut pas être repris
            'type_id' => $this->faker->numberBetween(1, 4),
            'customer_id' => null,
            'europeanNorm_id' => null, //si un id pris ne peut pas être repris
            'contract_id' => null,
        ];
    }
}
