<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doctor::create([
            'id' => 1,
            'name' => 'T.S Epa',
            'designation' => 'Dental Aesthetic & Cosmatic surgeon',
            'base_hospital' => 'Walasmulla',
            'campus' => 'B.D.S.(Peradeniya)',
            'slmc_reg_no' => 'SLMC Reg No: 2823',
            'contact' => '94711649932',
            'isDisplay' => 1,
            'created_by' => 1
            ]
        );
    }
}
