<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaboratoryExpense;
use App\Models\User;
use Illuminate\Support\Carbon;


class LaboratoryExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();

        if (!$user) {
            $this->command->warn('No users found. LaboratoryExpenseSeeder skipped.');
            return;
        }

        $now = Carbon::parse('2024-06-10 10:07:57');

        $data = [
            [1, 'laboratory-expenses', 0],
            [2, 'Upper/Lower Patial Denture- 1 teeth', 1500],
            [3, 'upper/ lower patial denture 2 teeth', 1800],
            [4, 'upper/lower patial denture 3 teeth', 2100],
            [5, 'upper/ lower patial denture 4 teeth', 2400],
            [6, 'upper/ lower patial denture 5 teeth', 3000],
            [7, 'upper/ lower patial denture 6 teeth', 3400],
            [8, 'upper/ lower patial denture 7 teeth', 3800],
            [9, 'upper/ lower patial denture 8 teeth', 4200],
            [10, 'upper/ lower patial denture 9 teeth', 4600],
            [11, 'upper/ lower patial denture 10 teeth', 5000],
            [12, 'upper/ lower patial denture 11 teeth', 5000],
            [13, 'upper/ lower patial denture 12 teeth', 5000],
            [14, 'upper/ lower patial denture 13 teeth', 5000],
            [15, 'upper/ lower patial denture full teeth', 5000],
            [16, 'crown & bridge 1 wing', 1500],
            [17, 'crown & bridge 2 wing', 3000],
            [18, 'crown & bridge 3 wing', 4500],
            [19, 'crown & bridge 4 wing', 6000],
            [20, 'crown & bridge 1 unite', 5000],
            [21, 'crown & bridge 2 unite', 10000],
            [22, 'crown & bridge 3 unite', 15000],
            [23, 'crown & bridge 4 unite', 20000],
            [24, 'upper / lower mettle denture 1 teeth', 9400],
            [25, 'upper / lower mettle denture 2 teeth', 10000],
            [26, 'upper / lower mettle denture 3 teeth', 10600],
            [27, 'upper / lower mettle 3 teeth', 10600],
            [28, 'upper / lower mettle denture 4 teeth', 11200],
            [29, 'upper / lower mettle denture 5 teeth', 11800],
            [30, 'upper / lower mettle denture 6 teeth', 12400],
            [31, 'upper / lower mettle denture 7 teeth', 13000],
            [32, 'upper / lower mettle denture 8 teeth', 13000],
            [33, 'upper / lower mettle denture 9 teeth', 13000],
            [34, 'upper / lower mettle denture 10 teeth', 13000],
            [35, 'upper / lower mettle denture 11 teeth', 13000],
            [36, 'upper / lower mettle denture 12 teeth', 13000],
            [37, 'upper / lower mettle denture 13 teeth', 13000],
            [38, 'upper / lower mettle denture full teeth', 13000],
        ];

        foreach ($data as $index => [$id, $name, $price]) {
            LaboratoryExpense::create([
                'id'       => $id,
                'name'       => $name,
                'price'      => $price,
                'isDisplay'  => true,
                'created_by' => $user->id,
                'updated_by' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
