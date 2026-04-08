<?php

namespace Database\Seeders;

use App\Models\PatientType;
use Illuminate\Database\Seeder;

class PatientTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PatientType::create(['id' => 1, 'name' => 'Routine Treatement Patiants', 'isDisplay' => 1, 'created_by' => 1]);
        PatientType::create(['id' => 2, 'name' => 'Orthodontic Treatement Patiants', 'isDisplay' => 1, 'created_by' => 1]);
    }
}
