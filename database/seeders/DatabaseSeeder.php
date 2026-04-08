<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(CenterSeeder::class);
        $this->call(DoctorSeeder::class);
        $this->call(DrugFrequencySeeder::class);
        $this->call(LaboratoryExpenseSeeder::class);
        $this->call(LeaveRequestSeeder::class);
        $this->call(OrthodonticPlanSeeder::class);
        
        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(ProductSeeder::class);
        
        $this->call(TemplateCategorySeeder::class);
        $this->call(TemplateTypeSeeder::class);
        $this->call(TemplateHeaderSeeder::class);
        
        $this->call(AlergySeeder::class);
        $this->call(DiseaseSeeder::class);
        $this->call(PatientTypeSeeder::class);
        $this->call(PatientSeeder::class);
        $this->call(PatientAlergiesAndDiseasesSeeder::class);
        $this->call(PatientImagesSeeder::class);
        $this->call(PatientNextVisitSeeder::class);

        $this->call(SaveTemplateSeeder::class);
        $this->call(OtherPaymentSeeder::class);
    }
}
