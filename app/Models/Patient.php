<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
        'id' => 'integer',
        'patient_type_id' => 'integer',
        'center_id' => 'integer',
        'created_by' => 'integer',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name',
        'patient_register_id',
        'patient_nic_no',
        'patient_incharge',
        'patient_address',
        'patient_contact_no',
        'patient_gender',
        'patient_age',
        'patient_type_id',
        'orthodontice_plan_id',
        'patient_center_id',
        'isDisplay',
        'isNewPrice',
        'created_by',
        'updated_by',
    ];

    public function patientType()
    {
        return $this->belongsTo(PatientType::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class, 'patient_center_id');
    }

    public function orthodonticPlanType()
    {
        return $this->belongsTo(OrthodonticPlan::class, 'orthodontice_plan_id');
    }

    public function alergies()
    {
        return $this->hasMany(PatientAlergy::class);
    }

    public function disease()
    {
        return $this->hasMany(PatientDisease::class);
    }
    
    public function parent()
    {
        return $this->belongsTo(Patient::class, 'parent_patient_id');
    }
    
    public function children()
    {
        return $this->hasMany(Patient::class, 'parent_patient_id');
    }
    
    public function userCreateInfo()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function userUpdateInfo()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}