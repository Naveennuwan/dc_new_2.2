<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\DoctorDataLayer;
use App\Http\DataLayer\PatientDataLayer;
use App\Http\DataLayer\MedicalDataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Services\Exports;

class MedicalController extends Controller
{
    protected $doctorDL;
    protected $medicalDL;
    protected $patientDL;
    public function __construct(PatientDataLayer $patientDL, DoctorDataLayer $doctorDL, MedicalDataLayer $medicalDL)
    {
        $this->doctorDL = $doctorDL;
        $this->medicalDL = $medicalDL;
        $this->patientDL = $patientDL;
        // $this->middleware('permission:medicals-access');
        // $this->middleware('permission:medicals-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:medicals-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:medicals-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->medicalDL->getAll();
        $patientObj = $this->patientDL->getAllActive();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
            'patientObj' => $patientObj
        ];
        return view('pages.medical.index')->with($params);
    }
    
    public function create()
    {
        try {
            $doctorObj = $this->doctorDL->getAllActive();
            $patientObj = $this->patientDL->getAllActive();
            $params = [
                'patientObj' => $patientObj,
                'doctorObj' => $doctorObj
            ];
            return view('pages.medical.create')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->medicalDL->insert($request);
            return redirect()->route('medical.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $doctorObj = $this->doctorDL->getAllActive();
            $patientObj = $this->patientDL->getAllActive();
            $dataObj = $this->medicalDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
                'patientObj' => $patientObj,
                'doctorObj' => $doctorObj
            ];
            return view('pages.medical.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->medicalDL->delete($id);
            return redirect()->route('medical.index')->with('success', 'Deleted Successfully medical Certificates');
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

        $dataObj = $this->medicalDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.medical.index')->with($params);
    }

    public function report($medical_Report_id)
    {
        $dataObj = $this->medicalDL->getById($medical_Report_id);

        $export_path = public_path("pdf_export");
        $fileName = "Medical_Report_" . $medical_Report_id . ".pdf";
        
        if (!is_dir($export_path)) {
            mkdir($export_path, 0777, true);
        }

        $Exports = new Exports($fileName, $export_path);
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $Exports->medicalReport($dataObj);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }
}
