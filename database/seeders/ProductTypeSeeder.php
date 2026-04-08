<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::create(['id' => 1, 'name' => 'Routine Patients Drugs', 'isDisplay' => 1, 'created_by' => 1]);
        ProductType::create(['id' => 2, 'name' => 'Orthodontice Patients Drugs', 'isDisplay' => 1, 'created_by' => 1]);
        ProductType::create(['id' => 3, 'name' => 'Issueing Drugs', 'isDisplay' => 1, 'created_by' => 1]);
        
    }
}
