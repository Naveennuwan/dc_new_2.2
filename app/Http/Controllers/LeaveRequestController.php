<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\LeaveRequestDataLayer;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    protected $leaveRequestDL;
    public function __construct(LeaveRequestDataLayer $leaveRequestDL)
    {
        $this->leaveRequestDL = $leaveRequestDL;
        // $this->middleware('permission:leave-request-access');
        // $this->middleware('permission:leave-request-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:leave-request-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:leave-request-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->leaveRequestDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.leave_request.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.leave_request.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->leaveRequestDL->insert($request);
            return redirect()->route('leave-request.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->leaveRequestDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.leave_request.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->leaveRequestDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.leave_request.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->leaveRequestDL->update($request, $id);
            return redirect()->route('leave-request.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->leaveRequestDL->delete($id);
            return redirect()->route('leave-request.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->leaveRequestDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.leave_request.index')->with($params);
    }
}
