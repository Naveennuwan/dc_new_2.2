<?php

namespace App\Http\DataLayer;

use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class DoctorDataLayer
{
    public function getAll()
    {
        return Doctor::orderBy('id', 'DESC')->get()->isEmpty() ? [] : Doctor::orderBy('id', 'DESC')->get();
    }

    public function getAllActive()
    {
        return Doctor::where('isDisplay', true)
        ->orderBy('id', 'DESC')
        ->get()
        ->isEmpty() ? [] : Doctor::where('isDisplay', true)
        ->orderBy('id', 'DESC')
        ->get();
    }

    public function getById($id)
    {
        return $id === null ? null : Doctor::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = Doctor::create([
                'name' => trim($request->input('name')),
                'designation' => trim($request->input('designation')),
                'base_hospital' => trim($request->input('base_hospital')),
                'campus' => trim($request->input('campus')),
                'slmc_reg_no' => trim($request->input('slmc_reg_no')),
                'contact' => trim($request->input('contact')),
                'isDisplay' => trim(intval($request->input('isDisplay'))) ? 1 : 0,
                'created_by' => Auth::user()->id,
            ]);
            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error inserting Doctor : ' . $exception->getMessage());
            return null;
        }
    }

    public function update($request, $id)
    {
        try {
            $dataObj = $this->getById($id);
            $dataObj->name = trim($request->input('name'));
            $dataObj->designation = trim($request->input('designation'));
            $dataObj->base_hospital = trim($request->input('base_hospital'));
            $dataObj->campus = trim($request->input('campus'));
            $dataObj->slmc_reg_no = trim($request->input('slmc_reg_no'));
            $dataObj->contact = trim($request->input('contact'));
            $dataObj->isDisplay = trim(intval($request->input('isDisplay'))) ? 1 : 0;

            $dataObj->updated_by =  Auth::user()->id;
            $dataObj->save();

            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error updating Doctor : ' . $exception->getMessage());
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
            Log::error('Error deleting Doctor : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = Doctor::query()->orderBy('id', 'DESC');
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
            case 'name':
                $query->where($field, 'like', '%' . trim($constraint) . '%');
                break;
            case 'isDisplay':
                $query->where($field, '=', trim($constraint));
                break;
        }
    }
}
