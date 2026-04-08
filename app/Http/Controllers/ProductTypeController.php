<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\ProductTypeDataLayer;
use App\Http\Requests\ProductTypeRequest;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    protected $productTypeDL;
    public function __construct(ProductTypeDataLayer $productTypeDL)
    {
        $this->productTypeDL = $productTypeDL;
        // $this->middleware('permission:product-type-access');
        // $this->middleware('permission:product-type-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:product-type-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:product-type-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->productTypeDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.product_type.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.product_type.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->productTypeDL->insert($request);
            return redirect()->route('product-type.index')->with('success', trans('general.form.flash.created', ['name' => $dataObj->name]));
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->productTypeDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.product_type.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->productTypeDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.product_type.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->productTypeDL->update($request, $id);
            return redirect()->route('product-type.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->productTypeDL->delete($id);
            return redirect()->route('product-type.index')->with('success', 'Deleted Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function search(Request $request)
    {
        $constraints = [
            'id' => $request['search_id'],
            'name' => $request['search_name'],
            'isDisplay' => $request['search_display'],
        ];

        $dataObj = $this->productTypeDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.product_type.index')->with($params);
    }
}
