<?php

namespace Database\Seeders;

use App\Models\Contract;
use App\Models\ContractCustomerDevice;
use App\Models\Customer;
use App\Models\Device;
use App\Models\DeviceSupply;
use App\Models\EuropeanNorm;
use App\Models\Guarantee;
use App\Models\Installation;
use App\Models\Intervention;
use App\Models\InterventionUser;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\RenewalContract;
use App\Models\RenewalGuarantee;
use App\Models\Role;
use App\Models\Sale;
use App\Models\Supply;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Customer::factory(5)->create();
        Role::factory(1)->create();
        User::factory(2)->create();
        Type::factory(4)->create();
        Installation::factory(4)->create();
        EuropeanNorm::factory(2)->create();
        Contract::factory(3)->create();
        DB::table('devices')->insert([
            'serialNumber' => 'aer',
            'productReference' => 'ert',
            'saleDate' => '2021-01-01',
            'installation_id' => 1,
            'type_id' => 4,
            'customer_id' => 4,
            'europeanNorm_id' => 1,
            'contract_id' => 1,
        ]);
        DB::table('devices')->insert([
            'serialNumber' => 'rge',
            'productReference' => 'ghyy',
            'saleDate' => '2020-02-01',
            'installation_id' => 2,
            'type_id' => 1,
            'customer_id' => 3,
            'europeanNorm_id' => 2,
            'contract_id' => 1,
        ]);
        DB::table('devices')->insert([
            'serialNumber' => 'ujujf',
            'productReference' => 'ezaerery',
            'saleDate' => '2020-06-03',
            'installation_id' => 3,
            'type_id' => 4,
            'customer_id' => 4,
            'europeanNorm_id' => null,
            'contract_id' => 2,
        ]);
        DB::table('devices')->insert([
            'serialNumber' => 'yhyhtrget',
            'productReference' => 'ertgrthrhttj',
            'saleDate' => '2021-12-12',
            'installation_id' => 4,
            'type_id' => 2,
            'customer_id' => 1,
            'europeanNorm_id' => null,
            'contract_id' => 3,
        ]);
        Device::factory(50)->create();
        Intervention::factory(40)->create();
        InterventionUser::factory(40)->create();
        Guarantee::factory(3)->create();
        RenewalGuarantee::factory(2)->create();
        RenewalContract::factory(3)->create();
        DB::table('contract_customer_device')->insert([
            'device_id' => 1,
            'customer_id' => 4,
            'contract_id' => 1,
        ]);
        DB::table('contract_customer_device')->insert([
            'device_id' => 2,
            'customer_id' => 3,
            'contract_id' => 1,
        ]);
        DB::table('contract_customer_device')->insert([
            'device_id' => 3,
            'customer_id' => 4,
            'contract_id' => 2,
        ]);
        DB::table('contract_customer_device')->insert([
            'device_id' => 4,
            'customer_id' => 1,
            'contract_id' => 3,
        ]);
        Sale::factory(15)->create();
        Supply::factory(20)->create();
        Provider::factory(30)->create();
        Purchase::factory(25)->create();
        DeviceSupply::factory(10)->create();
    }
}
