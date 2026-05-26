<?php

namespace App\Http\DataLayer;

use App\Models\LeaveRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class LeaveRequestDataLayer
{
    public function getAll()
    {
        return LeaveRequest::orderBy('id', 'DESC')->get()->isEmpty() ? [] : LeaveRequest::orderBy('id', 'DESC')->get();
    }

    public function getAllActive()
    {
        return LeaveRequest::where('isDisplay', false)
        ->orderBy('id', 'DESC')
        ->get()
        ->isEmpty() ? [] : LeaveRequest::where('isDisplay', false)
        ->orderBy('id', 'DESC')
        ->get();
    }

    public function getById($id)
    {
        return $id === null ? null : LeaveRequest::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = LeaveRequest::create([
                'name' => trim($request->input('name')),
                'isDisplay' => trim(intval($request->input('isDisplay'))) ? 1 : 0,
                'created_by' => Auth::user()->id,
            ]);
            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error inserting Leave Request : ' . $exception->getMessage());
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
            Log::error('Error updating Leave Request : ' . $exception->getMessage());
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
            Log::error('Error deleting Leave Request : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = LeaveRequest::query()->orderBy('id', 'DESC');
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
            $data = LeaveRequest::withTrashed()->max('id');
            return $data ?? 0;
        } catch (QueryException $exception) {
            Log::error('Error getLastId LeaveRequest : ' . $exception->getMessage());
            return null;
        }
    }
}
