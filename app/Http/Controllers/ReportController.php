<?php

namespace App\Http\Controllers;
use App\Http\DataLayer\PatientDataLayer;
use App\Http\DataLayer\OtherPaymentDataLayer;
use App\Http\DataLayer\SavedTreatementDataLayer;

use Carbon\Carbon;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $patientDL;
    protected $otherPaymentDL;
    protected $savedTreatementDL;

    public function __construct(PatientDataLayer $patientDL, OtherPaymentDataLayer $otherPaymentDL, SavedTreatementDataLayer $savedTreatementDL,)
    {
        $this->patientDL = $patientDL;
        $this->otherPaymentDL = $otherPaymentDL;
        $this->savedTreatementDL = $savedTreatementDL;
    }

    public function index()
    {
        return view('pages.reports.index');
    }

    public function daily()
    {
        $todayPatients = $this->patientDL->getTodayPatientRegisterCountByType();
        $todayOtherPayments = $this->otherPaymentDL->getTodayPayments();
        $getRoutingTreatmentsToday = $this->savedTreatementDL->getRoutingTreatmentsToday();
        $getOrthodonticTreatmentsToday = $this->savedTreatementDL->getOrthodonticTreatmentsToday();
        $getPaymentToday = $this->savedTreatementDL->getPaymentToday();
        
        return view('pages.reports.daily', compact('todayPatients', 'todayOtherPayments', 'getRoutingTreatmentsToday', 'getOrthodonticTreatmentsToday', 'getPaymentToday'));
    }

    public function monthly()
    {
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfMonth();

        $totalPatients = $this->patientDL->getTotalPatients($monthStart,$monthEnd,null);
        $totalRoutinePatients = $this->patientDL->getTotalPatients($monthStart,$monthEnd,1);
        $totalOrthodonticPatients = $this->patientDL->getTotalPatients($monthStart,$monthEnd,2);

        $getRoutingTreatmentsMonthly = $this->savedTreatementDL->getRoutingTreatmentsMonthly($monthStart,$monthEnd);
        $getOrthodonticTreatmentsMonthly = $this->savedTreatementDL->getOrthodonticTreatmentsMonthly($monthStart,$monthEnd);
        $getPaymentMonthly = $this->savedTreatementDL->getPaymentMonthly($monthStart,$monthEnd);

        $monthlyOtherPayments = $this->otherPaymentDL->monthlyOtherPayments($monthStart,$monthEnd);
        return view('pages.reports.monthly', compact(
            'totalPatients',
            'totalRoutinePatients',
            'totalOrthodonticPatients',
            'monthlyOtherPayments',
            'getRoutingTreatmentsMonthly',
            'getOrthodonticTreatmentsMonthly',
            'getPaymentMonthly',
        ));
    }

    public function doctor()
    {
        return view('pages.reports.doctor');
    }

    public function treatment()
    {
        return view('pages.reports.treatment');
    }

    public function center()
    {
        return view('pages.reports.center');
    }

    public function outstanding()
    {
        return view('pages.reports.outstanding');
    }
}
