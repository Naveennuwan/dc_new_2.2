<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::create(['id' => 1, 'name' => 'SS Dental Pharma', 'contact' => '07777806991', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 2, 'name' => 'Boxit', 'contact' => '0774487476', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 3, 'name' => 'La solve', 'contact' => '0714742393', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 4, 'name' => 'NN Enterprises Nuwan', 'contact' => '0777551064', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 5, 'name' => 'Yu And Company', 'contact' => '0778758009', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 6, 'name' => 'Rajya Osusala Tangalle', 'contact' => '0472241221', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 7, 'name' => 'George Stuart', 'contact' => '0763515769', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 8, 'name' => 'Corsodyl', 'contact' => '1111111111', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 9, 'name' => 'Rexidine', 'contact' => '222222222', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 10, 'name' => 'Aliexpress', 'contact' => '3333333333', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 11, 'name' => 'Oram Kamal', 'contact' => '0776455509', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 12, 'name' => 'India Direct', 'contact' => '0702895656', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 13, 'name' => 'Medident', 'contact' => '0770036076', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 14, 'name' => 'Local Pharmacy', 'contact' => '4444444444', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 15, 'name' => 'Embilipitiya Stores', 'contact' => '0472261500', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 16, 'name' => 'Nazhath', 'contact' => '0702895656', 'isDisplay' => 1, 'created_by' => 1]);
        Supplier::create(['id' => 17, 'name' => 'Win medicare', 'contact' => '5555555555', 'isDisplay' => 1, 'created_by' => 1]);
    }
}
