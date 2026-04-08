<?php

namespace App\Http\Controllers;
use App\Http\DataLayer\AdvanceDataLayer;
use App\Http\DataLayer\DoctorDataLayer;
use App\Http\DataLayer\TemplateTypesDataLayer;
use App\Http\DataLayer\LaboratoryExpenseDataLayer;
use App\Http\DataLayer\OrthodonticPlanDataLayer;
use App\Http\DataLayer\PatientDataLayer;
use App\Http\DataLayer\PatientImageDataLayer;
use App\Http\DataLayer\TemplateDataLayer;
use App\Http\DataLayer\SavedTreatementDataLayer;
use App\Http\DataLayer\OtherPaymentDataLayer;
use App\Services\SmsService;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    // protected $advanceDL;
    protected $doctorDL;
    protected $templateTypeDL;
    protected $laboratoryExpenseDL;
    protected $orthodonticPlanDL;
    protected $patientDL;
    protected $savedTreatementDL;
    protected $otherPaymentDL;
    protected $patientImageDL;


    public function __construct(
        DoctorDataLayer $doctorDL,
        PatientDataLayer $patientDL, 
        TemplateDataLayer $templateDL,
        TemplateTypesDataLayer $templateTypeDL,
        SavedTreatementDataLayer $savedTreatementDL,
        OtherPaymentDataLayer $otherPaymentDL,
        LaboratoryExpenseDataLayer $laboratoryExpenseDL,
        PatientImageDataLayer $patientImageDL,
        OrthodonticPlanDataLayer $orthodonticPlanDL
        )
    {
        $this->doctorDL = $doctorDL;
        $this->patientDL = $patientDL;
        $this->templateDL = $templateDL;
        $this->templateTypeDL = $templateTypeDL;
        $this->savedTreatementDL = $savedTreatementDL;
        $this->laboratoryExpenseDL = $laboratoryExpenseDL;
        $this->orthodonticPlanDL = $orthodonticPlanDL;
        $this->otherPaymentDL = $otherPaymentDL;
        $this->patientImageDL = $patientImageDL;
    }

    public function index()
    {
        return view('pages.dashboard.index');
    }

    private function getTemplatesByCategory(int $categoryId)
    {
        return $this->templateDL->doSearchingQuery([
            'template_category_id' => $categoryId,
            'isDisplay' => true
        ]) ?? [];
    }

    private function loadInvoicePage(
        int $patientTypeId,
        string $routeName,
        array $extraData = []
    ) {
        return view('pages.dashboard.invoice')->with(array_merge([
    
            'routeName' => $routeName,
            'searchingVals' => [
                'patient_id' => '',
                'doctor_id' => '',
            ],
    
            'savedTemplates' => [],
            'savedDrugTemp' => [],
            'previousTreatements' => [],
            'advancePayments' => [],
            'discountPayments' => [],
            'images' => [],
    
            'patientDetails' => '',
            'alergies' => [],
            'diseases' => [],
    
            'doctorObj' => $this->doctorDL->getAllActive() ?? [],
            'patientObj' => $this->patientDL->doSearchingQuery([
                'patient_type_id' => $patientTypeId
            ]) ?? [],
    
            'IssueingTemplateObj' => $this->getTemplatesByCategory(3),
            'templateTypeObj' => $patientTypeId == 1
                                    ? $this->templateTypeDL->getAllActive()
                                    : [],
    
            'routineTemplateObj' => $patientTypeId == 1
                                    ? $this->getTemplatesByCategory(1)
                                    : [],
    
            'orthodonticTemplateObj' => $patientTypeId == 2
                                    ? $this->getTemplatesByCategory(2)
                                    : [],
        ], $extraData));
    }
    

    public function routine()
    {
        return $this->loadInvoicePage(1, 'Routine');
    }
    
    public function orthodontic()
    {
        return $this->loadInvoicePage(2, 'Orthodontice');
    }
    
    public function invoice($patient_id, $doctor_id = null)
    {
        $patient = $this->patientDL->getById($patient_id);

        if (!$patient) {
            abort(404);
        }
        
        if ($patient->patient_type_id == 2 && !$patient->orthodontice_plan_id) {
            return redirect()
                ->route('patient.edit', $patient_id)
                ->with('error', "Please update the Orthodontic plan");
        }

        $commonData = [
            'searchingVals' => [
                'patient_id' => $patient_id,
                'doctor_id'  => $doctor_id,
            ],

            'patientDetails' => $patient,
            'alergies' => $this->patientDL->getPatientAlergy($patient_id) ?? [],
            'diseases' => $this->patientDL->getPatientDisease($patient_id) ?? [],
            'doctorObj' => $this->doctorDL->getAllActive() ?? [],

            'patientObj' => $this->patientDL->doSearchingQuery([
                'patient_type_id' => $patient->patient_type_id,
                'isDisplay' => true
            ]) ?? [],

            'IssueingTemplateObj' => $this->getTemplatesByCategory(3),

            'advancePayments' => $this->otherPaymentDL->doSearchingQuery([
                'patient_id' => $patient_id,
                'payment_type' => 'ADVANCE',
                'isSettled' => false
            ]) ?? [],

            'discountPayments' => $this->otherPaymentDL->doSearchingQuery([
                'patient_id' => $patient_id,
                'payment_type' => 'DISCOUNT',
                'isSettled' => false
            ]) ?? [],

            'images' => $this->patientImageDL->getAllActive($patient_id) ?? [],

            'templateDetails' => $patient->orthodontice_plan_id
                ? $this->orthodonticPlanDL->getById($patient->orthodontice_plan_id)
                : [],

            'savedDrugTemp' => $this->savedTreatementDL
                ->getPatientDrugTemplates($patient_id) ?? [],

            'savedTemplates' => $this->savedTreatementDL
                ->getPatientTreatmentsWithPaymentDetails($patient_id) ?? [],

            'previousTreatements' => $this->savedTreatementDL
            ->getPreviousTreatements($patient_id) ?? [],
        ];

        return $this->loadInvoicePage(
            $patient->patient_type_id,
            $patient->patient_type_id == 1 ? 'Routine' : 'Orthodontice',
            $commonData
        );
    }
   
    public function addTreatementTemp($templateId, $patientId, $doctorId, $payment)
    {
        $request = [
            "patient_id" => $patientId,
            "template_id" => $templateId,
            "doctor_id" => $doctorId,
            "payment" => round((float) $payment, 2),
            "isPrint" => 0,
            ];
            
        $SavedTreatement = $this->savedTreatementDL->SaveTreatement($request);
        
        if(round((float) $payment, 2) > 0){
            $InsertSavedTreatementPayment = $this->savedTreatementDL->SavePayment(round((float) $payment, 2), $SavedTreatement->id);
            $patientDetails = $this->patientDL->getById((int) $patientId);
            $smsService = new SmsService();
            $text = urlencode("Your paying amount Rs." . $InsertSavedTreatementPayment->payment . " was Successful. Thank you for contacting Power Smile Dental Care. For more Information call 0705000100.");
            $smsService->sendSms((int) $patientDetails->id, $text);
        }
        
        return redirect()->route('invoice', ['patient_id' => $SavedTreatement->patient_id, 'doctor_id' => $SavedTreatement->doctor_id])->with('success', 'Tratement saved successfully');
    }

    public function addDrugTemp($templateId, $patientId, $doctorId, $action)
    {
        $request = [
            "patient_id" => $patientId,
            "template_id" => $templateId,
            "doctor_id" => $doctorId,
            "payment" => 0,
            "isPrint" => ($action === 'print') ? 1 : 0,
            ];
        
        $Save = $this->savedTreatementDL->SaveTreatement($request);
        
        return back()->with('success', 'Drug Template Added successfully');
    }
    
    public function destroy($id)
    {
        try {
            $doctorId = '';
            $dataObj = $this->savedTreatementDL->deleteTreatment($id);
            
            return redirect()->route('invoice', ['patient_id' => $dataObj->patient_id, 'doctor_id' => $doctorId])->with('success', 'Tratement Deleted successfully');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
    
    // public function payFull(Request $request)
    // {
    //     $dataObj = $this->savedTreatementDL->SavePayment($request->amount, $request->row_id);

    //     return back()->with('success', 'Full payment completed');
    // }

    public function payCustom(Request $request)
    {
        $dataObj = $this->savedTreatementDL->SavePayment($request->amount, $request->row_id);

        return back()->with('success', 'Payment updated successfully');
    }

    public function settle($patientId)
    {
        $dataObj = $this->savedTreatementDL->PatientSettle($patientId);

        $dataObj = $this->otherPaymentDL->PatientSettle($patientId);

        return back()->with('success', 'Patient Invoice settled successfully'); 
    }

}
