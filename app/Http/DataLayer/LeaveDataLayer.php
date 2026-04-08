<?php

namespace App\Http\DataLayer;

use App\Models\Leave;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LeaveDataLayer
{
    public function getAll()
    {
        return Leave::orderBy('id', 'DESC')->get()->isEmpty() ? [] : Leave::orderBy('id', 'DESC')->get();
    }

    public function getActiveAll()
    {
        return Leave::where('deleted_at', NULL)
        ->where('center_id', Auth::user()->center_id)
        ->get()
        ->isEmpty() ? [] : Leave::where('deleted_at', NULL)
        ->where('center_id', Auth::user()->center_id)
        ->get();
    }

    public function getById($id)
    {
        return $id === null ? null : Leave::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = Leave::create([
                'patient_id' => trim(intval($request['patient_id'])),
                'doctor_id' => trim(intval($request['doctor_id'])),
                'from_date' => Carbon::parse(trim($request->input('from_date'))),
                'to_date' => Carbon::parse(trim($request->input('to_date'))),
                'leave_requests_id' => trim(intval($request['leave_requests_id'])),
                'isDisplay' => 1,
                'center_id' => Auth::user()->center_id,
                'created_by' => Auth::user()->id,
            ]);
            
            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error inserting Leave Certificates : ' . $exception->getMessage());
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
            Log::error('Error deleting Leave : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = Leave::query()->orderBy('id', 'DESC');
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
