<?php

namespace App\Http\DataLayer;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AppointmentDataLayer
{
    public function getAll()
    {
        return Appointment::whereDate('appointment_date', '>=', today())
        ->orderBy('appointment_date')
        ->get();
    }

    public function getById($id)
    {
        return $id === null ? null : Appointment::findOrFail($id);
    }

    public function insert($request)
    {
        // dd($request->all());
        try {
            $dataObj = Appointment::create([
                'patient_id' => $request->filled('patient_id') ? $request->patient_id : null,
                'name' => $request->filled('name') ? $request->name : null,
                'contact_no' => $request->filled('contact_no') ? $request->contact_no : null,
                'doctor_id' => intval($request['doctor_id']),
                'patient_type_id' => intval($request->input('patient_type_id')),
                'center_id' => Auth::user()->center_id,
                'appointment_date' => Carbon::parse(trim($request->input('appointment_date'))),
                'appointment_time' => !empty($request->input('appointment_time'))
                    ? Carbon::createFromFormat('H:i', trim($request->input('appointment_time')))->format('H:i:s')
                    : null,
                'remark' => $request->input('remark', 'riception'),
                'created_by' => Auth::user()->id,
            ]);
            // dd($dataObj);
            return $dataObj;
        } catch (QueryException $exception) {
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $dataObjUpd = $this->getById($id);
            $dataObjUpd->updated_by =  Auth::user()->id;
            $dataObjUpd->save();

            $dataObjDel = $this->getById($id);
            $dataObjDel->delete();

            return $dataObjDel;
        } catch (QueryException $exception) {
            Log::error('Error deleting Appointment : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        return Appointment::query()
    
            ->when(!empty($constraints['search_name']), function ($q) use ($constraints) {
                $q->where('name', 'LIKE', '%' . trim($constraints['search_name']) . '%');
            })
    
            ->when(!empty($constraints['appointment_no']), function ($q) use ($constraints) {
                $q->where('appointment_no', 'LIKE', '%' . trim($constraints['appointment_no']) . '%');
            })
    
            ->when(!empty($constraints['doctor_id']), function ($q) use ($constraints) {
                $q->where('doctor_id', $constraints['doctor_id']);
            })
    
            ->when(!empty($constraints['patient_type_id']), function ($q) use ($constraints) {
                $q->where('patient_type_id', $constraints['patient_type_id']);
            })
    
            ->when(!empty($constraints['center_id']), function ($q) use ($constraints) {
                $q->where('center_id', Auth::user()->id);
            })
    
            ->when(!empty($constraints['appointment_date']), function ($q) use ($constraints) {
                $q->whereDate('appointment_date', $constraints['appointment_date']);
            })
    
            ->when(!empty($constraints['status']), function ($q) use ($constraints) {
                $q->where('status', $constraints['status']);
            })
    
            ->orderBy('appointment_no', 'ASC')
            ->get();
    }

    public function applyConstraint($query, $field, $constraint)
{
    $constraint = trim($constraint);

    if ($constraint === '' || $constraint === null) {
        return;
    }

    switch ($field) {

        case 'search_name':
            $query->where('name', 'LIKE', '%' . $constraint . '%');
            break;

        case 'appointment_no':
            $query->where('appointment_no', 'LIKE', '%' . $constraint . '%');
            break;

        case 'doctor_id':
            $query->where('doctor_id', $constraint);
            break;

        case 'patient_type_id':
            $query->where('patient_type_id', $constraint);
            break;

        case 'appointment_date':
            $query->whereDate('appointment_date', $constraint);
            break;

        case 'status':
            $query->where('status', $constraint);
            break;
    }
}

    public function updateStatus($request, $id)
    {

        $appointment = Appointment::findOrFail($id);

        $appointment->status = $request->status;
        $appointment->save();

        return $appointment;
    }
}
