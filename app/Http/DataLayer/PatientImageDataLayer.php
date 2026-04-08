<?php

namespace App\Http\DataLayer;

use App\Models\PatientImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use App\Services\Whatsapp;

class PatientImageDataLayer
{
    public function getAll()
    {
        return PatientImage::orderBy('id', 'DESC')->get()->isEmpty() ? [] : PatientImage::orderBy('id', 'DESC')->get();
    }

    public function getAllActive($patientId)
    {
        return PatientImage::where('deleted_at', NULL)
        ->where('patient_id', $patientId)
        ->get()
        ->isEmpty() ? [] : PatientImage::where('deleted_at', NULL)
        ->where('patient_id', $patientId)
        ->get();
    }

    public function getById($id)
    {
        return $id === null ? null : PatientImage::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $newMainImageName = null;
            
            if ($request->hasFile('patient_image')) {
                $newMainImageName = Str::random(12) . '.' . $request->patient_image->extension();
                $request->patient_image->move(public_path('images/patient_images/'.$request['patient_id']), $newMainImageName);
            }

            $dataObj = PatientImage::create([
                'patient_id' => trim(intval($request['patient_id'])),
                'image' => $newMainImageName,
                'isDisplay' => 1,
                'center_id' => Auth::user()->center_id,
                'created_by' => Auth::user()->id,
            ]);

            return $dataObj;
        } catch (QueryException $exception) {
            return null;
        }
    }

    public function update($request, $id)
    {
        try {
            $dataObj = $this->getById($id);
            $dataObj->name = trim($request->input('name'));
            $dataObj->isDisplay = trim(intval($request->input('isDisplay'))) ? 1 : 0;

            $dataObj->updated_by =  Auth::user()->id;
            $dataObj->save();

            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error updating PatientImage : ' . $exception->getMessage());
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
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = PatientImage::query()->orderBy('id', 'DESC');
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
