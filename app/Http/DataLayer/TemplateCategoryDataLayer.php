<?php

namespace App\Http\DataLayer;

use App\Models\TemplateCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class TemplateCategoryDataLayer
{
    public function getAll()
    {
        return TemplateCategory::orderBy('id', 'DESC')->get()->isEmpty() ? [] : TemplateCategory::orderBy('id', 'DESC')->get();
    }

    public function getAllActive()
    {
        return TemplateCategory::where('isDisplay', true)
        ->orderBy('id', 'DESC')
        ->get()
        ->isEmpty() ? [] : TemplateCategory::where('isDisplay', true)
        ->orderBy('id', 'DESC')
        ->get();
    }

    public function getById($id)
    {
        return $id === null ? null : TemplateCategory::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = TemplateCategory::create([
                'name' => trim($request->input('name')),
                'isDisplay' => trim(intval($request->input('isDisplay'))) ? 1 : 0,
                'created_by' => Auth::user()->id,
            ]);
            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error inserting Template Category : ' . $exception->getMessage());
            return null;
        }
    }

    public function update($request, $id)
    {
        try {
            $dataObj = $this->getById($id);
            $dataObj->name = trim($request->input('name'));
            $dataObj->isDisplay = trim($request->input('isDisplay')) ? 1 : 0;

            $dataObj->updated_by =  Auth::user()->id;
            $dataObj->save();

            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error updating Template Category : ' . $exception->getMessage());
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
            Log::error('Error deleting Template Category : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = TemplateCategory::query()->orderBy('id', 'DESC');
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
            $data = TemplateCategory::withTrashed()->max('id');
            return $data ?? 0;
        } catch (QueryException $exception) {
            Log::error('Error getLastId Template Category : ' . $exception->getMessage());
            return null;
        }
    }
}
