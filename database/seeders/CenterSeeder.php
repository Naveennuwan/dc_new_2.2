<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Center::create([
            'id' => 1,
            'name' => 'Weeraketiya',
            'name_sin' => 'වීරකැටිය',
            'address_01' => 'No. 31, Rajapaksha Bulding',
            'address_01_sin' => 'අංක 31, රාජපක්ෂ ගොඩනැගිල්ල',
            'address_02' => 'Tangalla Rd, Weeraketiya',
            'address_02_sin' => 'තංගල්ල පාර, වීරකැටිය',
            'contact_no' => '+94 70 5000 100',
            'week_days' => 'Monday - Friday',
            'week_days_sin' => 'සඳුදා - සිකුරාදා',
            'week_day_service_time' => '04.00 pm - 06.30 pm',
            'week_day_service_time_sin' => 'ප.ව.04.00 - ප.ව.06.30',
            'week_ends' => 'Saturday & Sunday',
            'week_ends_sin' => 'සෙනසුරාදා සහ ඉරිදා',
            'week_ends_service_time' => '01.00 pm - 06.00 pm',
            'week_ends_service_time_sin' => 'ප.ව. 01.00 - ප.ව. 06.00',
            'isDisplay' => 1,
            'created_by' => 1,
            'updated_by' => null,
            'created_at' => '2024-01-28 08:28:11',
            'updated_at' => '2024-01-28 08:28:11',
            'deleted_at' => null,
        ]);

        Center::create([
            'id' => 2,
            'name' => 'Middeniya',
            'name_sin' => 'මිද්දෙනිය',
            'address_01' => 'In front of bus stand',
            'address_01_sin' => 'බස් නැවතුම ඉදිරිපිට',
            'address_02' => 'Near the roundabout',
            'address_02_sin' => 'වටරවුම අසල',
            'contact_no' => '+94 70 5000 100',
            'week_days' => 'Monday - Friday',
            'week_days_sin' => 'සඳුදා - සිකුරාදා',
            'week_day_service_time' => '04.00 pm - 06.30 pm',
            'week_day_service_time_sin' => 'ප.ව.04.00 - ප.ව.06.30',
            'week_ends' => 'Saturday & Sunday',
            'week_ends_sin' => 'සෙනසුරාදා සහ ඉරිදා',
            'week_ends_service_time' => '01.00 pm - 06.00 pm',
            'week_ends_service_time_sin' => 'ප.ව. 01.00 - ප.ව. 06.00',
            'isDisplay' => 1,
            'created_by' => 1,
            'updated_by' => null,
            'created_at' => null,
            'updated_at' => null,
            'deleted_at' => null,
        ]);

        User::where('id', 1)->update(['center_id' => 1]);
        User::where('id', 2)->update(['center_id' => 2]);
        User::where('id', 3)->update(['center_id' => 1]);
        User::where('id', 4)->update(['center_id' => 2]);
        User::where('id', 5)->update(['center_id' => 1]);
        User::where('id', 6)->update(['center_id' => 1]);
        User::where('id', 7)->update(['center_id' => 2]);

    }
}
