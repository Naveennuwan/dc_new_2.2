<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\DrugFrequencyDataLayer;
use App\Http\Requests\DrugFrequencyRequest;
use Illuminate\Http\Request;

class DrugFrequencyController extends Controller
{
    protected $drugFrequencyDL;
    public function __construct(DrugFrequencyDataLayer $drugFrequencyDL)
    {
        $this->drugFrequencyDL = $drugFrequencyDL;
        // $this->middleware('permission:drug-frequency-access');
        // $this->middleware('permission:drug-frequency-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:drug-frequency-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:drug-frequency-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->drugFrequencyDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.drug_frequency.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.drug_frequency.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->drugFrequencyDL->insert($request);
            return redirect()->route('drug-frequency.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    public function show($id)
    {
        try {
            $dataObj = $this->drugFrequencyDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.drug_frequency.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    public function edit($id)
    {
        try {
            $dataObj = $this->drugFrequencyDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.drug_frequency.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->drugFrequencyDL->update($request, $id);
            return redirect()->route('drug-frequency.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    public function destroy($id)
    {
        try {
            $dataObj = $this->drugFrequencyDL->delete($id);
            return redirect()->route('drug-frequency.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->drugFrequencyDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.drug_frequency.index')->with($params);
    }
}
