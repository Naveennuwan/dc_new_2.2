<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\DoctorDataLayer;
use App\Http\DataLayer\LeaveDataLayer;
use App\Http\DataLayer\PatientDataLayer;
use App\Http\DataLayer\LeaveRequestDataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Services\Exports;

class LeaveController extends Controller
{
    protected $doctorDL;
    protected $leaveDL;
    protected $patientDL;
    protected $leaveRequestDL;
    public function __construct(PatientDataLayer $patientDL, DoctorDataLayer $doctorDL, LeaveDataLayer $leaveDL, LeaveRequestDataLayer $leaveRequestDL)
    {
        $this->doctorDL = $doctorDL;
        $this->leaveDL = $leaveDL;
        $this->patientDL = $patientDL;
        $this->leaveRequestDL = $leaveRequestDL;
        // $this->middleware('permission:leave-certificates-access');
        // $this->middleware('permission:leave-certificates-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:leave-certificates-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:leave-certificates-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $dataObj = $this->leaveDL->getActiveAll();
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
        return view('pages.leave.index')->with($params);
    }
    
    public function create()
    {
        try {
            $doctorObj = $this->doctorDL->getAllActive();
            $patientObj = $this->patientDL->getAllActive();
            $leaveRequestObj = $this->leaveRequestDL->getAllActive();
            $params = [
                'patientObj' => $patientObj,
                'leaveRequestObj' => $leaveRequestObj,
                'doctorObj' => $doctorObj
            ];
            return view('pages.leave.create')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->leaveDL->insert($request);
            return redirect()->route('leave.index')->with('success', 'Created Successfully '. $dataObj->name);
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
            $dataObj = $this->leaveDL->getById($id);
            $leaveRequestObj = $this->leaveRequestDL->getAllActive();
            $params = [
                'dataObj' => $dataObj,
                'patientObj' => $patientObj,
                'doctorObj' => $doctorObj,
                'leaveRequestObj' => $leaveRequestObj
            ];
            return view('pages.leave.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->leaveDL->delete($id);
            return redirect()->route('leave.index')->with('success', 'Deleted Successfully Leave Certificates');
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

        $dataObj = $this->leaveDL->doSearchingQuery($constraints);
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.leave.index')->with($params);
    }

    public function report($leave_Report_id)
    {
        $dataObj = $this->leaveDL->getById($leave_Report_id);

        $export_path = public_path("pdf_export");
        $fileName = "Leave_Report_" . $leave_Report_id . ".pdf";
        
        if (!is_dir($export_path)) {
            mkdir($export_path, 0777, true);
        }

        $Exports = new Exports($fileName, $export_path);
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $Exports->leaveReport($dataObj);

        return Response::download($filePath)->deleteFileAfterSend(true);
    }
}
