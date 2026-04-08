<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\TemplateTypesDataLayer;
use App\Http\Requests\TemplateTypesRequest;
use Illuminate\Http\Request;

class TemplateTypesController extends Controller
{
    protected $templateTypeDL;
    public function __construct(TemplateTypesDataLayer $templateTypeDL)
    {
        $this->templateTypeDL = $templateTypeDL;
        // $this->middleware('permission:template-type-access');
        // $this->middleware('permission:template-type-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:template-type-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:template-type-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->templateTypeDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.template_type.index')->with($params);
    }
    
    public function create()
    {
        try {
            return view('pages.template_type.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->templateTypeDL->insert($request);
            return redirect()->route('template-type.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->templateTypeDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.template_type.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->templateTypeDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.template_type.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->templateTypeDL->update($request, $id);
            return redirect()->route('template-type.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->templateTypeDL->delete($id);
            return redirect()->route('template-type.index')->with('success', 'Deleted Successfully '. $dataObj->name);
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

        $dataObj = $this->templateTypeDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.template_type.index')->with($params);
    }
}
