<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\LaboratoryExpenseDataLayer;
use App\Http\Requests\LaboratoryExpensRequest;
use Illuminate\Http\Request;

class LaboratoryExpenseController extends Controller
{
    protected $laboratoryExpenseDL;
    public function __construct(LaboratoryExpenseDataLayer $laboratoryExpenseDL)
    {
        $this->laboratoryExpenseDL = $laboratoryExpenseDL;
        // $this->middleware('permission:laboratory-expense-access');
        // $this->middleware('permission:laboratory-expense-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:laboratory-expense-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:laboratory-expense-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->laboratoryExpenseDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.laboratory_expense.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.laboratory_expense.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->laboratoryExpenseDL->insert($request);
            return redirect()->route('laboratory-expense.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->laboratoryExpenseDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.laboratory_expense.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->laboratoryExpenseDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.laboratory_expense.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->laboratoryExpenseDL->update($request, $id);
            return redirect()->route('laboratory-expense.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->laboratoryExpenseDL->delete($id);
            return redirect()->route('laboratory-expense.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->laboratoryExpenseDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.laboratory_expense.index')->with($params);
    }
}
