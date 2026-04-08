<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\DiseaseDataLayer;
use App\Http\Requests\DiseaseRequest;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    protected $diseaseDL;
    public function __construct(DiseaseDataLayer $diseaseDL)
    {
        $this->diseaseDL = $diseaseDL;
        // $this->middleware('permission:disease-access');
        // $this->middleware('permission:disease-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:disease-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:disease-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->diseaseDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.disease.index')->with($params);
    }
    
    public function create()
    {
        try {
            
            return view('pages.disease.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $diseaseObj = $this->diseaseDL->insert($request);
            return redirect()->route('disease.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->diseaseDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.disease.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->diseaseDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.disease.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->diseaseDL->update($request, $id);
            return redirect()->route('disease.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->diseaseDL->delete($id);
            return redirect()->route('disease.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->diseaseDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.disease.index')->with($params);
    }
}
