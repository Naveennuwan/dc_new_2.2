<?php

namespace App\Http\Controllers;

use App\Http\DataLayer\PatientNextVisitDataLayer;
use App\Http\DataLayer\PatientDataLayer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests\PatientNextVisitRequest;
use App\Services\SmsService;

class PatientNextVisitController extends Controller
{
    protected $nextVisitDL;
    protected $patientDL;
    public function __construct(PatientDataLayer $patientDL,PatientNextVisitDataLayer $nextVisitDL)
    {
        $this->nextVisitDL = $nextVisitDL;
        $this->patientDL = $patientDL;
        // $this->middleware('permission:next-visit-access');
        // $this->middleware('permission:next-visit-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:next-visit-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:next-visit-delete', ['only' => ['show', 'delete']]);
    }
    
    public function index()
    {
        $patientObj = $this->patientDL->getAll();
        $dataObj = $this->nextVisitDL->getAll();
        $constraints = [
            'name' => null,
            'patient_id' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
            'patientObj' => $patientObj
        ];
        return view('pages.next_visit.index')->with($params);
    }
    
    public function store(PatientNextVisitRequest $request)
    {
        try {
            $dataObj = $this->nextVisitDL->insert($request);

            $patientObj = $this->patientDL->getById($request->patient_id);$patientName = $patientObj->name;
            
            $nextDate = $request->next_date;
            $time = $request->time;
            if (!empty($time)) {
                $text = "Hi {$patientName}, You have an appointment scheduled for {$nextDate} at {$time}. We look forward to seeing you.";
            } else {
                $text = "Hi {$patientName}, You have an appointment scheduled for {$nextDate}. We look forward to seeing you.";
            }

            $this->Send_SMS($request->patient_id,$text);

            return redirect()->route('invoice', ['patient_id' => $dataObj->patient_id])->with('success', 'Next Visit saved successfully');
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    public function Send_SMS($to, $text)
    {
        $smsService = new SmsService();
        $smsService->sendSms($to,$text);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $dataObj = $this->nextVisitDL->getById($id);
            $params = [
                'dataObj' => $dataObj,
            ];
            return view('pages.next_visit.delete')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.' . '404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $dataObj = $this->nextVisitDL->getById($id);
        $patientObj = $this->patientDL->getById($dataObj->patient_id);

        $text =  "Hi " . $patientObj->name . ", This is a friendly reminder that you have an appointment scheduled for " . $dataObj->next_date . " on " . $dataObj->time . ". we look forward to seeing you";

        $this->Send_SMS($patientObj->id,$text);

        
        $patientObj = $this->patientDL->getAll();
        $dataObj = $this->nextVisitDL->getAll();
        $constraints = [
            'name' => null,
            'patient_id' => null,
            'isDisplay' => "",
        ];
        
        $params = [
            'dataObj'   =>  $dataObj ?? [],
            'searchingVals' => $constraints,
            'patientObj' => $patientObj
        ];
        return view('pages.next_visit.index')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dataObj = $this->nextVisitDL->delete($id);
            return redirect()->route('next-visit.index')->with('success', 'Successfully Deleted');
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
            'patient_id' => $request['patient_id'],
            'isDisplay' => $request['search_display'],
        ];

        $dataObj = $this->nextVisitDL->doSearchingQuery($constraints);
        $patientObj = $this->patientDL->getAll();
        $params = [
            'dataObj'   =>  $dataObj,
            'searchingVals' => $constraints,
            'patientObj' => $patientObj
        ];
        return view('pages.next_visit.index')->with($params);
    }
}
