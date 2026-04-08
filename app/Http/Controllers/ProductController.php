<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\ProductDataLayer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Exports\ExportCsv;
use App\Http\DataLayer\CategoryDataLayer;
use App\Http\DataLayer\BrandDataLayer;
use App\Http\DataLayer\SupplierDataLayer;
use App\Http\DataLayer\ProductTypeDataLayer;

class ProductController extends Controller
{
    protected $productDL;
    protected $categoryDL;
    protected $brandDL;
    protected $supplierDL;
    protected $productTypeDL;

    public function __construct(ProductDataLayer $productDL, CategoryDataLayer $categoryDL, BrandDataLayer $brandDL, SupplierDataLayer $supplierDL, ProductTypeDataLayer $productTypeDL)
    {
        $this->productDL = $productDL;
        $this->categoryDL = $categoryDL;
        $this->brandDL = $brandDL;
        $this->supplierDL = $supplierDL;
        $this->productTypeDL = $productTypeDL;
        // $this->middleware('permission:product-access');
        // $this->middleware('permission:product-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:product-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:product-delete', ['only' => ['show', 'delete']]);
    }

    public function index()
    {
        $dataObj = $this->productDL->getAll();
        $productTypeObj = $this->productTypeDL->getAllActive();
        $searchingVals = null;
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $searchingVals,
            'productTypeObj' => $productTypeObj,
        ];
        return view('pages.product.index')->with($params);
    }

    public function search(Request $request)
    {
        $constraints = [
            'id' => $request['search_id'],
            'name' => $request['search_name'],
            'product_type_id' => $request['product_type_id'],
            'isDisplay' => $request['search_display'],
        ];

        $dataObj = $this->productDL->doSearchingQuery($constraints);
        $productTypeObj = $this->productTypeDL->getAllActive();

        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
            'productTypeObj' => $productTypeObj,
        ];
        return view('pages.product.index')->with($params);
    }

    public function export(Request $request)
    {
        $export_path = public_path("csv_export");
        $fileName = "Product_" . date('Ymd_His') . ".xlsx";

        $selected_ids = $request->check_id;

        if ($selected_ids === null || empty($selected_ids)) {
            return redirect()->back()->with('error', 'No records selected for export.');
        }

        if (!is_dir($export_path)) {
            mkdir($export_path, 0777, true);
        }

        $roleListExport = new ExportCsv($selected_ids);
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $roleListExport->exportProduct($filePath);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }

    public function create()
    {
        try {
            $productObj = null;
            $brandObj = $this->brandDL->getAllActive();
            $categoryObj = $this->categoryDL->getAllActive();
            $productTypeObj = $this->productTypeDL->getAllActive();
            $supplierObj = $this->supplierDL->getAllActive();
            $params = [
                'productObj'  => $productObj,
                'brandObj'   => $brandObj,
                'categoryObj' => $categoryObj,
                'productTypeObj' => $productTypeObj,
                'supplierObj' => $supplierObj,
            ];
            return view('pages.product.create')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function store(Request $request)
    {
        try {
            $dataObj = $this->productDL->insert($request);
            return redirect()->route('product.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function show($id)
    {
        try {
            $dataObj = $this->productDL->getById($id);
            $brandObj = $this->brandDL->getAllActive();
            $categoryObj = $this->categoryDL->getAllActive();
            $productTypeObj = $this->productTypeDL->getAllActive();
            $supplierObj = $this->supplierDL->getAllActive();
            $params = [
                'dataObj' => $dataObj,
                'brandObj'   => $brandObj,
                'categoryObj' => $categoryObj,
                'productTypeObj' => $productTypeObj,
                'supplierObj' => $supplierObj,
            ];
            return view('pages.product.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function edit($id)
    {
        try {
            $dataObj = $this->productDL->getById($id);
            $brandObj = $this->brandDL->getAllActive();
            $categoryObj = $this->categoryDL->getAllActive();
            $productTypeObj = $this->productTypeDL->getAllActive();
            $supplierObj = $this->supplierDL->getAllActive();
            $params = [
                'dataObj'  => $dataObj,
                'brandObj'   => $brandObj,
                'categoryObj' => $categoryObj,
                'productTypeObj' => $productTypeObj,
                'supplierObj' => $supplierObj,
            ];
            return view('pages.product.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->productDL->update($request, $id);
            return redirect()->route('product.index')->with('success', 'Updated Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function destroy($id)
    {
        try {
            $dataObj = $this->productDL->delete($id);
            return redirect()->route('product.index')->with('success', 'Deleted Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function deleteOtherImage($dataId, $imageIndex)
    {
        $this->productDL->otherImageDelete($dataId, $imageIndex);
        return response()->json(['message' => 'Image deleted successfully']);
    }
}
