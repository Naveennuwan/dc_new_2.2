<?php

namespace App\Http\Controllers;
use App\Services\Exports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ReciptController extends Controller
{
    public function index()
    {
        //
    }

    public function TreatementInvoice($patientId)
    {
        $export_path = public_path("pdf_export");
        $fileName = "Treatement_Invoice_" . $patientId . ".pdf";
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $invoice = new Exports();

        $invoice->TreatementInvoice($patientId);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ])->deleteFileAfterSend(true);
    }

    public function DrugRecipt($patientId)
    {
        $export_path = public_path("pdf_export");
        $fileName = "Drug_Recipt" . $patientId . ".pdf";
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $invoice = new Exports();

        $invoice->DrugRecipt($patientId);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ])->deleteFileAfterSend(true);
    }

    public function TreatementDrugRecipt($patientId)
    {
        $export_path = public_path("pdf_export");
        $fileName = "Treatement_And_Drug_Invoice" . $patientId . ".pdf";
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $invoice = new Exports();

        $invoice->TreatementAndDrugInvoice($patientId);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ])->deleteFileAfterSend(true);
    }

    public function AdvanceInvoice($patientId)
    {
        $export_path = public_path("pdf_export");
        $fileName = "Advance_Invoice_" . $patientId . ".pdf";
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $invoice = new Exports();

        $invoice->AdvanceInvoice($patientId);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ])->deleteFileAfterSend(true);
    }

    public function TodaysInvoice($patientId)
    {
        $export_path = public_path("pdf_export");
        $fileName = "Today_Invoice" . $patientId . ".pdf";
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $invoice = new Exports();

        $invoice->TodayInvoice($patientId);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ])->deleteFileAfterSend(true);
    }

    public function CopyInvoice($patientId)
    {
        $export_path = public_path("pdf_export");
        $fileName = "Invoice_Copy_" . $patientId . ".pdf";
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $invoice = new Exports();

        $invoice->InvoiceCopy($patientId);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ])->deleteFileAfterSend(true);
    }

    public function SinhalaInvoice($patientId)
    {
        $export_path = public_path("pdf_export");
        $fileName = "Sinhala_Invoice" . $patientId . ".pdf";
        $filePath = $export_path . DIRECTORY_SEPARATOR . $fileName;

        $invoice = new Exports();

        $invoice->SinhalaInvoice($patientId);

        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"'
        ])->deleteFileAfterSend(true);
    }
}
