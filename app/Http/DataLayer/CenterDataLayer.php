<?php

namespace App\Http\DataLayer;

use App\Models\Center;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CenterDataLayer
{
    public function getAll()
    {
        return Center::orderBy('id', 'DESC')->get()->isEmpty() ? [] : Center::orderBy('id', 'DESC')->get();
    }

    public function getById($id)
    {
        return $id === null ? null : Center::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = Center::create([
                'name' => trim($request->input('name')),
                'name_sin' => trim($request->input('name_sin')),
                'address_01' => trim($request->input('address_01')),
                'address_01_sin' => trim($request->input('address_01_sin')),
                'address_02' => trim($request->input('address_02')),
                'address_02_sin' => trim($request->input('address_02_sin')),
                'contact_no' => trim($request->input('contact_no')),
                'week_days' => trim($request->input('week_days')),
                'week_days_sin' => trim($request->input('week_days_sin')),
                'week_day_service_time' => trim($request->input('week_day_service_time')),
                'week_day_service_time_sin' => trim($request->input('week_day_service_time_sin')),
                'week_ends' => trim($request->input('week_ends')),
                'week_ends_sin' => trim($request->input('week_ends_sin')),
                'week_ends_service_time' => trim($request->input('week_ends_service_time')),
                'week_ends_service_time_sin' => trim($request->input('week_ends_service_time_sin')),
                'isDisplay' => boolval($request->input('isDisplay')) ? 1 : 0,
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
            $dataObj->center = trim($request->input('name'));
            $dataObj->address_01 = trim($request->input('address_01'));
            $dataObj->address_02 = trim($request->input('address_02'));
            $dataObj->contact_no = trim($request->input('contact_no'));
            $dataObj->week_days = trim($request->input('week_days'));
            $dataObj->week_day_service_time = trim($request->input('week_day_service_time'));
            $dataObj->week_ends = trim($request->input('week_ends'));
            $dataObj->week_ends_service_time = trim($request->input('week_ends_service_time'));
            $dataObj->isDisplay = trim($request->input('isDisplay')) ? 1 : 0;

            $dataObj->updated_by =  Auth::user()->id;
            $dataObj->save();

            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error updating Center : ' . $exception->getMessage());
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
            Log::error('Error deleting Center : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = Center::query()->orderBy('id', 'DESC');
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

    public function getLastId()
    {
        try {
            $data = Center::withTrashed()->max('id');
            return $data ?? 0;
        } catch (QueryException $exception) {
            Log::error('Error getLastId brand : ' . $exception->getMessage());
            return null;
        }
    }
}
