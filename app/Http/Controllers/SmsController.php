<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\PatientDataLayer;
use App\Http\DataLayer\PatientTypeDataLayer;
use App\Http\DataLayer\PatientImageDataLayer;
use Illuminate\Http\Request;
use App\Services\SmsService;

class SmsController extends Controller
{
    protected $patientDL;
    public function __construct(PatientDataLayer $patientDL,PatientTypeDataLayer $patientTypeDL,PatientImageDataLayer $patientImagesDL)
    {
        $this->patientDL = $patientDL;
        $this->patientImagesDL = $patientImagesDL;
        $this->patientTypeDL = $patientTypeDL;
    }

    public function Send_SMS($to, $text)
    {
        $smsService = new SmsService();
        $smsService->sendSms($to,$text);
    }

    public function index()
    {
        $dataObj = $this->patientDL->getAll();
        $patientTypeObj = $this->patientTypeDL->getAllActive();
        $constraints = [
            'name' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'patientTypeObj'   =>  $patientTypeObj ?? [],
            'searchingVals' => $constraints,
        ];
        return view('pages.sms.index')->with($params);
    }

    public function sendSms(Request $request)
    {
        try {
            $text = $request->sms_text;

            if($request->button_id == "routine-btn"){
                $dataObj = $this->patientDL->getPatientByType(1);
                if($dataObj != null){
                    foreach ($dataObj as $patient) {   
                        if($patient->patient_contact_no != null){
                            if (preg_match('/^94\d{9}$/', $patient->patient_contact_no)) {
                                $this->Send_SMS($patient->id,$text);
                            }
                        }
                    }
                }
                return redirect()->route('sms.index')->with('success', 'SMS sent to all routine patient');
            }

            if($request->button_id == "orthodontic-btn"){
                $dataObj = $this->patientDL->getPatientByType(2);
                if($dataObj != null){
                    foreach ($dataObj as $patient) {   
                        if($patient->patient_contact_no != null){
                            if (preg_match('/^94\d{9}$/', $patient->patient_contact_no)) {
                                $this->Send_SMS($patient->id,$text);
                            }
                        }
                    }
                }
                return redirect()->route('sms.index')->with('success', 'SMS sent to all orthodontic patient');
            }

        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function sendSmsById(Request $request, $patientId)
    {
        try {
            $smsText = $request->query('sms_text');
            
            $patient = $this->patientDL->getById($patientId);
            if($patient != null){
                if($patient->patient_contact_no != null){
                    if (preg_match('/^94\d{9}$/', $patient->patient_contact_no)) {
                        $this->Send_SMS($patient->id,$smsText);
                        return redirect()->route('sms.index')->with('success', 'SMS sent to patient '. $patient->name);
                    }
                }
            }
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function sendImageByIDSms($patientId, $imageId)
    {
        try {
            $dataObj = $this->patientImagesDL->getById($imageId);
            
            $paragraph = "Download your images using the links:\n";
            
            $paragraph .= "images.powersmile.lk/$patientId/{$dataObj->image}\n";
            
            $patient = $this->patientDL->getById($patientId);
            
            if (preg_match('/^94\d{9}$/', $patient->patient_contact_no)) {
                $this->Send_SMS($patient->id,$paragraph);
                return redirect()->route('invoice', ['patient_id' => $patient->id])->with('success', 'Image SMS sent to patient '. $patient->name);
            }
            
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function sendBulkSms($patientId)
    {
        try {
            $dataObj = $this->patientImagesDL->getAllActive( (int) $patientId);
            
            $paragraph = "Download your images using the links:\n";
            
            foreach ($dataObj as $image) {
                $paragraph .= "images.powersmile.lk/$patientId/{$image->image}\n";
            }
            
            $patient = $this->patientDL->getById($patientId);

            
            
            if (preg_match('/^94\d{9}$/', $patient->patient_contact_no)) {
                $this->Send_SMS($patient->id,$paragraph);
                return redirect()->route('invoice', ['patient_id' => $patient->id])->with('success', 'Image SMS sent to patient '. $patient->name);
            }
            
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
            'patient_type_id' => $request['search_patient_type'],
        ];

        $dataObj = $this->patientDL->doSearchingQuery($constraints);
        $patientTypeObj = $this->patientTypeDL->getAllActive();
        $params = [
            'dataObj'   =>  $dataObj,
            'patientTypeObj'   =>  $patientTypeObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.sms.index')->with($params);
    }
}
