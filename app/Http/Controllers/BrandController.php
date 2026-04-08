<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\BrandDataLayer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class BrandController extends Controller
{
    protected $brandDL;
    public function __construct(BrandDataLayer $brandDL)
    {
        $this->brandDL = $brandDL;
        // $this->middleware('permission:brand-access');
        // $this->middleware('permission:brand-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:brand-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:brand-delete', ['only' => ['show', 'delete']]);
    }

    public function index()
    {
        $dataObj = $this->brandDL->getAll();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.brand.index')->with($params);
    }

    public function search(Request $request)
    {
        $constraints = [
            'id' => $request['search_id'],
            'name' => $request['search_name'],
            'isDisplay' => $request['search_display'],
        ];

        $dataObj = $this->brandDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.brand.index')->with($params);
    }

    public function create()
    {
        try {
            return view('pages.brand.create');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function store(Request $request)
    {
        try {
            $dataObj = $this->brandDL->insert($request);
            return redirect()->route('brand.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function show($id)
    {
        try {
            $dataObj = $this->brandDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.brand.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function edit($id)
    {
        try {
            $dataObj = $this->brandDL->getById($id);
            $params = [
                'dataObj'  => $dataObj,
            ];
            return view('pages.brand.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->brandDL->update($request, $id);
            return redirect()->route('brand.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function destroy($id)
    {
        try {
            $dataObj = $this->brandDL->delete($id);
            return redirect()->route('brand.index')->with('success', 'Deleted Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    protected function validationRules(Request $request, $id = null)
    {

        $rules = [
            'name' => 'required',
        ];

        $messages = [
            'name' => [
                'required' => 'Brand Name is Empty',
                'unique'    => 'Brand Name is already registered',
            ],
        ];

        if ($id) {
            $rules['name'] .= '|unique:brands,name,' . $id;
        } else {
            $rules['name'] .= '|unique:brands,name';
        }

        $request->validate($rules, $messages);
    }
}
