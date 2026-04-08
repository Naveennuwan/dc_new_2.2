<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\DoctorDataLayer;
use App\Http\Requests\DoctorRequest;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    protected $doctorDL;
    public function __construct(DoctorDataLayer $doctorDL)
    {
        $this->doctorDL = $doctorDL;
        // $this->middleware('permission:doctor-access');
        // $this->middleware('permission:doctor-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:doctor-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:doctor-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->doctorDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.doctor.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.doctor.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->doctorDL->insert($request);
            return redirect()->route('doctor.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->doctorDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.doctor.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->doctorDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.doctor.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->doctorDL->update($request, $id);
            return redirect()->route('doctor.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->doctorDL->delete($id);
            return redirect()->route('doctor.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->doctorDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.doctor.index')->with($params);
    }
}
