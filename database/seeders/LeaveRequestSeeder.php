<?php

namespace Database\Seeders;

use App\Models\LeaveRequest;
use Illuminate\Database\Seeder;

class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [1, 'has undergone a surgical extraction of a tooth under local anaesthesia'],
            [2, 'is suffering from servre tooth pain'],
            [3, 'has undergone a implant surgery under local anaethieia'],
            [4, 'Needs orthodontic adjustment of the fixed appliance'],
            [5, 'Needs to undergo a root canal treatment under local anaesthesia'],
            [6, 'Needs to undergo a crown preparation under local anaesthesia'],
            [7, 'Needs to undergo a scaling and polishing procedure'],
            [8, 'Needs to undergo a surgical extraction of a tooth under local anaesthesia'],
            [9, 'Needs to undergo a implant surgery under local anaethieia'],
            [10, 'Needs orthodontic adjustment of the fixed appliance'],
        ];

        foreach ($data as $index => [$id, $name,]) {
            LeaveRequest::create([
                'id'    => $id,
                'name'  => $name,
            ]);
        }
    }
}
