<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TemplateHeader;
use App\Models\TemplateBody;
use App\Models\TemplateLaboratorItems;
use App\Models\TemplatePriceLevel;
use App\Models\User;
use Illuminate\Support\Carbon;

class TemplateHeaderSeeder extends Seeder
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

        $now = Carbon::parse('2023-06-14 00:00:00');

        $data = [
            [
                'id' => 6,
                'name' => 'LCC Permanant A3',
                'name_si' => 'ස්ථිර පිරවුම3',
                'price' => 3000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 7,
                'name' => 'LCC permanant Anterior',
                'name_si' => 'ස්ථිර පිරවුම4',
                'price' => 3500.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 8,
                'name' => 'Scaling & Polishing permanant',
                'name_si' => 'දත් සුද්ද කිරීම හා පොලිෂ් කිරීම /ස්ථීර',
                'price' => 3500.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 9,
                'name' => 'Scaling & Polishing Deciduous',
                'name_si' => 'දත් සුද්ද කිරීම හා පොලිෂ් කිරීම /කිරිදත්',
                'price' => 3000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 11,
                'name' => 'Scaling Betel Mild',
                'name_si' => 'දත් සුද්ද කිරීම 1',
                'price' => 6000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 12,
                'name' => 'Scaling Betel Moderate',
                'name_si' => 'දත් සුද්ද කිරීම 2',
                'price' => 7000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 13,
                'name' => 'Scaling Betel Heavy',
                'name_si' => 'දත් සුද්ද කිරීම 3',
                'price' => 8000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 14,
                'name' => 'Extraction Permanant',
                'name_si' => 'දත් ගැලවීම ස්ථීර 1',
                'price' => 1000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 17,
                'name' => 'Extraction Deciduous',
                'name_si' => 'දත් ගැලවීම කිරි දත් 1',
                'price' => 1000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 18,
                'name' => 'Extraction Overetain',
                'name_si' => 'දත් ගැලවීම කිරි දත් 2',
                'price' => 800.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 19,
                'name' => 'IOPA Radiograph',
                'name_si' => 'එක්ස් කිරණ ඡායාරූප',
                'price' => 1000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 25,
                'name' => 'Extraction Surgical mild',
                'name_si' => 'දත් ඉවත් කිරීමේ ශල්‍යකර්ම 1',
                'price' => 7000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 26,
                'name' => 'Extraction Surgical Moderate',
                'name_si' => 'දත් ඉවත් කිරීමේ ශල්‍යකර්ම 2',
                'price' => 8000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 27,
                'name' => 'Extraction Surgical Heavy',
                'name_si' => 'දත් ඉවත් කිරීමේ ශල්‍යකර්ම 3',
                'price' => 9000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 29,
                'name' => 'U/L Partial Denture1 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/1',
                'price' => 4500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 30,
                'name' => 'U/L Partial Denture 2 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/2',
                'price' => 6500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 32,
                'name' => 'U/L Partial Denture 6 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/6',
                'price' => 14500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 33,
                'name' => 'U/L Partial Denture 3 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/3',
                'price' => 8500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 34,
                'name' => 'U/L Partial Denture 5 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/5',
                'price' => 12500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 37,
                'name' => 'U/L Partial Denture 7 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/7',
                'price' => 16500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 38,
                'name' => 'U/L Partial Denture 8 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/8',
                'price' => 18500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 39,
                'name' => 'U/L Partial Denture 9 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/9',
                'price' => 20500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 40,
                'name' => 'U/L Partial Denture 10 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/10',
                'price' => 22500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 42,
                'name' => 'Upper /Lower Full Denture',
                'name_si' => 'කෘතීම දත් ඇදි සම්පුර්ණ',
                'price' => 22500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 43,
                'name' => 'U/L Partial Denture 4 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/4',
                'price' => 10500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 44,
                'name' => '1 unit',
                'name_si' => 'කෘතීම දන්ත කොපු/1',
                'price' => 18000.00,
                'template_category_id' => 1,
                'template_type_id' => 4,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 45,
                'name' => '2 Units',
                'name_si' => 'කෘතීම දන්ත කොපු/2',
                'price' => 36000.00,
                'template_category_id' => 1,
                'template_type_id' => 4,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 46,
                'name' => '3 units',
                'name_si' => 'කෘතීම දන්ත කොපු/3',
                'price' => 54000.00,
                'template_category_id' => 1,
                'template_type_id' => 4,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 47,
                'name' => '1 wing',
                'name_si' => NULL,
                'price' => 5000.00,
                'template_category_id' => 1,
                'template_type_id' => 4,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 48,
                'name' => '2 wings',
                'name_si' => NULL,
                'price' => 10000.00,
                'template_category_id' => 1,
                'template_type_id' => 4,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 49,
                'name' => 'LCC Deciduos A1',
                'name_si' => 'ස්ථීර පිරවීම (කිරි දත්)',
                'price' => 2500.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 50,
                'name' => 'Metal Denture 1 unit',
                'name_si' => 'කෘතීම දත් ඇදි/1',
                'price' => 30000.00,
                'template_category_id' => 1,
                'template_type_id' => 3,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 51,
                'name' => '2 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/2',
                'price' => 32000.00,
                'template_category_id' => 1,
                'template_type_id' => 3,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 52,
                'name' => '3 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/3',
                'price' => 34000.00,
                'template_category_id' => 1,
                'template_type_id' => 3,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 53,
                'name' => '4 teeth',
                'name_si' => 'කෘතීම දත් ඇදි/4',
                'price' => 36000.00,
                'template_category_id' => 1,
                'template_type_id' => 3,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 54,
                'name' => 'Root Canal Treatment Anterior',
                'name_si' => 'ස්නායු පිරවීම 1',
                'price' => 12000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 55,
                'name' => 'Temporary Restoration',
                'name_si' => 'තාවකාලික පිරවීම',
                'price' => 1500.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 56,
                'name' => 'Root Canal Treatment Premolar',
                'name_si' => 'ස්නායු පිරවීම 2',
                'price' => 12000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 57,
                'name' => 'Root canal Treatment Posterior',
                'name_si' => 'ස්නායු පිරවීම 3',
                'price' => 12000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 58,
                'name' => 'Temporary restoration deciduous',
                'name_si' => 'තාවකාලික පිරවීම කිරිදත් 1',
                'price' => 1200.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 59,
                'name' => 'Pulpotomy deciduous',
                'name_si' => 'තාවකාලික පිරවීම කිරිදත් 2',
                'price' => 1200.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 60,
                'name' => 'LCC Permanant Posterior A2',
                'name_si' => 'ස්ථීර පිරවීම 2',
                'price' => 3000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 61,
                'name' => 'LCC permanant Posterior A1',
                'name_si' => 'ස්ථීර පිරවීම 1',
                'price' => 3000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 62,
                'name' => 'Teeth Whitening Normal',
                'name_si' => 'දත් පැහැපත් කිරීම',
                'price' => 30000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 63,
                'name' => '3 wings',
                'name_si' => NULL,
                'price' => 15000.0,
                'template_category_id' => 1,
                'template_type_id' => 4,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 64,
                'name' => '4 wings',
                'name_si' => NULL,
                'price' => 20000.00,
                'template_category_id' => 1,
                'template_type_id' => 4,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 65,
                'name' => 'Consultation',
                'name_si' => NULL,
                'price' => 0.0,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 67,
                'name' => 'Denture Repair 1',
                'name_si' => 'කැඩුණු දත් ඇදි සැකසීම 1',
                'price' => 700.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 68,
                'name' => 'Denture Repair 2',
                'name_si' => 'කැඩුණු දත් ඇදි සැකසීම 2',
                'price' => 1200.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 69,
                'name' => 'Denture Repair 3',
                'name_si' => 'කැඩුණු දත් ඇදි සැකසීම 3',
                'price' => 1500.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 70,
                'name' => 'splintage permanant',
                'name_si' => 'හානියට පත් වූ දත් කම්බි ආධාරයෙන් ස්ථාවරයට පත් කිරී',
                'price' => 6000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 71,
                'name' => 'fluoride Varnish Application',
                'name_si' => 'ෆ්ලෝරයිඩ් වාර්නිෂ් ප්‍රථිකාරය',
                'price' => 2500.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 72,
                'name' => 'Median diastema Correction',
                'name_si' => 'දත් අතර ඇති හිඩැස් සැකසීම',
                'price' => 7000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 73,
                'name' => 'GIC Light Cure',
                'name_si' => 'ස්ථීර පිරවුම/ LC GIC',
                'price' => 2000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 74,
                'name' => 'Surgical Removal Normal',
                'name_si' => NULL,
                'price' => 6000.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 75,
                'name' => 'Post crown PFM',
                'name_si' => 'ඇණයක් මඟින් දත් සැකසීම',
                'price' => 19000.0,
                'template_category_id' => 1,
                'template_type_id' => 4,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 76,
                'name' => 'Crown Cementation',
                'name_si' => 'දන්ත කොපු ඇලවීම',
                'price' => 3000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 77,
                'name' => 'Amalgam Permanent',
                'name_si' => 'ඇමල්ගම් ස්ථීර පිරවුම',
                'price' => 2500.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 81,
                'name' => 'Upper 012 Super elastic',
                'name_si' => NULL,
                'price' => 35.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 82,
                'name' => 'Upper 014 Super elastic',
                'name_si' => NULL,
                'price' => 35.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 83,
                'name' => 'Upper 018 Super elastic',
                'name_si' => NULL,
                'price' => 35.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 84,
                'name' => 'Upper 020 Stainless steel',
                'name_si' => NULL,
                'price' => 35.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 85,
                'name' => 'Upper 16x22 Super elastic',
                'name_si' => NULL,
                'price' => 35.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 86,
                'name' => 'Upper 16x22 stainless steel',
                'name_si' => NULL,
                'price' => 35.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 87,
                'name' => 'Upper 17x25 stainless steel',
                'name_si' => NULL,
                'price' => 35.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 88,
                'name' => 'Upper 17x25 Reverse curve',
                'name_si' => NULL,
                'price' => 450.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 89,
                'name' => 'Upper 17x25 posted arch',
                'name_si' => NULL,
                'price' => 1300.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 90,
                'name' => 'ligature',
                'name_si' => NULL,
                'price' => 30.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1,
                'isDisplay' => 1
            ],
            [
                'id' => 91,
                'name' => 'test template',
                'name_si' => NULL,
                'price' => 2500.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 92,
                'name' => 'Coil spring',
                'name_si' => NULL,
                'price' => 30.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 93,
                'name' => 'Tie wire',
                'name_si' => NULL,
                'price' => 20.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 94,
                'name' => 'Power chain continuous',
                'name_si' => NULL,
                'price' => 10.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 95,
                'name' => 'Power chain long',
                'name_si' => NULL,
                'price' => 10.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 96,
                'name' => 'Lower 012 super elastic',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 97,
                'name' => 'Lower 014 super elastic',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 98,
                'name' => 'Lower 018 super elastic',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 99,
                'name' => 'Lower 020 slainlees steel',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 100,
                'name' => 'Lower 16x22 super elastic',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 101,
                'name' => 'Lower 16x22 stainless steel',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 102,
                'name' => 'Lower 17x25 stainless steel',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 103,
                'name' => 'Lower 17x25 posted arch',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 104,
                'name' => 'Upper bondup',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 105,
                'name' => 'Lower bondup',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 106,
                'name' => 'Lower 17x25 Revers curue',
                'name_si' => NULL,
                'price' => 450.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 107,
                'name' => 'Upper debonding',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 108,
                'name' => 'Lower debonding',
                'name_si' => NULL,
                'price' => 1.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 109,
                'name' => 'Consultation 1',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 110,
                'name' => 'consultation 3',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 111,
                'name' => 'consultation 2',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 112,
                'name' => 'consultation pregnancy',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 113,
                'name' => 'consultation paediatric1',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 114,
                'name' => 'consultation paediatric 2',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 115,
                'name' => 'FMS 1',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 116,
                'name' => 'FMS 3',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 117,
                'name' => 'FMS 2',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 118,
                'name' => 'EXT 01',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 119,
                'name' => 'EXT 2',
                'name_si' => NULL,
                'price' => 0.00,
                'template_category_id' => 3,
                'template_type_id' => NULL,
                'template_center_id' => 1, 
                'isDisplay' => 1
            ],
            [
                'id' => 122,
                'name' => 'Impression and Separators',
                'name_si' => NULL,
                'price' => 220.00,
                'template_category_id' => 2,
                'template_type_id' => NULL,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 123,
                'name' => 'Dental Implant- Dentium Super Lane',
                'name_si' => NULL,
                'price' => 80000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 124,
                'name' => 'Upper Fixed Appliance',
                'name_si' => NULL,
                'price' => 60000.00,
                'template_category_id' => 2,
                'template_type_id' => 1,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 125,
                'name' => 'Upper Fixed Appliance',
                'name_si' => NULL,
                'price' => 60000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 126,
                'name' => 'Root Canal Treatment Posterior 2',
                'name_si' => NULL,
                'price' => 85000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 127,
                'name' => 'Betel very mild',
                'name_si' => NULL,
                'price' => 5000.00,
                'template_category_id' => 1,
                'template_type_id' => NULL,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 128,
                'name' => 'Lower fixed appliance',
                'name_si' => NULL,
                'price' => 60000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 129,
                'name' => 'Scaling very mild',
                'name_si' => NULL,
                'price' => 5000.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 130,
                'name' => 'U/L partial denture 4 teeth',
                'name_si' => NULL,
                'price' => 9100.00,
                'template_category_id' => 1,
                'template_type_id' => 1,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 131,
                'name' => 'U/L Partial Denture',
                'name_si' => NULL,
                'price' => 9100.00,
                'template_category_id' => 1,
                'template_type_id' => 2,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 132,
                'name' => 'U/L Partial Denture 4 teeth',
                'name_si' => NULL,
                'price' => 10500.00,
                'template_category_id' => 1,
                'template_type_id' => 2,NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 133,
                'name' => 'Metal Denture 5 teeth',
                'name_si' => NULL,
                'price' => 26000.00,
                'template_category_id' => 1,
                'template_type_id' => 3,
                'template_center_id' => NULL, 
                'isDisplay' => 1
            ],
            [
                'id' => 134,
                'name' => 'Metal denture U/L Full',
                'name_si' => NULL,
                'price' => 45000.00,
                'template_category_id' => 1,
                'template_type_id' => 3,
                'template_center_id' => NULL,
                'isDisplay' => 1,
            ]
        ];
        
        $bodyGrouped = [
            [
                'template_id' => 1,
                'product_id' => 2,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.05
            ],
            [
                'template_id' => 1,
                'product_id' => 1,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.30
            ],
            [
                'template_id' => 1,
                'product_id' => 3,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.50
            ],
            [
                'template_id' => 2,
                'product_id' => 2,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.05
            ],
            [
                'template_id' => 2,
                'product_id' => 4,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.30
            ],
            [
                'template_id' => 3,
                'product_id' => 1,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.30
            ],
            [
                'template_id' => 3,
                'product_id' => 2,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.05
            ],
            [
                'template_id' => 3,
                'product_id' => 3,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.50
            ],
            [
                'template_id' => 5,
                'product_id' => 4,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.30
            ],
            [
                'template_id' => 5,
                'product_id' => 2,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.05
            ],
            [
                'template_id' => 10,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 10,
                'product_id' => 19,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 15,
                'product_id' => 14,
                'dose' =>  NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 15,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 15,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 3.00
            ],
            [
                'template_id' => 16,
                'product_id' => 17,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 16,
                'product_id' => 16,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 21,
                'product_id' => 9,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 10.00
            ],
            [
                'template_id' => 21,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 70.00
            ],
            [
                'template_id' => 22,
                'product_id' => 9,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 22,
                'product_id' => 11,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 10.00
            ],
            [
                'template_id' => 22,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 8.00
            ],
            [
                'template_id' => 23,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 6.00
            ],
            [
                'template_id' => 23,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 24,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 6.00
            ],
            [
                'template_id' => 24,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 24,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 28,
                'product_id' => 35,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 50.00
            ],
            [
                'template_id' => 28,
                'product_id' => 43,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 50.00
            ],
            [
                'template_id' => 31,
                'product_id' => 36,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 100.00
            ],
            [
                'template_id' => 31,
                'product_id' => 43,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 100.00
            ],
            [
                'template_id' => 31,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 4.00
            ],
            [
                'template_id' => 63,
                'product_id' => 34,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.50
            ],
            [
                'template_id' => 64,
                'product_id' => 34,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 47,
                'product_id' => 34,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.50
            ],
            [
                'template_id' => 48,
                'product_id' => 34,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 17,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 17,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 17,
                'product_id' => 17,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 17,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 3.00
            ],
            [
                'template_id' => 18,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 18,
                'product_id' => 16,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 18,
                'product_id' => 17,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 14,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 14,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 3.00
            ],
            [
                'template_id' => 14,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 14,
                'product_id' => 49,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 25,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 6.00
            ],
            [
                'template_id' => 25,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 25,
                'product_id' => 42,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 10.00
            ],
            [
                'template_id' => 25,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 26,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 6.00
            ],
            [
                'template_id' => 26,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 26,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 26,
                'product_id' => 42,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 10.00
            ],
            [
                'template_id' => 19,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 4,
                'product_id' => 1,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.30
            ],
            [
                'template_id' => 4,
                'product_id' => 2,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.05
            ],
            [
                'template_id' => 4,
                'product_id' => 3,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.30
            ],
            [
                'template_id' => 4,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 4,
                'product_id' => 53,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.20
            ],
            [
                'template_id' => 20,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 20,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 20,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 3.00
            ],
            [
                'template_id' => 20,
                'product_id' => 25,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 20,
                'product_id' => 22,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 20,
                'product_id' => 19,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.25
            ],
            [
                'template_id' => 57,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 57,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 3.00
            ],
            [
                'template_id' => 57,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 4.00
            ],
            [
                'template_id' => 57,
                'product_id' => 23,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 3.00
            ],
            [
                'template_id' => 57,
                'product_id' => 24,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 57,
                'product_id' => 20,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 57,
                'product_id' => 21,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 57,
                'product_id' => 19,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.20
            ],
            [
                'template_id' => 57,
                'product_id' => 49,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 56,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 56,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 3.00
            ],
            [
                'template_id' => 56,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 4.00
            ],
            [
                'template_id' => 56,
                'product_id' => 23,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 56,
                'product_id' => 20,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 56,
                'product_id' => 19,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.15
            ],
            [
                'template_id' => 56,
                'product_id' => 48,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.40
            ],
            [
                'template_id' => 56,
                'product_id' => 49,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 58,
                'product_id' => 30,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 58,
                'product_id' => 49,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.50
            ],
            [
                'template_id' => 62,
                'product_id' => 57,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 59,
                'product_id' => 50,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.10
            ],
            [
                'template_id' => 59,
                'product_id' => 30,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.50
            ],
            [
                'template_id' => 59,
                'product_id' => 49,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 65,
                'product_id' => 55,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 66,
                'product_id' => 55,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 67,
                'product_id' => 103,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 67,
                'product_id' => 104,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 68,
                'product_id' => 103,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 68,
                'product_id' => 104,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 69,
                'product_id' => 103,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 69,
                'product_id' => 104,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 71,
                'product_id' => 107,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 27,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 6.00
            ],
            [
                'template_id' => 27,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 27,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 27,
                'product_id' => 42,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 15.00
            ],
            [
                'template_id' => 73,
                'product_id' => 108,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.50
            ],
            [
                'template_id' => 73,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 74,
                'product_id' => 8,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 6.00
            ],
            [
                'template_id' => 74,
                'product_id' => 13,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 74,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 74,
                'product_id' => 42,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 15.00
            ],
            [
                'template_id' => 75,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 76,
                'product_id' => 9,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 10.00
            ],
            [
                'template_id' => 78,
                'product_id' => 111,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 79,
                'product_id' => 111,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 79,
                'product_id' => 114,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 80,
                'product_id' => 112,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 81,
                'product_id' => 83,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 82,
                'product_id' => 84,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 83,
                'product_id' => 86,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 84,
                'product_id' => 88,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 85,
                'product_id' => 87,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 86,
                'product_id' => 89,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 87,
                'product_id' => 90,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 88,
                'product_id' => 92,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 89,
                'product_id' => 91,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 90,
                'product_id' => 112,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 91,
                'product_id' => 52,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 91,
                'product_id' => 59,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 92,
                'product_id' => 110,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 5.00
            ],
            [
                'template_id' => 93,
                'product_id' => 109,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 94,
                'product_id' => 111,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 7.00
            ],
            [
                'template_id' => 95,
                'product_id' => 114,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 7.00
            ],
            [
                'template_id' => 96,
                'product_id' => 93,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 97,
                'product_id' => 94,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 98,
                'product_id' => 86,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 99,
                'product_id' => 98,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 100,
                'product_id' =>  97,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 101,
                'product_id' =>  99,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 102,
                'product_id' =>  100,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 103,
                'product_id' =>  101,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 104,
                'product_id' => 40,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 104,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 104,
                'product_id' => 52,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.50
            ],
            [
                'template_id' => 104,
                'product_id' => 2,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.05
            ],
            [
                'template_id' => 105,
                'product_id' => 2,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.05
            ],
            [
                'template_id' => 105,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 105,
                'product_id' => 52,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 0.50
            ],
            [
                'template_id' => 105,
                'product_id' => 40,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 106,
                'product_id' => 102,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 107,
                'product_id' => 9,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 107,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 108,
                'product_id' => 9,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 108,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 109,
                'product_id' => 62,
                'dose' => '500mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 109,
                'product_id' => 61,
                'dose' => '400mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 109,
                'product_id' => 69,
                'dose' => '500mg',
                'frequency_id' => 5,
                'duration' => '2',
                'quantity' => 6.00
            ],
            [
                'template_id' => 109,
                'product_id' => 70,
                'dose' => '20mg',
                'frequency_id' => 4,
                'duration' => '2',
                'quantity' => 4.00
            ],
            [
                'template_id' => 110,
                'product_id' => 63,
                'dose' => '625mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 110,
                'product_id' => 66,
                'dose' => '400mg',
                'frequency_id' => 5,
                'duration' => '2',
                'quantity' => 6.00
            ],
            [
                'template_id' => 110,
                'product_id' => 61,
                'dose' => '400mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 110,
                'product_id' => 70,
                'dose' => '20mg',
                'frequency_id' => 4,
                'duration' => '2',
                'quantity' => 4.00
            ],
            [
                'template_id' => 110,
                'product_id' => 81,
                'dose' => '1g',
                'frequency_id' => 4,
                'duration' => '2',
                'quantity' => 4.00
            ],
            [
                'template_id' => 111,
                'product_id' => 63,
                'dose' => '625mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 111,
                'product_id' => 61,
                'dose' => '400mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 111,
                'product_id' => 66,
                'dose' => '400mg',
                'frequency_id' => 5,
                'duration' => '2',
                'quantity' => 6.00
            ],
            [
                'template_id' => 111,
                'product_id' => 70,
                'dose' => '20mg',
                'frequency_id' => 4,
                'duration' => '2',
                'quantity' => 4.00
            ],
            [
                'template_id' => 112,
                'product_id' => 63,
                'dose' => '625mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 112,
                'product_id' => 81,
                'dose' => '1g',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 113,
                'product_id' => 62,
                'dose' => '125mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 113,
                'product_id' => 61,
                'dose' => '100mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 113,
                'product_id' => 69,
                'dose' => '125mg',
                'frequency_id' => 5,
                'duration' => '2',
                'quantity' => 6.00
            ],
            [
                'template_id' => 114,
                'product_id' => 63,
                'dose' => '375mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 114,
                'product_id' => 61,
                'dose' => '100mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 114,
                'product_id' => 69,
                'dose' => '125mg',
                'frequency_id' => 5,
                'duration' => '2',
                'quantity' => 6.00
            ],
            [
                'template_id' => 115,
                'product_id' => 62,
                'dose' => '500mg',
                'frequency_id' => 5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 115,
                'product_id' => 61,
                'dose' => '400mg',
                'frequency_id' =>  5,
                'duration' => '3',
                'quantity' => 9.00
            ],
            [
                'template_id' => 115,
                'product_id' => 80,
                'dose' => '10ml',
                'frequency_id' => 4,
                'duration' => '14',
                'quantity' => 0.00
            ],
            [
                'template_id' => 116,
                'product_id' => 106,
                'dose' => '10ml',
                'frequency_id' => 4,
                'duration' => '14',
                'quantity' => 0.00
            ],
            [
                'template_id' => 116,
                'product_id' => 75,
                'dose' => 'LOA',
                'frequency_id' => 5,
                'duration' => '14',
                'quantity' => 0.00
            ],
            [
                'template_id' => 117,
                'product_id' => 105,
                'dose' => '100mg',
                'frequency_id' => 2,
                'duration' => '14',
                'quantity' => 0.00
            ],
            [
                'template_id' => 117,
                'product_id' => 73,
                'dose' => '10ml',
                'frequency_id' => 4,
                'duration' => '14',
                'quantity' => 0.00
            ],
            [
                'template_id' => 117,
                'product_id' => 75,
                'dose' => 'LOA',
                'frequency_id' => 5,
                'duration' => '14',
                'quantity' => 0.00
            ],
            [
                'template_id' => 118,
                'product_id' => 62,
                'dose' => '500mg',
                'frequency_id' => 5,
                'duration' => '3days',
                'quantity' => 9.00
            ],
            [
                'template_id' => 118,
                'product_id' => 61,
                'dose' => '400mg',
                'frequency_id' => 5,
                'duration' => '3days',
                'quantity' => 9.00
            ],
            [
                'template_id' => 119,
                'product_id' => 62,
                'dose' => '250mg',
                'frequency_id' => 5,
                'duration' => '3days',
                'quantity' => 9.00
            ],
            [
                'template_id' => 119,
                'product_id' => 61,
                'dose' => '200mg',
                'frequency_id' => 5,
                'duration' => '3days',
                'quantity' => 9.00
            ],
            [
                'template_id' => 122,
                'product_id' => 36,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 100.00
            ],
            [
                'template_id' => 122,
                'product_id' => 43,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 50.00
            ],
            [
                'template_id' => 122,
                'product_id' => 14,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00
            ],
            [
                'template_id' => 122,
                'product_id' => 115,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 4.00
            ],
            [
                'template_id' => 124,
                'product_id' => 118,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 125,
                'product_id' => 116,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 1.00
            ],
            [
                'template_id' => 126,
                'product_id' => 21,
                'dose' => NULL,
                'frequency_id' => NULL,
                'duration' => NULL,
                'quantity' => 2.00]
            //2351
        ];

        $labGrouped = [
            [
                'template_id' => 63,
                'laboratory_id' => 18,
                'quantity' => 1.00
            ],
            [
                'template_id' => 64, 
                'laboratory_id' => 19,
                'quantity' => 1.00
            ],
            [
                'template_id' => 47, 
                'laboratory_id' => 16,
                'quantity' => 1.00
            ],
            [
                'template_id' => 48, 
                'laboratory_id' => 17,
                'quantity' => 1.00
            ],
            [
                'template_id' => 17,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 18,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 14,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 25,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 26,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 19,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 4,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 20,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 57,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 56,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 58,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 62,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 59,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 66,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 27,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 75, 
                'laboratory_id' => 20,
                'quantity' => 1.00
            ],
            [
                'template_id' => 78,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 79,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 80,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 81,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 82,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 83,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 84,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 85,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 86,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 87,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 88,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 89,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 90,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 92,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 93,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 94,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 95,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 96,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 97,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 98,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 99,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 100,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 101,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 102,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 103,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 104,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 105,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 106,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 107,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 108,
                'laboratory_id' => 1,
                'quantity' => 1.00
            ],
            [
                'template_id' => 125,
                'laboratory_id' => 1,
                'quantity' => 1.00]
        ];

        $bodyGrouped = collect($bodyGrouped)->groupBy('template_id');
        $labGrouped  = collect($labGrouped)->groupBy('template_id');

        foreach ($data as $headerRow) {

            $templateId = $headerRow['id'];

            TemplateHeader::create([
                'id'                   => $templateId,
                'name'                 => $headerRow['name'],
                'name_si'              => $headerRow['name_si'],
                'template_category_id' => $headerRow['template_category_id'],
                'template_type_id'     => $headerRow['template_type_id'],
                'template_center_id'   => $headerRow['template_center_id'] ?? 1,
                'isDisplay'            => $headerRow['isDisplay'] ?? 1,
                'created_by'           => $user->id,
                'updated_by'           => null,
                'created_at'           => $now,
                'updated_at'           => $now,
            ]);

            TemplatePriceLevel::create([
                'template_id'   => $templateId,
                'price'         => $headerRow['price'],
                'effective_from'=> $now,
                'is_active'     => 1,
            ]);
            
            if ($bodyGrouped->has($templateId)) {

                $insertBody = $bodyGrouped[$templateId]
                    ->map(function ($row) use ($now) {
                        return [
                            'template_id'  => $row['template_id'],
                            'product_id'   => $row['product_id'],
                            'dose'         => $row['dose'],
                            'duration'     => $row['duration'],
                            'frequency_id' => $row['frequency_id'],
                            'quantity'     => $row['quantity'],
                        ];
                    })
                    ->toArray();

                TemplateBody::insert($insertBody);
            }
            
            if ($labGrouped->has($templateId)) {

                $insertLab = $labGrouped[$templateId]
                    ->map(function ($row) use ($now) {
                        return [
                            'template_id'   => $row['template_id'],
                            'laboratory_id' => $row['laboratory_id'],
                            'quantity'      => $row['quantity'],
                        ];
                    })
                    ->toArray();

                TemplateLaboratorItems::insert($insertLab);
            }
        }
    }
}
