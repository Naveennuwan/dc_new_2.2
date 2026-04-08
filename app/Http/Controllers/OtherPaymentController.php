<?php

namespace App\Http\Controllers;
use App\Http\DataLayer\OtherPaymentDataLayer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Services\SmsService;

class OtherPaymentController extends Controller
{
    protected $otherPaymentDL;
    public function __construct(OtherPaymentDataLayer $otherPaymentDL)
    {
        $this->otherPaymentDL = $otherPaymentDL;
    }
    
    public function store(Request $request)
    {
        try {
            $dataObj = $this->otherPaymentDL->insert($request);
            
            $smsService = new SmsService();
            
            $amount = $dataObj->payment;
            $amountType = $dataObj->payment_type;
            $patientId = $dataObj->patient_id;

            $this->sendPaymentSms($amount, $amountType, $patientId);
            
            $successMessage = ($dataObj->payment_type == 'ADVANCE') ? 'Advance Payment saved successfully' : 'Discount saved successfully';

            return redirect()->route('invoice', ['patient_id' => $dataObj->patient_id])->with('success', $successMessage);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    private function sendPaymentSms($amount, $amountType, $patientId)
    {
        $smsService = new SmsService();

        $typeText = $amountType === 'DISCOUNT' ? 'discount amount' : 'paying amount';

        $text = "Your {$amount} Rs.{$typeText} was successful. Thank you for contacting Power Smile Dental Care. For more information call 0705000100.";

        $smsService->sendSms($patientId, $text);
    }
    
    public function destroy($id)
    {
        try {
            $dataObj = $this->otherPaymentDL->delete($id);
            return redirect()->back()->with('success', 'deleted Successfully');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }
}
