<?php

namespace Database\Seeders;

use App\Models\TemplateTypes;
use Illuminate\Database\Seeder;

class TemplateTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TemplateTypes::create(['id' => 1, 'name' => 'Treatement Templates', 'isDisplay' => 1, 'created_by' => 1]);
        TemplateTypes::create(['id' => 2, 'name' => 'Upper/Lower Partial Denture', 'isDisplay' => 1, 'created_by' => 1]);
        TemplateTypes::create(['id' => 3, 'name' => 'Metal Denture', 'isDisplay' => 1, 'created_by' => 1]);
        TemplateTypes::create(['id' => 4, 'name' => 'Crown & Bridges', 'isDisplay' => 1, 'created_by' => 1]);
    }
}
