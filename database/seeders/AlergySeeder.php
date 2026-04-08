<?php

namespace Database\Seeders;

use App\Models\Alergy;
use Illuminate\Database\Seeder;

class AlergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Alergy::create(['id' => 1, 'name' => 'Alergy 1', 'isDisplay' => 1, 'created_by' => 1]);
        Alergy::create(['id' => 2, 'name' => 'skin 2', 'isDisplay' => 1, 'created_by' => 1]);
        Alergy::create(['id' => 3, 'name' => 'eye', 'isDisplay' => 1, 'created_by' => 1]);
        Alergy::create(['id' => 4, 'name' => 'Penicillin', 'isDisplay' => 1, 'created_by' => 1]);
        Alergy::create(['id' => 5, 'name' => 'Brufen', 'isDisplay' => 1, 'created_by' => 1]);
        Alergy::create(['id' => 6, 'name' => 'Cloxacillin', 'isDisplay' => 1, 'created_by' => 1]);
        Alergy::create(['id' => 7, 'name' => 'PCM', 'isDisplay' => 1, 'created_by' => 1]);
        Alergy::create(['id' => 8, 'name' => 'Diclofinac', 'isDisplay' => 1, 'created_by' => 1]);
        Alergy::create(['id' => 9, 'name' => 'Cefuroxime', 'isDisplay' => 1, 'created_by' => 1]);
    }
}
