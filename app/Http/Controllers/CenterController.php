<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\CenterDataLayer;
use App\Http\Requests\CenterRequest;
use Illuminate\Http\Request;

class CenterController extends Controller
{
    protected $centerDL;
    public function __construct(CenterDataLayer $centerDL)
    {
        $this->centerDL = $centerDL;
        // $this->middleware('permission:center-access');
        // $this->middleware('permission:center-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:center-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:center-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->centerDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.center.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.center.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $centerObj = $this->centerDL->insert($request);
            return redirect()->route('center.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->centerDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.center.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->centerDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.center.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->centerDL->update($request, $id);
            return redirect()->route('center.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->centerDL->delete($id);
            return redirect()->route('center.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->centerDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.center.index')->with($params);
    }
}
