<?php

namespace App\Http\DataLayer;

use App\Models\Medical;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class MedicalDataLayer
{
    public function getAll()
    {
        return Medical::orderBy('id', 'DESC')->get()->isEmpty() ? [] : Medical::orderBy('id', 'DESC')->get();
    }

    public function getActiveAll()
    {
        return Medical::where('deleted_at', NULL)
        ->where('center_id', Auth::user()->center_id)
        ->get()
        ->isEmpty() ? [] : Medical::where('deleted_at', NULL)
        ->where('center_id', Auth::user()->center_id)
        ->get();
    }

    public function getById($id)
    {
        return $id === null ? null : Medical::with(['patient', 'doctor'])->findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = Medical::create([
                'patient_id' => trim(intval($request['patient_id'])),
                'doctor_id' => trim(intval($request['doctor_id'])),
                'isDisplay' => 1,
                'center_id' => Auth::user()->center_id,
                'created_by' => Auth::user()->id,
            ]);
            
            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error inserting Patient Next Visit : ' . $exception->getMessage());
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
            Log::error('Error deleting Medical : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = Medical::query()->orderBy('id', 'DESC');
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
            case 'patient_id':
                $query->where($field, '=', trim($constraint));
                break;
        }
    }
}
