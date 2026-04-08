<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientNextVisit extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'patient_id',
        'next_date',
        'time',
        'isDisplay',
        'created_by',
        'updated_by',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
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
