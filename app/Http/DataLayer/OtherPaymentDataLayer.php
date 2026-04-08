<?php

namespace App\Http\DataLayer;

use App\Models\OtherPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OtherPaymentDataLayer
{
    public function getAll()
    {
        return OtherPayment::orderBy('id', 'DESC')->get()->isEmpty() ? [] : OtherPayment::orderBy('id', 'DESC')->get();
    }
    
    public function getById($id)
    {
        return $id === null ? null : OtherPayment::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = OtherPayment::create([
                'patient_id' => trim(intval($request['patient_id'])),
                'payment' => trim($request['payment']) !== '' ? trim($request['payment']) : trim($request['payment']),
                'payment_type' => trim($request['payment_type']),
                'isSettled' => trim(intval($request['isSettled'])) ? 1 : 0,
                'center_id' => Auth::user()->center_id,
                'created_by' => Auth::user()->id,
            ]);
            
            return $dataObj;
        } catch (QueryException $exception) {
            return null;
        }
    }

    public function update($patientId)
    {
        try {
            $dataObj = OtherPayment::where('patient_id', $patientId)
                ->update(['isSettled' => true, 'updated_by' => Auth::user()->id]);
                
            dd( $dataObj);

            return $dataObj;
        } catch (QueryException $exception) {
            return null;
        }
    }
    
    public function PatientSettle($patientId)
    {
        try {
            $updated = OtherPayment::where('patient_id', $patientId)
            ->update([
                'isSettled' => true,
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]);

            return;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
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
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = OtherPayment::query()->orderBy('id', 'DESC');
        foreach ($constraints as $field => $constraint) {
            if ($constraint !== null) {
                $this->applyConstraint($query, $field, $constraint);
            }
        }
        return $query->get();
    }

    public function applyConstraint($query, $field, $constraint)
    {
        switch ($field) {
            case 'id':
                $query->where('id', '=', trim($constraint));
                break;
            case 'center_id':
                $query->where($field, '=', trim($constraint));
                break;
            case 'patient_id':
                $query->where($field, '=', trim($constraint));
                break;
            case 'isSettled':
                $query->where($field, '=', trim($constraint));
                break;
            case 'payment_type':
                $query->where($field, '=', trim($constraint));
                break;
        }
    }

    public function getTodayPayments()
    {
        try {
            $todayOtherPayments = OtherPayment::whereDate('created_at', Carbon::today())
                ->where('center_id', Auth::user()->center_id)
                ->with('patient')
                ->orderBy('id', 'DESC')
                ->get();

                return $todayOtherPayments;
        } catch (QueryException $exception) {
            Log::error('Error getting today OtherPayments: ' . $exception->getMessage());
            return collect();
        }
    }

    public function monthlyOtherPayments($monthStart,$monthEnd)
    {
        try {
            $todayOtherPayments = OtherPayment::whereBetween('created_at',[$monthStart,$monthEnd])
                ->where('center_id', Auth::user()->center_id)
                ->orderBy('id', 'DESC')
                ->get();
                // dd( Carbon::today(),$todayOtherPayments);

                return $todayOtherPayments;
        } catch (QueryException $exception) {
            Log::error('Error getting today OtherPayments: ' . $exception->getMessage());
            return collect();
        }
    }
}
