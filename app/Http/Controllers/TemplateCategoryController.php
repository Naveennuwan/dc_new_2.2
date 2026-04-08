<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\TemplateCategoryDataLayer;
use Illuminate\Http\Request;

class TemplateCategoryController extends Controller
{
    protected $templateCategoryDL;
    public function __construct(TemplateCategoryDataLayer $templateCategoryDL)
    {
        $this->templateCategoryDL = $templateCategoryDL;
        // $this->middleware('permission:template-category-access');
        // $this->middleware('permission:template-category-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:template-category-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:template-category-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->templateCategoryDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.template_category.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.template_category.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->templateCategoryDL->insert($request);
            return redirect()->route('template-category.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->templateCategoryDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.template_category.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->templateCategoryDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.template_category.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->templateCategoryDL->update($request, $id);
            return redirect()->route('template-category.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->templateCategoryDL->delete($id);
            return redirect()->route('template-category.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->templateCategoryDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.template_category.index')->with($params);
    }
}
