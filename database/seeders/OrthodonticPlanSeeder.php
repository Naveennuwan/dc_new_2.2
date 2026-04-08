<?php

namespace Database\Seeders;

use App\Models\OrthodonticPlan;
use Illuminate\Database\Seeder;

class OrthodonticPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrthodonticPlan::create(['id' => 1, 'name' => 'Upper Fixed', 'price' => 60000.00, 'isDisplay' => 1, 'created_by' => 1]);
            OrthodonticPlan::create(['id' => 2, 'name' => 'Upper & Lower Fixed', 'price' => 120000.00, 'isDisplay' => 1, 'created_by' => 1]);
            OrthodonticPlan::create(['id' => 3, 'name' => 'Upper Fixed Transparent', 'price' => 65000.00, 'isDisplay' => 1, 'created_by' => 1]);
            OrthodonticPlan::create(['id' => 4, 'name' => 'Upper & Lower fixed Transparent', 'price' => 130000.00, 'isDisplay' => 1, 'created_by' => 1]);
            OrthodonticPlan::create(['id' => 5, 'name' => 'URA', 'price' => 20000.00, 'isDisplay' => 1, 'created_by' => 1]);
            OrthodonticPlan::create(['id' => 6, 'name' => 'URA with Expansion', 'price' => 30000.00, 'isDisplay' => 1, 'created_by' => 1]);
            OrthodonticPlan::create(['id' => 7, 'name' => 'Rapid Palatal Expansion', 'price' => 35000.00, 'isDisplay' => 1, 'created_by' => 1]);
        
    }
}
