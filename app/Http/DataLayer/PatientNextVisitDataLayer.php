<?php

namespace App\Http\DataLayer;

use App\Models\PatientNextVisit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class PatientNextVisitDataLayer
{
    public function getAll()
    {
        return PatientNextVisit::where('next_date', '>=', Carbon::now()->format('Y-m-d'))
        ->orderBy('id', 'DESC')->get()->isEmpty() ? [] : 
        PatientNextVisit::where('next_date', '>=', Carbon::now()->format('Y-m-d'))
        ->orderBy('id', 'DESC')->get();
    }

    public function getById($id)
    {
        return $id === null ? null : PatientNextVisit::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = PatientNextVisit::create([
                'patient_id' => trim(intval($request['patient_id'])),
                'next_date' => Carbon::parse(trim($request->input('next_date'))),
                'time' => !empty($request->input('time')) ? Carbon::createFromFormat('H:i', trim($request->input('time')))->format('H:i:s') : null,
                'isDisplay' => 1,
                'center_id' => Auth::user()->center_id,
                'created_by' => Auth::user()->id,
            ]);
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
            Log::error('Error deleting PatientNextVisit : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = PatientNextVisit::query()->orderBy('id', 'DESC');
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
