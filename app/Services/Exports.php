<?php

namespace App\Services;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Advance;
use App\Models\Category;
use App\Models\Product;
use App\Models\PatientNextVisit;
use App\Models\TemplateBody;
use App\Models\Center;
use App\Models\SavedTreatment;
use App\Models\LaboratoryLedger;
use App\Models\InventoryLedger;
use App\Models\Settlement;
use Illuminate\Support\Facades\DB;
use TCPDF;
use PDF;
use TCPDF_FONTS;
use Illuminate\Support\Facades\Auth;
use Dompdf\Dompdf;
use Dompdf\Options;

use App\Http\DataLayer\PatientDataLayer;
use App\Http\DataLayer\SavedTreatementDataLayer;
use App\Http\DataLayer\OtherPaymentDataLayer;

use Mpdf\Mpdf;

class Exports
{
    protected $selected_ids;
    protected $export_path;

    public function __construct()
    {
        $this->export_path = public_path("pdf_export");

        $this->apiUrl = 'https://api.exchangerate-api.com/v4/latest/USD';
        $this->response = file_get_contents($this->apiUrl);
        $this->data = json_decode($this->response, true);
    }

    public function medicalReport($dataObj)
    {
        $Center = Center::find(Auth::user()->center_id);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        $pdf->AddPage();
        
        $pdf->SetFont('helvetica', '', 12);
        
        $imagePath = public_path('images/logo2.png');
        $logoWidth = 30; 
        $logoX = ($pdf->getPageWidth() - $logoWidth) / 2;
        $logoY = 15;
        $pdf->Image($imagePath, $logoX, $logoY, $logoWidth);
        
        $pdf->SetY(5 + $logoWidth);
        $pdf->Cell(0, 0, $Center['address_01'], 0, 1, 'C');
        $pdf->Cell(0, 0, $Center['address_02'], 0, 1, 'C');
        $pdf->Cell(0, 0, $Center['name'], 0, 1, 'C');
        $pdf->Cell(0, 0, $Center['contact_no'], 0, 1, 'C');
        $pdf->Ln(10);
   
        $font_size_10 = 10;
        $font_size_08 = 8;

        $name = 'Surgeon: Dr. '. $dataObj->doctor->name;
        $position =  $dataObj->doctor->designation;
        $campus =  $dataObj->doctor->campus.", ". $dataObj->doctor->slmc_reg_no;
        $base_Hospital = 'Base Hospital: '.  $dataObj->doctor->base_hospital;
        
        $pdf->Ln(10);
        
        $pdf->Write(0, 'Date: ' . date('Y-m-d'), '', 0, 'L', true, 0, false, false, 0);
        
        $medical_report_id = $dataObj->id;
        $patientName = $dataObj->patient->name;
        $patientNIC = $dataObj->patient->patient_nic_no;
        $patientAddress = $dataObj->patient->patient_address;                                                                                                                                                                                                                                                                                                                                                                                                                            
        
        if ($dataObj->patient->patient_gender === 'Male') {
            $gender = 'His';
        } elseif ($dataObj->patient->patient_gender === 'Female') {
            $gender = 'Her';
        } else {
            $gender = 'His / Her';
        }

        $pdf->Ln(5);

        $content = <<<EOD
        I am writing this on behalf of my patient, $patientName (ID Card No.: $patientNIC), who is under my care.The patient's address is as follows: $patientAddress.

        $patientName was examined by me. $gender oral hygeine status is satisfacty. 

        Thank you.

        Sincerely,

        $name
        $position
        $campus
        $base_Hospital
        
        EOD;

        $pdf->MultiCell(0, 10, $content);
        $fileName = "Medical_Report_" . $medical_report_id . ".pdf";

        $pdf->Output($this->export_path. DIRECTORY_SEPARATOR . $fileName, 'F');
    }

    public function leaveReport($dataObj)
    {
        $Center = Center::find(Auth::user()->center_id);

        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        
        $pdf->AddPage();
        
        $pdf->SetFont('helvetica', '', 12);
        
        $imagePath = public_path('images/logo2.png');
        $logoWidth = 30; 
        $logoX = ($pdf->getPageWidth() - $logoWidth) / 2;
        $logoY = 15;
        $pdf->Image($imagePath, $logoX, $logoY, $logoWidth);
        
        $pdf->SetY(5 + $logoWidth);
        $pdf->Cell(0, 0, $Center['address_01'], 0, 1, 'C');
        $pdf->Cell(0, 0, $Center['address_02'], 0, 1, 'C');
        $pdf->Cell(0, 0, $Center['name'], 0, 1, 'C');
        $pdf->Cell(0, 0, $Center['contact_no'], 0, 1, 'C');
        $pdf->Ln(10);
   
        $font_size_10 = 10;
        $font_size_08 = 8;

        $name = 'Surgeon: Dr. '. $dataObj->doctor->name;
        $position =  $dataObj->doctor->designation;
        $campus =  $dataObj->doctor->campus.", ". $dataObj->doctor->slmc_reg_no;
        $base_Hospital = 'Base Hospital: '.  $dataObj->doctor->base_hospital;
        
        $pdf->Ln(10);
        
        $pdf->Write(0, 'Date: ' . date('Y-m-d'), '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, 'Dear Human Resources Manager,', '', 0, 'L', true, 0, false, false, 0);

        $leave_Report_id = $dataObj->id;
        $patientName = $dataObj->patient->name;
        $patientNIC = $dataObj->patient->patient_nic_no;
        $patientAddress = $dataObj->patient->patient_address;   
        $fromDate = $dataObj->from_date;
        $toDate = $dataObj->to_date;                                                                                                                                                                                                                                                                                                                                                                                                                          
        $treatement = $dataObj->leaveRequest->name;                                                                                                                                                                                                                                                                                                                                                                                                                          
        
        if ($fromDate === $toDate) {
            $duration = ' one day ' . $fromDate;
        } else {
            $duration = 'from ' . $fromDate . ' to ' . $toDate;
        }

        if ($dataObj->patient->patient_gender === 'Male') {
            $gender = 'He';
        } elseif ($dataObj->patient->patient_gender === 'Female') {
            $gender = 'She';
        } else {
            $gender = 'He / She';
        }
        
        $nicText = '';
        if (!empty($patientNIC)) {
            $nicText = " (ID Card No.: $patientNIC)";
        }
        $pdf->Ln(5);

        $content = <<<EOD
        I am writing to request leave on behalf of my patient, $patientName$nicText, who is under my care.The patient's address is as follows: $patientAddress.

        $gender $treatement.

        $patientName requires medical attention and care, necessitating a temporary leave from work. The recommended duration for their leave is $duration.
       
        Your cooperation in granting this leave request is highly appreciated.
        
        Thank you.

        Sincerely,

        $name
        $position
        $campus
        $base_Hospital
        
        EOD;

        $pdf->MultiCell(0, 10, $content);
        $fileName = "Leave_Report_" . $leave_Report_id . ".pdf";

        $pdf->Output($this->export_path. DIRECTORY_SEPARATOR . $fileName, 'F');
    }

    public function DrugRecipt($patientId)
    {
        $patientDL = new PatientDataLayer();
        $savedTreatementDL = new SavedTreatementDataLayer();
        $otherPaymentDL = new OtherPaymentDataLayer();

        $Center = Center::find(Auth::user()->center_id);
        $pdf = new TCPDF('P', 'mm', 'A5', true, 'UTF-8', false);

        $pdf->SetPrintHeader(false);

        $imagePath = public_path('images/logo2.png');
        $logoWidth = 30;
        
        $pdf->AddPage();

        $pageWidth = $pdf->GetPageWidth();

        $imageX = ($pageWidth - 30) / 2;
        
        $pdf->SetAutoPageBreak(false);
        $pdf->SetMargins(5, 5, 5, true);
        $pdf->SetPrintHeader(false);
   
        $font_size_10 = 10;
        $font_size_08 = 8;
        
        // Add the logo image
        $pdf->SetY($pdf->GetY());
        $pdf->Image($imagePath, $imageX, $pdf->GetY(), 30);
        $pdf->SetY($pdf->GetY() + 15);

        $pdf->SetFont('Helvetica', '', $font_size_08);
        $pdf->Write(0, $Center['address_01'], '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, $Center['address_02'], '', 0, 'C', true, 0, false, false, 0);
           
        // Add a horizontal ruler
        $x1 = $pdf->GetX();
        $y1 = $pdf->GetY() + 1;
        $x2 = $pdf->getPageWidth() - $pdf->getMargins()['right'];
        $y2 = $y1;
        $pdf->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));
        $pdf->Line($x1, $y1, $x2, $y2);
        
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Write(0, 'Recipt', '', 0, 'C', true, 0, false, false, 0);

        // Set invoice details
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', '', $font_size_10);
        $pdf->Write(0, 'Center: '. $Center['name'], '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('Helvetica', '', $font_size_08);
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');
        $pdf->Write(0, ' Date: ' . $currentDate, '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, ' Time: ' . $currentTime, '', 0, 'L', true, 0, false, false, 0);

        $pdf->Ln(2);

        $patientDetails = $patientDL->getById($patientId);
        // Insert customer details
        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->Ln(5);
        $pdf->Write(0, 'Customer Details', '', 0, 'L', true, 0, false, false, 5);
        $pdf->SetFont('Helvetica', '', $font_size_08);
        $pdf->Write(0, 'Name: ' . $patientDetails->name, '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, 'Age: ' .$patientDetails->patient_age, '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, 'Address: ' .$patientDetails->patient_address, '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, 'Contact no.: ' .$patientDetails->patient_contact_no, '', 0, 'L', true, 0, false, false, 0);

        // $treatments = SavedTreatment::where('saved_treatments.patient_id', $patientId)
        //     ->where('saved_treatments.isPrint', '=', true)
        //     ->join('template_headers', 'saved_treatments.template_id', '=', 'template_headers.id')
        //     ->where('template_headers.template_category_id', '=', 3)
        //     ->get();  

        $treatments = $savedTreatementDL->getPatientDrugTemplates($patientId) ?? [];

        // dd($treatments);

        if (count($treatments)) {
            // Table Header..........................................................
            $pdf->Ln(2);
            $pdf->SetFont('Helvetica', 'B', $font_size_10);
        
            // Set the maximum width for each column
            $pdf->SetFont('Helvetica', 'B', $font_size_08);
            $itemWidth = 35;
            $quantityWidth = 13;
            $priceWidth = 18;
            $totalWidth = 14;

            // Table Body..........................................................
            // Set the table headers
            $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($itemWidth, 6, 'Item', 1, 0, 'L');
            $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($quantityWidth, 6, 'Dose', 1, 0, 'L');
            $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($priceWidth, 6, 'Frequency', 1, 0, 'L');
            $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($totalWidth, 6, 'Duration', 1, 1, 'L');

            $pdf->SetFont('Helvetica', '', $font_size_08);
            
            foreach ($treatments as $temp) {
                $DrugIssueTemplates = TemplateBody::where('template_id', $temp->template_id)
                ->get();
                
                foreach ($DrugIssueTemplates as $DrugIssueBody) {   
                    
                    $Product = Product::find($DrugIssueBody->product_id); 

                    $NameHeight = $pdf->getStringHeight($itemWidth, $Product->name);
            
                    $pdf->MultiCell($itemWidth, $NameHeight, $Product->name, 1, 'L');
                    $pdf->SetXY($pdf->GetX() + $itemWidth, $pdf->GetY() - $NameHeight);
            
                    $pdf->setLineStyle(array('width' => 0));
                    $pdf->Cell($quantityWidth, $NameHeight, $DrugIssueBody->dose, 1, 0, 'L');
                    $pdf->setLineStyle(array('width' => 0));
                    $pdf->Cell($priceWidth, $NameHeight, $DrugIssueBody->drugFrequency->name, 1, 0, 'L');
                    $pdf->setLineStyle(array('width' => 0));
                    $pdf->Cell($totalWidth, $NameHeight, $DrugIssueBody->duration . " days", 1, 1, 'L');
                }

            }
            
            // Table Footer..........................................................
            $pdf->SetFont('Helvetica', 'B', $font_size_08);
            // $Total_Value = $Header['total'];
            $pdf->Ln(2);
            $pdf->SetX(30);
        }

        $pdf->SetFont('Helvetica', 'B', 9);
        $pdf->Ln(5);

        $visits = PatientNextVisit::where('next_date', '>=', Carbon::now()->format('Y-m-d'))
        ->where('patient_id', '=', $patientId)
        ->orderBy('next_date')
        ->first();

        if ($visits) {
            $nextVisitTime = Carbon::parse($visits->time);
            $formattedTime = $nextVisitTime->format('h:i A');
            $pdf->Write(0, 'Next Visit: ' . $visits->next_date . ' at ' . $formattedTime, '', 0, 'L', true, 0, false, false, 5);
        } else {
            $pdf->Write(0, 'Next Visit: ', '', 0, 'L', true, 0, false, false, 5);
        }
        
        // Add a horizontal ruler
        $pdf->Ln(2);
        $x1 = $pdf->GetX();
        $y1 = $pdf->GetY() + 1;
        $x2 = $pdf->getPageWidth() - $pdf->getMargins()['right'];
        $y2 = $y1;
        $pdf->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));
        $pdf->Line($x1, $y1, $x2, $y2);

        $pdf->SetFont('Helvetica', 'B', 7);
        $pdf->Ln(2);
        $pdf->Write(0, 'For Billing Questions Call ' . $Center['contact_no'] , '', 0, 'C', true, 0, false, false, 5);
        $pdf->SetFont('Helvetica', '', 7);
        $pdf->Write(0, $Center['week_days'] . ' - ' . $Center['week_day_service_time'] . '  /  ' .  $Center['week_ends'] . ' - ' . $Center['week_ends_service_time'], '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, 'Centers - Mddiniya & Weeraketiya', '', 0, 'C', true, 0, false, false, 5);
        $pdf->Write(0, 'Powered By Whizzlogy Solutions', '', 0, 'C', true, 0, false, false, 0);

        $fileName = "Drug_Recipt" . $patientId . ".pdf";
        $pdf->Output($this->export_path. DIRECTORY_SEPARATOR . $fileName, 'F');
    }

    public function TreatementInvoice($patientId)
    {
        $patientDL = new PatientDataLayer();
        $savedTreatementDL = new SavedTreatementDataLayer();
        $otherPaymentDL = new OtherPaymentDataLayer();

        $totalTreatement = 0;
        
        $patientDetails = $patientDL->getById($patientId);
        $advancePayments = $otherPaymentDL->doSearchingQuery([
            'patient_id' => $patientId,
            'payment_type' => 'ADVANCE',
            'isSettled' => false
        ]) ?? [];
        $discountPayments = $otherPaymentDL->doSearchingQuery([
            'patient_id' => $patientId,
            'payment_type' => 'DISCOUNT',
            'isSettled' => false
        ]) ?? [];
        
        $Center = Center::find(1);
        $doctorObj = Doctor::find(1);
        $pdf = new TCPDF('P', 'mm', 'A5', true, 'UTF-8', false);

        $pdf->SetPrintHeader(false);

        $imagePath = public_path('images/logo2.png');
        $logoWidth = 30;
        
        $pdf->AddPage();

        $pageWidth = $pdf->GetPageWidth();

        $imageX = ($pageWidth - 30) / 2;
        
        $pdf->SetAutoPageBreak(false);
        $pdf->SetMargins(5, 5, 5, true);
        $pdf->SetPrintHeader(false);
   
        $font_size_10 = 10;
        $font_size_08 = 8;

        $pdf->SetY($pdf->GetY());
        $pdf->Image($imagePath, $imageX, $pdf->GetY(), 30);
        $pdf->SetY($pdf->GetY() + 15);

        $pdf->SetFont('Helvetica', '', $font_size_08);
        $pdf->Write(0, $Center['address_01'], '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, $Center['address_02'], '', 0, 'C', true, 0, false, false, 0);
        
        $x1 = $pdf->GetX();
        $y1 = $pdf->GetY() + 1;
        $x2 = $pdf->getPageWidth() - $pdf->getMargins()['right'];
        $y2 = $y1;
        $pdf->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));
        $pdf->Line($x1, $y1, $x2, $y2);
        
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', 'B', 10);
        $pdf->Write(0, 'Invoice', '', 0, 'C', true, 0, false, false, 0);
        
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', '', $font_size_10);
        $pdf->Write(0, 'Center: '. $Center->name, '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('Helvetica', '', $font_size_08);
        $pdf->Write(0, 'Date: ' . date('Y-m-d'), '', 0, 'L', true, 0, false, false, 0);
        
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', 'B', $font_size_10);
        $pdf->Write(0, 'Surgeon: ' . $doctorObj->name, '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('Helvetica', '', 7);
        $pdf->Write(0, $doctorObj->designation, '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, $doctorObj->campus . ', ' . $doctorObj->slmc_reg_no, '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('Helvetica', '', 9);
        $pdf->Write(0, 'Base Hospital: ' . $doctorObj->base_hospital, '', 0, 'L', true, 0, false, false, 0);
    
        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', 'B', $font_size_10);
        $pdf->Write(0, 'Patient Details', '', 0, 'L', true, 0, false, false, 0);
        $pdf->SetFont('Helvetica', '', 7);
        $pdf->Write(0, 'Name: ' . $patientDetails->name, '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, 'Age: ' .$patientDetails->patient_age, '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, 'Address: ' .$patientDetails->patient_address, '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, 'Contact no.: ' .$patientDetails->patient_contact_no, '', 0, 'L', true, 0, false, false, 0);
        
        $pdf->SetFont('Helvetica', 'B', $font_size_08);
        
        $treatments = $savedTreatementDL->getPatientTreatmentsWithPaymentDetails($patientId);
        
        // $DrugIssueTemplates = $savedTreatementDL->doSearchingQuery([
        //     'patient_id' => $patientId,
        //     'template_category_id'=> 3,
        //     'isSettled' => false
        // ]);
        
        $nameWidth = 60;
        $itemWidth = 40;
        $priceWidth = 30;
        $paymenteWidth = 30; ;

        $totalAdvance = collect($advancePayments)->sum('payment');
        $totalDiscount = collect($discountPayments)->sum('payment');

        // $totalTemplateValue = collect($treatments)->sum('template_price');
        if (count($treatments)) {

            // dd($treatments);priceLevels
            
            $pdf->Ln(2);
            $x1 = $pdf->GetX();
            $y1 = $pdf->GetY() + 1;
            $x2 = $pdf->getPageWidth() - $pdf->getMargins()['right'];
            $y2 = $y1;
            $pdf->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));
            $pdf->Line($x1, $y1, $x2, $y2);

        
            $pdf->Ln(5);
            $pdf->SetFont('Helvetica', '', $font_size_10);
            $pdf->Write(0, 'Treatements', '', 0, 'L', true, 0, false, false, 0);

            $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($nameWidth, 6, 'Treatement Name', 1, 0, 'C');
            $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($itemWidth, 6, 'Date', 1, 0, 'C');
            $pdf->setLineStyle(array('width' => 0));
            // $pdf->Cell($priceWidth, 6, 'Treatement Value', 1, 0, 'C');
            // $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($paymenteWidth, 6, 'Payment', 1, 1, 'C');

            $pdf->SetFont('Helvetica', '', $font_size_08);

            foreach ($treatments as $Template) {
                //  dd($Template->priceLevels);
                $price = 0;
                $levels = $Template->priceLevels ?? collect();

                if ($levels->count() === 1) {

                    $price = $levels->first()->price;

                } elseif ($levels->count() >= 2) {

                    if (empty($patientDetails) || empty($patientDetails->created_at)) {

                        $price = optional($levels->sortByDesc('effective_from')->first())->price ?? 0;

                    } else {

                        $nextPrice = $levels
                            ->sortByDesc('effective_from')
                            ->first(function ($item) use ($patientDetails) {
                                return $item->effective_from->lte($patientDetails->created_at);
                            });

                        $price = $nextPrice ? $nextPrice->price : 0;
                    }
                }
                $totalTreatement = $totalTreatement + $price;
                $pdf->setLineStyle(array('width' => 0));
                $pdf->Cell($nameWidth, 6, $Template->Template->name, 1, 0, 'C');
                $pdf->setLineStyle(array('width' => 0));
                $pdf->Cell($itemWidth, 6, date('Y-m-d', strtotime($Template->created_at)), 1, 0, 'C');
                $pdf->setLineStyle(array('width' => 0));
                // $pdf->Cell($priceWidth, 6, 'Rs. ' . number_format($price, 1), 1, 0, 'R');
                // $pdf->setLineStyle(array('width' => 0));
                $pdf->Cell($paymenteWidth, 6, 'Rs. ' . number_format($Template->payment, 1), 1, 1, 'R');
            }   

            $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($nameWidth, 6, "", 1, 0, 'L');
            $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($itemWidth, 6, "Total", 1, 0, 'R');
            $pdf->setLineStyle(array('width' => 0));
            // $pdf->Cell($priceWidth, 6, 'Rs. ' . $totalTreatement, 1, 0, 'R');
            // $pdf->setLineStyle(array('width' => 0));
            $pdf->Cell($paymenteWidth, 6, 'Rs. ' . number_format(collect($treatments)->sum('payment'),2), 1, 1, 'R');

            // Table Footer..........................................................
            $pdf->SetFont('Helvetica', '', $font_size_08);
            $pdf->Ln(2);
        }

        $totalTemplatePayment = collect($treatments)->sum('payment');

        // $totalToPayWithDiscount = $totalTreatement - $totalDiscount;
        $totalPayment = ($totalTemplatePayment + $totalAdvance - $totalDiscount);
        // $duePayment = $totalToPayWithDiscount - $totalPayment;

        // dd($patientDetails);
        //     'Disounts: '. 'Rs. ' .  number_format($totalDiscount, 2),
        //     'Total Treatements Value: '. 'Rs. ' .  number_format($totalTreatement, 2),
        //     'Total To Pay With Discount: '. 'Rs. ' . number_format($totalToPayWithDiscount, 2),
        //     'Total Payments : '. 'Rs. ' . number_format($totalPayment, 2),
        //     'Due Payment : '. 'Rs. ' . number_format($duePayment, 2)
        // );

        $pdf->Ln(2);
        $pdf->SetFont('Helvetica', '', $font_size_10);
        
        $pdf->Write(0, 'Advance Payment: '. 'Rs. ' .  number_format($totalAdvance, 2), '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, 'Disounts: '. 'Rs. ' .  number_format($totalDiscount, 2), '', 0, 'L', true, 0, false, false, 0);
        $pdf->Write(0, ' ', '', 0, 'L', true, 0, false, false, 0);
        if(is_object($patientDetails) && $patientDetails->patient_type_id ===1){
            $pdf->Write(0, 'Total Payments : '. 'Rs. ' . number_format($totalPayment, 2), '', 0, 'L', true, 0, false, false, 0);
        }else if(is_object($patientDetails) && $patientDetails->patient_type_id ===2){
            $pdf->Write(0, $patientDetails->orthodonticPlanType->name . ' : ' . $patientDetails->orthodonticPlanType->price, '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, 'Total To Pay With Discount: '. 'Rs. ' . number_format($patientDetails->orthodonticPlanType->price - $totalDiscount, 2), '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, 'Total Payment: '. 'Rs. ' . number_format($totalTemplatePayment + $totalAdvance, 2), '', 0, 'L', true, 0, false, false, 0);
            $pdf->Write(0, 'Due Payment : '. 'Rs. ' . number_format(($patientDetails->orthodonticPlanType->price - $totalDiscount) - ($totalTemplatePayment + $totalAdvance), 2), '', 0, 'L', true, 0, false, false, 0);
        }
        
        $pdf->Ln(2);
        $x1 = $pdf->GetX();
        $y1 = $pdf->GetY() + 1;
        $x2 = $pdf->getPageWidth() - $pdf->getMargins()['right'];
        $y2 = $y1;
        $pdf->SetLineStyle(array('width' => 0.5, 'color' => array(0, 0, 0)));
        $pdf->Line($x1, $y1, $x2, $y2);

        $pdf->SetFont('Helvetica', 'B', 7);
        $pdf->Ln(2);
        $pdf->Write(0, 'For Billing Questions Call ' . $Center->contact_no , '', 0, 'C', true, 0, false, false, 5);
        $pdf->SetFont('Helvetica', '', 7);
        $pdf->Write(0, $Center->week_days . ' - ' . $Center->week_day_service_time . '  /  ' .  $Center->week_ends . ' - ' . $Center->week_ends_service_time, '', 0, 'C', true, 0, false, false, 0);
        $pdf->Write(0, 'Centers - Mddiniya & Weeraketiya', '', 0, 'C', true, 0, false, false, 5);
        $pdf->Write(0, 'Powered By Whizzlogy Solutions', '', 0, 'C', true, 0, false, false, 0);

        $fileName = "Treatement_Invoice_" . $patientId . ".pdf";
        $pdf->Output($this->export_path. DIRECTORY_SEPARATOR . $fileName, 'F');
    }
}