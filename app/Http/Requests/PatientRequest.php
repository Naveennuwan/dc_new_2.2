<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $patientId = $this->route('patient');

        return [
            'name' => 'required|string|max:100',
            'patient_nic_no' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('patients')->ignore($patientId),
            ],
            'patient_incharge' => 'nullable|string|max:100',
            'patient_address' => 'required|string|max:300',
            'patient_contact_no' => [
                'required',
                'string',
                'regex:/^94\d{9}$/',
                // Rule::unique('patients')->where(function ($query) {
                //     return $query->where('name', $this->input('name'));
                // })->ignore($patientId),
            ],
            'patient_gender' => 'required|string|max:300',
            'patient_age' => 'required|integer',
            'patient_type_id' => 'required|exists:patient_types,id',
            'isNewPrice' => 'nullable|boolean',
            'orthodontice_plan_id' => [
                'nullable',
                'exists:orthodontic_plans,id',
                'required_if:patient_type_id,2',
            ],
            'patient_alergies' => 'nullable|array',
            'patient_alergies.*' => 'exists:alergies,id',
        ];
    }

    public function messages()
    {
        return [
            'orthodontice_plan_id.required_if' => 'The orthodontice plan id field is required when registering an orthodontic patient.',
        ];
    }
}

