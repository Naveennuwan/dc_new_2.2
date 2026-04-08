<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\CategoryDataLayer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Exports\ExportCsv;

class CategoryController extends Controller
{
    protected $categoryDL;
    public function __construct(CategoryDataLayer $categoryDL)
    {
        $this->categoryDL = $categoryDL;
        // $this->middleware('permission:category-access');
        // $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:category-delete', ['only' => ['show', 'delete']]);
    }

    public function index()
    {
        $dataObj = $this->categoryDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.category.index')->with($params);
    }

    public function search(Request $request)
    {
        $constraints = [
            'id' => $request['search_id'],
            'name' => $request['search_name'],
        ];

        $dataObj = $this->categoryDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.category.index')->with($params);
    }

    public function export(Request $request)
    {
        $export_path = public_path("csv_export");

        $selected_ids = $request->check_id;

        if ($selected_ids === null || empty($selected_ids)) {
            return redirect()->back()->with('error', 'No records selected for Print.');
        }

        if (!is_dir($export_path)) {
            mkdir($export_path, 0777, true);
        }

        $roleListExport = new ExportCsv($selected_ids);
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $roleListExport->exportCategory($filePath);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }

    public function create()
    {
        try {
            return view('pages.category.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function store(Request $request)
    {
        try {
            $dataObj = $this->categoryDL->insert($request); 
            return redirect()->route('category.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function show($id)
    {
        try {
            $dataObj = $this->categoryDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.category.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function edit($id)
    {
        try {
            $dataObj = $this->categoryDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.category.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->categoryDL->update($request, $id);
            return redirect()->route('category.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function destroy($id)
    {
        try {
            $dataObj = $this->categoryDL->delete($id);
            return redirect()->route('category.index')->with('success', 'Deleted Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    protected function validationRules(Request $request, $id = null)
    {

        $rules = [
            'categories_name' => 'required',
        ];

        $messages = [
            'categories_name' => [
                'required' => 'Category Name is empty',
            ],
        ];

        $request->validate($rules, $messages);
    }
}
