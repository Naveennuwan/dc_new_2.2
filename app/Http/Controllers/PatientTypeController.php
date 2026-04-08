<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\PatientTypeDataLayer;
use App\Http\Requests\PatientTypeRequest;
use Illuminate\Http\Request;

class PatientTypeController extends Controller
{
    protected $patientTypeDL;
    public function __construct(PatientTypeDataLayer $patientTypeDL)
    {
        $this->patientTypeDL = $patientTypeDL;
        // $this->middleware('permission:patient-type-access');
        // $this->middleware('permission:patient-type-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:patient-type-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:patient-type-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->patientTypeDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.patient_type.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.patient_type.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->patientTypeDL->insert($request);
            return redirect()->route('patient-type.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->patientTypeDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.patient_type.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->patientTypeDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.patient_type.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->patientTypeDL->update($request, $id);
            return redirect()->route('patient-type.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->patientTypeDL->delete($id);
            return redirect()->route('patient-type.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->patientTypeDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.patient_type.index')->with($params);
    }
}
