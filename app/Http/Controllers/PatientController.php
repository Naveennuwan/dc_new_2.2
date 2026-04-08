<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\PatientDataLayer;
use App\Http\DataLayer\PatientImageDataLayer;
use App\Http\DataLayer\PatientTypeDataLayer;
use App\Http\DataLayer\OrthodonticPlanDataLayer;
use App\Http\DataLayer\AlergyDataLayer;
use App\Http\DataLayer\DiseaseDataLayer;
use App\Http\Requests\PatientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\SmsService;

class PatientController extends Controller
{
    protected $patientDL;
    protected $patientImageDL;
    protected $patientTypeDL;
    protected $orthodonticPlanDL;
    protected $alergyDL;
    protected $diseaseDL;
    public function __construct(PatientDataLayer $patientDL,PatientTypeDataLayer $patientTypeDL,OrthodonticPlanDataLayer $orthodonticPlanDL,AlergyDataLayer $alergyDL,DiseaseDataLayer $diseaseDL,PatientImageDataLayer $patientImageDL)
    {
        $this->patientDL = $patientDL;
        $this->patientImageDL = $patientImageDL;
        $this->patientTypeDL = $patientTypeDL;
        $this->orthodonticPlanDL = $orthodonticPlanDL;
        $this->alergyDL = $alergyDL;
        $this->diseaseDL = $diseaseDL;
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
        return view('pages.patient.index')->with($params);
    }

    
    public function create()
    {
        try {
            $patientTypes = $this->patientTypeDL->getAllActive();
            $orthodonticPlans = $this->orthodonticPlanDL->getAllActive();
            $alergys = $this->alergyDL->getAllActive();
            $diseases = $this->diseaseDL->getAllActive();
            $patients = $this->patientDL->getAll();
            $params = [
                'patientTypes'   => $patientTypes ,
                'orthodonticPlans'   => $orthodonticPlans,
                'alergys'   => $alergys,
                'diseases'   => $diseases,
                'patients'   => $patients,
            ];
            return view('pages.patient.create')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function store(PatientRequest $request)
    {
        try {
            $dataObj = $this->patientDL->insert($request);

            $registerCode = ($dataObj->patient_type_id == 1 ? 'R' : 'O') 
            . 'P-' . $dataObj->patient_register_id;
            
            $smsService = new SmsService();
            $message = "Dear {$dataObj->name}, your registration is successful. "
                       . "Your Patient ID is {$registerCode}. "
                       . "Thank you. For more Information call 0705000100.";
                       
            $smsService->sendSms((int) $dataObj->id, $message);
            
            return redirect()->route('patient.index')->with('success', 'Dear '.$dataObj->name.' your registration is successful.');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function show($id)
    {
        try {
            $dataObj = $this->patientDL->getById($id);
            $patientTypes = $this->patientTypeDL->getAllActive();
            $orthodonticPlans = $this->orthodonticPlanDL->getAllActive();
            $alergys = $this->alergyDL->getAllActive();
            $diseases = $this->diseaseDL->getAllActive();

            $patientAlergies = $this->patientDL->getPatientAlergy($id);
            $patientDiseases = $this->patientDL->getPatientDisease($id);
            $patients = $this->patientDL->getAll();
            $params = [
                'dataObj'  => $dataObj,
                'patientTypes'   => $patientTypes ,
                'orthodonticPlans'   => $orthodonticPlans,
                'alergys'   => $alergys,
                'diseases'   => $diseases,
                'patients'   => $patients,

                'patientAlergies'   => $patientAlergies,
                'patientDiseases'   => $patientDiseases,
            ];
            return view('pages.patient.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function edit($id)
    {
        try {
            $dataObj = $this->patientDL->getById($id);
            $patientTypes = $this->patientTypeDL->getAllActive();
            $orthodonticPlans = $this->orthodonticPlanDL->getAllActive();
            $alergys = $this->alergyDL->getAllActive();
            $diseases = $this->diseaseDL->getAllActive();

            $patientAlergies = $this->patientDL->getPatientAlergy($id);
            $patientDiseases = $this->patientDL->getPatientDisease($id);
            $patients = $this->patientDL->getAll();
            $params = [
                'dataObj'  => $dataObj,
                'patientTypes'   => $patientTypes ,
                'orthodonticPlans'   => $orthodonticPlans,
                'alergys'   => $alergys,
                'diseases'   => $diseases,
                'patients'   => $patients,

                'patientAlergies'   => $patientAlergies,
                'patientDiseases'   => $patientDiseases,
            ];
            return view('pages.patient.edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function update(PatientRequest $request, $id)
    {
        try {
            $dataObj = $this->patientDL->update($request, $id);
            return redirect()->route('patient.index')->with('success', trans('general.form.flash.updated', ['name' => $dataObj->name]));
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->patientDL->delete($id);
            return redirect()->route('patient.index')->with('success', trans('general.form.flash.deleted', ['name' => $dataObj->name]));
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
            'patient_contact_no' => $request['patient_contact_no'],
            'isDisplay' => $request['search_display'],
            'patient_type_id' => $request['search_patient_type'],
            'start_date' => $request['start_date'],
            'end_date' => $request['end_date'],
        ];

        $dataObj = $this->patientDL->doSearchingQuery($constraints);
        $patientTypeObj = $this->patientTypeDL->getAllActive();
        $params = [
            'dataObj'   =>  $dataObj,
            'patientTypeObj'   =>  $patientTypeObj,
            'searchingVals' => $constraints,
        ];
        return view('pages.patient.index')->with($params);
    }

    public function imageUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'patient_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('invoice', ['patient_id' => $request->patient_id])->with('error', 'Image Upload fail');
        }
        
        $dataObj = $this->patientImageDL->insert($request);
        return redirect()->route('invoice', ['patient_id' => $dataObj->patient_id])->with('success', 'Image Uploaded successfully');
    }

    public function imagedestroy($id)
    {
        try {
            $image = $this->patientImageDL->getById($id);
            
            $patientId = $image->patient_id;
            
            $this->patientImageDL->delete($id);
            
            $filePath = public_path('images/patient_images/' . $image->patient_id . '/' . $image->image);
            
            if (file_exists($filePath)) {
                if (!unlink($filePath)) {
                    return redirect()->back()->with('error', 'Failed to delete the file');
                }
            } else {
                return redirect()->back()->with('error', 'File not found');
            }
            
            return redirect()->route('invoice', ['patient_id' => $patientId])
                ->with('success', 'Image deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Internal Server Error');
        }
    }

}
