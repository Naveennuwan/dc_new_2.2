<?php

namespace Database\Seeders;

use App\Models\TemplateCategory;
use Illuminate\Database\Seeder;

class TemplateCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        TemplateCategory::create(['id' => 1, 'name' => 'Routine Templates', 'isDisplay' => 1, 'created_by' => 1]);
        TemplateCategory::create(['id' => 2, 'name' => 'Orthodontice Templates', 'isDisplay' => 1, 'created_by' => 1]);
        TemplateCategory::create(['id' => 3, 'name' => 'Issueing Templates', 'isDisplay' => 1, 'created_by' => 1]);
        
    }
}
