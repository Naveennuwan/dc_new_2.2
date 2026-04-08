<?php

namespace App\Http\DataLayer;

use App\Models\TemplateHeader;
use App\Models\TemplateBody;
use App\Models\TemplatePriceLevel;
use App\Models\TemplateLaboratorItems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class TemplateDataLayer
{
    public function getAll()
    {
        return TemplateHeader::orderBy('id', 'DESC')->get()->isEmpty() ? [] : TemplateHeader::orderBy('id', 'DESC')->get();
    }

    public function getById($id)
    {
        return $id === null ? null : TemplateHeader::findOrFail($id);
    }

    public function getAllActive()
    {
        return TemplateHeader::where('isDisplay', true)
        ->where('deleted_at', null)
        ->orderBy('id', 'DESC')
        ->get()
        ->isEmpty() ? [] : TemplateHeader::where('isDisplay', true)
        ->where('deleted_at', null)
        ->orderBy('id', 'DESC')
        ->get();
    }

    public function getAllBodies($id)
    {
        return TemplateBody::where('template_id', $id)
        ->get()
        ->isEmpty() ? [] : TemplateBody::where('template_id', $id)
        ->get();
    }

    public function getAllPrice($id)
    {
        return TemplatePriceLevel::where('template_id', $id)
        ->get()
        ->isEmpty() ? [] : TemplatePriceLevel::where('template_id', $id)
        ->get();
    }

    public function getAllLabs($id)
    {
        return TemplateLaboratorItems::where('template_id', $id)
        ->get()
        ->isEmpty() ? [] : TemplateLaboratorItems::where('template_id', $id)
        ->get();
    }

    public function insert($request)
    {
        try {
            $dataObj = TemplateHeader::create([
                'name' => trim($request->input('name')),
                'name_si' => trim($request->input('name_si')) ?? NUll,
                'template_type_id' => trim($request->input('template_type_id')) ? trim($request->input('template_type_id')) : null,
                'template_category_id' => trim($request->input('template_category_id')),
                'isDisplay' => trim(intval($request->input('isDisplay'))) ? 1 : 0,
                'created_by' => Auth::user()->id,
                'center_id' => Auth::user()->center_id,
            ]);

            $priceLevel = TemplatePriceLevel::create([
                'template_id' => $dataObj->id,
                'price' => trim($request->input('price')),
                'effective_from' => $dataObj->created_at,
                'is_active' => 1,
            ]);

            if ($request->has('arr_body_product_id') && $request->has('arr_body_product_qty')) {
                foreach ($request->arr_body_product_id as $key => $value) {
                    if ($request->arr_body_product_id[$key] !== null) {
                        $data = array(
                            'template_id' => $dataObj->id,
                            'product_id' => $request->arr_body_product_id[$key],
                            'quantity' => $request->arr_body_product_qty[$key],
                            'duration' => $request->arr_body_duration[$key],
                            'dose' => $request->arr_body_dose[$key],
                            'frequency_id' => $request->arr_body_frequency_id[$key],
                        );
                        TemplateBody::insert($data);
                    }
                }
            }

            if ($request->has('arr_laboratory_id') && $request->has('arr_laboratory_qty')) {
                foreach ($request->arr_laboratory_id as $key => $value) {
                    if ($request->arr_laboratory_id[$key] !== null) {
                        $data = array(
                            'template_id' => $dataObj->id,
                            'laboratory_id' => $request->arr_laboratory_id[$key],
                            'quantity' => $request->arr_laboratory_qty[$key],
                        );
                        TemplateLaboratorItems::insert($data);
                    }
                }
            }
            
            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error inserting Template : ' . $exception->getMessage());
            return null;
        }
    }

    public function update($request, $id)
    {
        // dd($request);
        try {
            $dataObj = $this->getById($id);
            $dataObj->name = trim($request->input('name'));
            $dataObj->name_si = trim($request->input('name_si'));
            $dataObj->template_type_id = trim($request->input('template_type_id')) ? trim($request->input('template_type_id')) : null;
            $dataObj->template_category_id = trim($request->input('template_category_id'));
            $dataObj->isDisplay = trim($request->input('isDisplay')) ? 1 : 0;

            $dataObj->updated_by =  Auth::user()->id;

            if ($request->has('arr_body_product_id')) {
                $submittedIds = [];
                foreach ($request->arr_body_product_id as $key => $productId) {

                    $rowId = $request->arr_body_row_id[$key];

                    $data = [
                        'template_id'  => $id,
                        'product_id'   => $productId,
                        'quantity'     => $request->arr_body_product_qty[$key],
                        'dose'         => $request->arr_body_dose[$key],
                        'frequency_id' => $request->arr_body_frequency_id[$key],
                    ];

                    if ($rowId != 0) {
                        TemplateBody::where('id', $rowId)->update($data);
                        $submittedIds[] = $rowId;
                    } 
                    else {
                        $newRow = TemplateBody::create($data);
                        $submittedIds[] = $newRow->id;
                    }
                }
                
                TemplateBody::where('template_id', $id)
                    ->whereNotIn('id', $submittedIds)
                    ->delete();
            }

            if ($request->has('arr_laboratory_id')) {
                $submittedIds = [];
                foreach ($request->arr_laboratory_id as $key => $laboratoryId) {

                    if (!$laboratoryId) continue;

                    $rowId = $request->arr_laboratory_row_id[$key] ?? 0;
            
                    $data = [
                        'template_id'   => $id,
                        'laboratory_id' => $laboratoryId,
                        'quantity'      => $request->arr_laboratory_qty[$key] ?? 0,
                    ];
                    
                    if ($rowId != 0) {
                        TemplateLaboratorItems::where('id', $rowId)->update($data);
                        $submittedIds[] = $rowId;
                    }
                    else {
                        $newRow = TemplateLaboratorItems::create($data);
                        $submittedIds[] = $newRow->id;
                    }
                }
                
                TemplateLaboratorItems::where('template_id', $id)
                    ->whereNotIn('id', $submittedIds)
                    ->delete();
            }

            if ($request->has('arr_price_level')) {

                $submittedIds = [];

                foreach ($request->arr_price_level as $key => $price) {
            
                    if (!$price) continue;
            
                    $rowId = $request->arr_price_level_row_id[$key] ?? 0;
            
                    $data = [
                        'template_id'    => $id,
                        'price'          => $price,
                        'effective_from' => $request->arr_price_level_effective_from[$key] ?? null,
                        'is_active'      => $request->arr_price_level_is_active[$key] ?? 0,
                    ];
                    
                    if ($rowId != 0) {
                        TemplatePriceLevel::where('id', $rowId)->update($data);
                        $submittedIds[] = $rowId;
                    }
                    else {
                        $newRow = TemplatePriceLevel::create($data);
                        $submittedIds[] = $newRow->id;
                    }
                }
                
                TemplatePriceLevel::where('template_id', $id)
                    ->whereNotIn('id', $submittedIds)
                    ->delete();
            }

            $dataObj->save();

            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error updating Template : ' . $exception->getMessage());
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
            Log::error('Error deleting Template : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = TemplateHeader::query()->orderBy('id', 'ASC');
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
            case 'template_category_id':
                $query->where($field, '=', trim($constraint));
                break;
            case 'isDisplay':
                $query->where($field, '=', trim($constraint));
                break;
        }
    }

    public function getLastId()
    {
        try {
            $data = TemplateHeader::withTrashed()->max('id');
            return $data ?? 0;
        } catch (QueryException $exception) {
            Log::error('Error getLastId Template : ' . $exception->getMessage());
            return null;
        }
    }
}
