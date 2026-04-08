<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\OrthodonticPlanDataLayer;
use App\Http\Requests\OrthodonticPlanRequest;
use Illuminate\Http\Request;

class OrthodonticPlanController extends Controller
{
    protected $orthodonticPlanDL;
    public function __construct(OrthodonticPlanDataLayer $orthodonticPlanDL)
    {
        $this->orthodonticPlanDL = $orthodonticPlanDL;
        // $this->middleware('permission:orthodontic-plan-access');
        // $this->middleware('permission:orthodontic-plan-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:orthodontic-plan-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:orthodontic-plan-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->orthodonticPlanDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.orthodontic_plan.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.orthodontic_plan.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function store(Request $request)
    {
        try {
            $dataObj = $this->orthodonticPlanDL->insert($request);
            return redirect()->route('orthodontic-plan.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->orthodonticPlanDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.orthodontic_plan.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->orthodonticPlanDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.orthodontic_plan.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->orthodonticPlanDL->update($request, $id);
            return redirect()->route('orthodontic-plan.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->orthodonticPlanDL->delete($id);
            return redirect()->route('orthodontic-plan.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->orthodonticPlanDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.orthodontic_plan.index')->with($params);
    }
}
