<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Appointment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'appointment_no',
        'patient_id',
        'name',
        'contact_no',
        'doctor_id',
        'patient_type_id',
        'center_id',
        'appointment_date',
        'appointment_time',
        'remark',
        'status',
        'created_by',
        'updated_by'
    ];

    // ✅ AUTO GENERATE APPOINTMENT NO
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($appointment) {

            // ✅ Step 1: Auto set patient_type_id if patient is selected
            if (!empty($appointment->patient_id) && empty($appointment->patient_type_id)) {

                $patient = \App\Models\Patient::find($appointment->patient_id);

                if ($patient) {
                    $appointment->patient_type_id = $patient->patient_type_id;
                }
            }

            // ❗ Safety check (important)
            if (empty($appointment->patient_type_id)) {
                throw new \Exception('Patient type is required to generate appointment number.');
            }

            // ✅ Step 2: Generate appointment number
            $date = Carbon::parse($appointment->appointment_date)->format('Y-m-d');

            $prefix = match ((int) $appointment->patient_type_id) {
                1 => 'RP', // Returning Patient
                2 => 'OP', // Out Patient
                default => 'UN',
            };

            // ✅ Step 3: Count safely
            $count = Appointment::whereDate('appointment_date', $date)
                ->where('patient_type_id', $appointment->patient_type_id)
                ->lockForUpdate()
                ->count() + 1;

            $number = str_pad($count, 3, '0', STR_PAD_LEFT);

            $appointment->appointment_no = $prefix . $number;
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function patientType()
    {
        return $this->belongsTo(PatientType::class);
    }

    public function center()
    {
        return $this->belongsTo(Center::class);
    }
}
