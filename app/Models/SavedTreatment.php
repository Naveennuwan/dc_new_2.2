<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SavedTreatment extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'patient_id',
        'template_id',
        'doctor_id',
        'center_id',
        'isSettled',
        'isPrint',
        'created_by',
        'updated_by'
    ];
    
    /**
     * Get all payments for this treatment
     */
    public function payments()
    {
        return $this->hasMany(SavedTreatmentPayment::class, 'template_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    
    /**
     * Get the payment sum for this treatment
     */
    public function getTotalPaymentAttribute()
    {
        return $this->payments()->sum('payment');
    }
    
    public function priceLevels()
    {
        return $this->hasMany(TemplatePriceLevel::class, 'template_id', 'template_id');
    }
    
    // Other relationships...
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    
    public function template()
    {
        return $this->belongsTo(TemplateHeader::class, 'template_id');
    }
    
    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
