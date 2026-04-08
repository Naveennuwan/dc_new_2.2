<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\AlergyDataLayer;
use App\Http\Requests\AlergyRequest;
use Illuminate\Http\Request;

class AlergyController extends Controller
{
    protected $alergyDL;
    public function __construct(AlergyDataLayer $alergyDL)
    {
        $this->alergyDL = $alergyDL;
        // $this->middleware('permission:alergy-access');
        // $this->middleware('permission:alergy-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:alergy-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:alergy-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->alergyDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.alergy.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.alergy.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(AlergyRequest $request)
    {
        try {
            $dataObj = $this->alergyDL->insert($request);
            return redirect()->route('alergy.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->alergyDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.alergy.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->alergyDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.alergy.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(AlergyRequest $request, $id)
    {
        try {
            $dataObj = $this->alergyDL->update($request, $id);
            return redirect()->route('alergy.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->alergyDL->delete($id);
            return redirect()->route('alergy.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->alergyDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.alergy.index')->with($params);
    }
}
