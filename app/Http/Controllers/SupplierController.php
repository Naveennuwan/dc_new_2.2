<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\SupplierDataLayer;
use App\Http\Requests\SupplierRequest;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierDL;
    public function __construct(SupplierDataLayer $supplierDL)
    {
        $this->supplierDL = $supplierDL;
        // $this->middleware('permission:supplier-access');
        // $this->middleware('permission:supplier-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:supplier-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:supplier-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->supplierDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.supplier.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.supplier.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->supplierDL->insert($request);
            return redirect()->route('supplier.index')->with('success', trans('general.form.flash.created', ['name' => $dataObj->name]));
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function show($id)
    {
        try {
            $dataObj = $this->supplierDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.supplier.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->supplierDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.supplier.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->supplierDL->update($request, $id);
            return redirect()->route('supplier.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->supplierDL->delete($id);
            return redirect()->route('supplier.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->supplierDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.supplier.index')->with($params);
    }
}
