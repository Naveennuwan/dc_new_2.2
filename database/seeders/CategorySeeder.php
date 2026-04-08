<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create( ['id' => 1, 'name' => 'Permanant Restoration Material', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 2, 'name' => 'RCT Material', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 3, 'name' => 'Extraction material', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 4, 'name' => 'Temporary Restoration Material', 'isDisplay' => 0, 'created_by' => 1]);
            Category::create( ['id' => 5, 'name' => 'Scaling & Polishing', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 6, 'name' => 'Crown & Bridge', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 7, 'name' => 'Removable Prosthesis', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 8, 'name' => 'Fixed Prosthesis', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 9, 'name' => 'Orthodontic Material', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 10, 'name' => 'Removable & fixed Prosthesis', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 11, 'name' => 'disposible items', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 12, 'name' => 'Temporary Restoration Material', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 13, 'name' => 'Teeth Whitening Material', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 14, 'name' => 'Consultation', 'isDisplay' => 1, 'created_by' => 1]);
            Category::create( ['id' => 15, 'name' => 'Preventive', 'isDisplay' => 1, 'created_by' => 1]);
    }
}
