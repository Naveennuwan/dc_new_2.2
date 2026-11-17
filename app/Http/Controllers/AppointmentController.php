<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\DataLayer\AppointmentDataLayer;
use App\Http\Requests\AppointmentRequest;
use App\Http\DataLayer\CenterDataLayer;
use App\Http\DataLayer\DoctorDataLayer;
use App\Http\DataLayer\PatientDataLayer;
use App\Http\DataLayer\PatientTypeDataLayer;
use App\Services\SmsService;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    protected $appointmentDL;
    protected $doctorDL;
    protected $patientDL;
    protected $patientTypeDL;
    public function __construct(
        AppointmentDataLayer $appointmentDL,
        CenterDataLayer $centerDL,
        DoctorDataLayer $doctorDL,
        PatientDataLayer $patientDL,
        PatientTypeDataLayer $patientTypeDL
        )
    {
        $this->appointmentDL = $appointmentDL;
        $this->centerDL = $centerDL;
        $this->doctorDL = $doctorDL;
        $this->patientDL = $patientDL;
        $this->patientTypeDL = $patientTypeDL;
    }

    public function Send_SMS($to, $text)
    {
        $smsService = new SmsService();
        $smsService->sendAppointmentSms($to,$text);
    }

    public function Send_SMS_to_registeredPatient($to, $text)
    {
        $smsService = new SmsService();
        $smsService->sendSms($to,$text);
    }
    
    public function index()
    {
        $constraints = [
            'search_name'   => null,
            'appointment_date'   => null,
            'center_id' => null,
            'status' => null,
        ];

        $appointmentObj = $this->appointmentDL->doSearchingQuery($constraints);
        $centerObj = $this->centerDL->getAll();
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
            'appointmentObj' => $appointmentObj,
            'centerObj' => $centerObj,
        ];
        return view('pages.appointments.index')->with($params);
    }

    public function create()
    {
        $doctorObj = $this->doctorDL->getAllActive();
        $centerObj = $this->centerDL->getAll();
        $patientObj = $this->patientDL->getAllActive();
        $patientTypeObj = $this->patientTypeDL->getAllActive();

        $params = [
            'doctorObj' => $doctorObj,
            'centerObj' => $centerObj,
            'patientObj' => $patientObj,
            'patientTypeObj' => $patientTypeObj,
        ];

        try {
            return view('pages.appointments.create')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(AppointmentRequest $request)
    {
        try {
            $dataObj = $this->appointmentDL->insert($request);
            
            $appointment_no = $dataObj->appointment_no;
            $contact_no = $dataObj->contact_no;
            $patientName = $dataObj->name;
            $date = Carbon::parse($dataObj->appointment_date)->format('Y-m-d');
            $time = Carbon::parse($dataObj->appointment_time)->format('h:i A');
            
            $timeText = ($time !== null)
            ? " at {$time}"
            : "";
            
            if (is_null($dataObj->patient_id)) {
                $text = "Hi {$patientName}, your appointment {$appointment_no} is confirmed for {$date}{$timeText}. Please arrive 10 mins early.";
                $this->Send_SMS($contact_no, $text);
            }
            else{
                $patientObj = $this->patientDL->getById($dataObj->patient_id);
                $text = "Hi {$patientObj->name}, your appointment {$appointment_no} is confirmed for {$date}{$timeText}. Please arrive 10 mins early.";
                $this->Send_SMS($patientObj->patient_contact_no, $text);
            }
            return redirect()->route('appointment.index')->with('success', 'Created Successfully '. $dataObj->name);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    public function display(Request $request)
    {
        try {
            $constraints = [
                'search_name' => null,
                'appointment_date' => Carbon::today(),
                'search_status' => 'confirmed',
            ];

            
            
            $routineQueue = $this->appointmentDL->doSearchingQuery([
                'search_name' => null,
                'appointment_date' => Carbon::today(),
                'status' => 'confirmed',
                'patient_type_id' => 1,
            ]);

            $orthoQueue = $this->appointmentDL->doSearchingQuery([
                'search_name' => null,
                'appointment_date' => Carbon::today(),
                'status' => 'confirmed',
                'patient_type_id' => 2,
            ]);
            
            $routeCollection = collect($routineQueue);
            $OrthoCollection = collect($orthoQueue);

            $params = [
                'routineOngoing' => $routeCollection->get(0),
                'routineNext'    => $routeCollection->get(1),
                'routineQueue' => $routeCollection->slice(2)->take(5)->values(),
            
                'orthoOngoing' => $OrthoCollection->get(0),
                'orthoNext'    => $OrthoCollection->get(1),
                'orthoQueue' => $OrthoCollection->slice(2)->take(5)->values(),
            ];
            
            return view('pages.appointments.display')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }


    public function show($id)
    {
        try {
            $params = [];
            return view('pages.appointments.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        // dd($id);
        // $dataObj = $this->nextVisitDL->getById($id);
        // $patientObj = $this->appointmentDL->getById($dataObj->patient_id);

        // $text =  "Hi " . $patientObj->name . ", This is a friendly reminder that you have an appointment scheduled for " . $dataObj->next_date . " on " . $dataObj->time . ". we look forward to seeing you";

        // $this->Send_SMS($patientObj->id,$text);

        
        // $patientObj = $this->appointmentDL->getAll();
        // $dataObj = $this->nextVisitDL->getAll();
        // $constraints = [
        //     'name' => null,
        //     'patient_id' => null,
        //     'isDisplay' => "",
        // ];
        
        $params = [
            // 'dataObj'   =>  $dataObj ?? [],
            // 'searchingVals' => $constraints,
            // 'patientObj' => $patientObj
        ];
        return view('pages.appointments.index')->with($params);
    }
    
    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        try {
            return redirect()->ortho('appointments.index')->with('success', 'Successfully Deleted');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function search(Request $request)
    {
        $constraints = [
            'search_name'   => $request->search_name,
            'appointment_date'   => $request->appointment_date,
            'center_id' => $request->center_id,
            'status' => $request->status,
        ];

        $dataObj = $this->appointmentDL->doSearchingQuery($constraints);
        $centerObj = $this->centerDL->getAll();
        
        $params = [
            'appointmentObj'   =>  $dataObj,
            'centerObj' => $centerObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.appointments.index')->with($params);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $dataObj = $this->appointmentDL->updateStatus($request, $id);

        $color = 'success';

        if ($dataObj->status == 'confirmed') {
            $color = 'info';
        }else if ($dataObj->status == 'pending') {
            $color = 'warning';
        }else if ($dataObj->status == 'completed') {
            $color = 'success';
        }else if ($dataObj->status == 'cancelled') {
            $color = 'error';}

        return back()->with($color, 'Status updated successfully')
        ->with('updated_id', $id);
    }
}

