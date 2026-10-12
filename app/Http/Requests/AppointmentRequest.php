<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => 'nullable|exists:patients,id',
            'name' => 'nullable|string|max:255|required_without:patient_id',
            'contact_no' => 'nullable|string|max:15|required_without:patient_id',

            'doctor_id' => 'required|exists:doctors,id',
            'patient_type_id' => 'nullable|exists:patient_types,id|required_without:patient_id',

            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'nullable',

            'remark' => 'nullable|in:next_visit,on_call,riception',

            'status' => 'nullable|in:pending,confirmed,completed,cancelled',

            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [

            // Patient
            'patient_id.exists' => 'Selected patient is invalid.',
            'name.required_without' => 'Please select a patient or enter patient name.',
            'name.max' => 'Patient name cannot exceed 255 characters.',
    
            // Contact
            'contact_no.required_without' => 'Contact number is required.',
            'contact_no.max' => 'Contact number cannot exceed 15 digits.',
    
            // Doctor & Type
            'doctor_id.required' => 'Please select a doctor.',
            'doctor_id.exists' => 'Selected doctor is invalid.',
    
            'patient_type_id.required' => 'Please select a patient type.',
            'patient_type_id.exists' => 'Selected patient type is invalid.',
    
            // Date & Time
            'appointment_date.required' => 'Appointment date is required.',
            'appointment_date.date' => 'Invalid appointment date.',
            'appointment_date.after_or_equal' => 'Appointment must be today or a future date.',
    
            'appointment_time.date_format' => 'Time must be in HH:MM format (e.g., 14:30).',
    
            // Remark
            'remark.in' => 'Invalid remark selected.',
    
            // Status
            'status.in' => 'Invalid status value.',
        ];
    }
}
