<?php

namespace App\Http\DataLayer;

use App\Models\ProductType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class ProductTypeDataLayer
{
    public function getAll()
    {
        return ProductType::orderBy('id', 'DESC')->get()->isEmpty() ? [] : ProductType::orderBy('id', 'DESC')->get();
    }

    public function getAllActive()
    {
        return ProductType::where('isDisplay', true)
        ->orderBy('id', 'DESC')
        ->get()
        ->isEmpty() ? [] : ProductType::where('isDisplay', true)
        ->orderBy('id', 'DESC')
        ->get();
    }

    public function getById($id)
    {
        return $id === null ? null : ProductType::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = ProductType::create([
                'name' => trim($request->input('name')),
                'isDisplay' => trim(intval($request->input('isDisplay'))) ? 1 : 0,
                'created_by' => Auth::user()->id,
            ]);
            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error inserting Product Type : ' . $exception->getMessage());
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
            Log::error('Error updating Product Type : ' . $exception->getMessage());
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
            Log::error('Error deleting Product Type : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = ProductType::query()->orderBy('id', 'DESC');
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
            $data = ProductType::withTrashed()->max('id');
            return $data ?? 0;
        } catch (QueryException $exception) {
            Log::error('Error getLastId Product Type : ' . $exception->getMessage());
            return null;
        }
    }
}
