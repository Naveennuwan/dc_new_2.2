<?php

namespace App\Http\DataLayer;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductDataLayer
{
    
    public function getAll()
    {
        return Product::orderBy('id', 'DESC')->get()->isEmpty() ? [] : Product::orderBy('id', 'DESC')->get();
    }

    public function getAllActive()
    {
        return Product::where('isDisplay', true)
        ->orderBy('id', 'DESC')
        ->get()
        ->isEmpty() ? [] : Product::where('isDisplay', true)
        ->orderBy('id', 'DESC')
        ->get();
    }

    public function getById($id)
    {
        return $id === null ? null : Product::findOrFail($id);
    }

    public function insert($request)
    {
        try {
            $dataObj = Product::create([
                'name' => trim($request->input('name')),
                'product_type_id' => trim($request->input('product_type_id')),
                'brand_id' => trim($request->input('brand_id')),
                'category_id' => trim($request->input('category_id')),
                'supplier_id' => trim($request->input('supplier_id')),
                'isDisplay' => trim(intval($request->input('isDisplay'))) ? 1 : 0,
                'created_by' => Auth::user()->id,
            ]);
            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error inserting Product : ' . $exception->getMessage());
            return null;
        }
    }

    public function update($request, $id)
    {
        try {
            $dataObj = $this->getById($id);
            $dataObj->name = trim($request->input('name'));
            $dataObj->product_type_id = trim($request->input('product_type_id'));
            $dataObj->brand_id = trim($request->input('brand_id'));
            $dataObj->category_id = trim($request->input('category_id'));
            $dataObj->supplier_id = trim($request->input('supplier_id'));
            $dataObj->isDisplay = trim(intval($request->input('isDisplay'))) ? 1 : 0;

            $dataObj->updated_by =  Auth::user()->id;
            $dataObj->save();

            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error updating Product : ' . $exception->getMessage());
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
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = Product::query()->orderBy('id', 'DESC');
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
                $query->where($field, 'like', '%' . trim($constraint) . '%');
                break;
            case 'name':
                $query->where($field, 'like', '%' . trim($constraint) . '%');
                break;
            case 'product_type_id':
                $query->where($field, '=', trim($constraint));
                break;
            case 'isDisplay':
                $query->where($field, 'like', '%' . trim($constraint) . '%');
                break;
        }
    }

}
