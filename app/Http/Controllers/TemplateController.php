<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\TemplateDataLayer;
use App\Http\DataLayer\TemplateTypesDataLayer;
use App\Http\DataLayer\TemplateCategoryDataLayer;
use App\Http\DataLayer\ProductDataLayer;
use App\Http\DataLayer\LaboratoryExpenseDataLayer;
use App\Http\DataLayer\DrugFrequencyDataLayer;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    protected $templateDL;
    protected $productDL;
    protected $templateTypeDL;
    protected $templateCategoryDL;
    protected $laboratoryExpenseDL;
    protected $drugFrequencyDL;
    public function __construct(TemplateDataLayer $templateDL,ProductDataLayer $productDL, TemplateTypesDataLayer $templateTypeDL, TemplateCategoryDataLayer $templateCategoryDL, LaboratoryExpenseDataLayer $laboratoryExpenseDL, DrugFrequencyDataLayer $drugFrequencyDL)
    {
        $this->templateDL = $templateDL;
        $this->laboratoryExpenseDL = $laboratoryExpenseDL;
        $this->productDL = $productDL;
        $this->templateTypeDL = $templateTypeDL;
        $this->templateCategoryDL = $templateCategoryDL;
        $this->drugFrequencyDL = $drugFrequencyDL;
        // $this->middleware('permission:template-access');
        // $this->middleware('permission:template-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:template-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:template-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->templateDL->getAll();
        $templateCategoryObj = $this->templateCategoryDL->getAllActive();
        $constraints = [
            'name' => null,
            'template_category_id' => 1,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
            'templateCategoryObj' => $templateCategoryObj,
        ];
        return view('pages.template.index')->with($params);
    }
    
    public function create()
    {
        try {
            $productObj = $this->productDL->getAllActive();
            $templateTypeObj = $this->templateTypeDL->getAllActive();
            $templateCategoryObj = $this->templateCategoryDL->getAllActive();
            $laboratoryExpenseObj = $this->laboratoryExpenseDL->getAllActive();
            $drugFrequencyObj = $this->drugFrequencyDL->getAllActive();
            $params = [
                'dataObj'  => null,
                'dataBodyObj' => [],
                'dataLabObj' => [],
                'productObj'  => $productObj,
                'templateTypeObj'   => $templateTypeObj,
                'templateCategoryObj' => $templateCategoryObj,
                'laboratoryExpenseObj' => $laboratoryExpenseObj,
                'drugFrequencyObj' => $drugFrequencyObj,
            ];
            return view('pages.template.create')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->templateDL->insert($request);
            return redirect()->route('template.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->templateDL->getById($id);
            $dataPriceObj = $this->templateDL->getAllPrice($id);
            $dataBodyObj = $this->templateDL->getAllBodies($id);
            $dataLabObj = $this->templateDL->getAllLabs($id);
            $productObj = $this->productDL->getAllActive();
            $templateTypeObj = $this->templateTypeDL->getAllActive();
            $templateCategoryObj = $this->templateCategoryDL->getAllActive();
            $laboratoryExpenseObj = $this->laboratoryExpenseDL->getAllActive();
            $drugFrequencyObj = $this->drugFrequencyDL->getAllActive();
            $params = [
                'dataObj'  => $dataObj,
                'dataPriceObj' => $dataPriceObj,
                'dataBodyObj' => $dataBodyObj,
                'dataLabObj' => $dataLabObj,
                'productObj'  => $productObj,
                'templateTypeObj'   => $templateTypeObj,
                'templateCategoryObj' => $templateCategoryObj,
                'laboratoryExpenseObj' => $laboratoryExpenseObj,
                'drugFrequencyObj' => $drugFrequencyObj,
            ];
            return view('pages.template.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->templateDL->getById($id);
            $dataPriceObj = $this->templateDL->getAllPrice($id);
            $dataBodyObj = $this->templateDL->getAllBodies($id);
            $dataLabObj = $this->templateDL->getAllLabs($id);
            $productObj = $this->productDL->getAllActive();
            $templateTypeObj = $this->templateTypeDL->getAllActive();
            $templateCategoryObj = $this->templateCategoryDL->getAllActive();
            $laboratoryExpenseObj = $this->laboratoryExpenseDL->getAllActive();
            $drugFrequencyObj = $this->drugFrequencyDL->getAllActive();
            $params = [
                'dataObj'  => $dataObj,
                'dataPriceObj' => $dataPriceObj,
                'dataBodyObj' => $dataBodyObj,
                'dataLabObj' => $dataLabObj,
                'productObj'  => $productObj,
                'templateTypeObj'   => $templateTypeObj,
                'templateCategoryObj' => $templateCategoryObj,
                'laboratoryExpenseObj' => $laboratoryExpenseObj,
                'drugFrequencyObj' => $drugFrequencyObj,
            ];
            // dd($dataBodyObj);
            return view('pages.template.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $dataObj = $this->templateDL->update($request, $id);
            // dd($dataObj);
            return redirect()->route('template.index')->with('success', 'Updated Successfully ');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->templateDL->delete($id);
            return redirect()->route('template.index')->with('success', 'Deleted Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function search(Request $request)
    {
        $templateCategoryObj = $this->templateCategoryDL->getAllActive();
        $constraints = [
            'id' => $request['search_id'],
            'template_category_id' => $request['template_category_id'],
            'name' => $request['search_name'],
            'isDisplay' => $request['search_display'],
        ];

        $dataObj = $this->templateDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
            'templateCategoryObj' => $templateCategoryObj,
        ];
        return view('pages.template.index')->with($params);
    }
}
