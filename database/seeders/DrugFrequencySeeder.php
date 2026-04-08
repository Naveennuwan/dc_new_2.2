<?php

namespace Database\Seeders;

use App\Models\DrugFrequency;
use Illuminate\Database\Seeder;

class DrugFrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DrugFrequency::create(['id' => 1, 'name' => 'daily', 'quantity' => 1.00, 'isDisplay' => 1, 'created_by' => 1]);
        DrugFrequency::create(['id' => 2, 'name' => 'nocte', 'quantity' => 1.00, 'isDisplay' => 1, 'created_by' => 1]);
        DrugFrequency::create(['id' => 3, 'name' => 'mane', 'quantity' => 1.00, 'isDisplay' => 1, 'created_by' => 1]);
        DrugFrequency::create(['id' => 4, 'name' => 'bd', 'quantity' => 2.00, 'isDisplay' => 1, 'created_by' => 1]);
        DrugFrequency::create(['id' => 5, 'name' => 'tds', 'quantity' => 3.00, 'isDisplay' => 1, 'created_by' => 1]);
        DrugFrequency::create(['id' => 6, 'name' => 'qds', 'quantity' => 4.00, 'isDisplay' => 1, 'created_by' => 1]);
    }
}
