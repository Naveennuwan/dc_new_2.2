<?php

namespace Database\Seeders;

use App\Models\Disease;
use Illuminate\Database\Seeder;

class DiseaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disease::create(['id' => 1, 'name' => 'Disease', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 2, 'name' => 'allergy', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 3, 'name' => 'flu', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 4, 'name' => 'di', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 5, 'name' => 'Diabetes Millitus', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 6, 'name' => 'Hypertension', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 7, 'name' => 'Anaemia', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 8, 'name' => 'Leukemia', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 9, 'name' => 'Bleeding Disorder', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 10, 'name' => 'Pregnancy', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 11, 'name' => 'Asthma', 'isDisplay' => 1, 'created_by' => 1]);
            Disease::create(['id' => 12, 'name' => 'Epilepsy', 'isDisplay' => 1, 'created_by' => 1]);
    }
}
