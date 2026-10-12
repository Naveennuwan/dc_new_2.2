<?php

namespace App\Http\DataLayer;

use App\Models\SavedTreatment;
use App\Models\SavedTreatmentPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class SavedTreatementDataLayer
{
    public function SaveTreatement($request)
    {
        try {
            $dataObj = SavedTreatment::create([
                'patient_id' => trim(intval($request['patient_id'])),
                'template_id' => trim(intval($request['template_id'])),
                'doctor_id' => trim(intval($request['doctor_id'])),
                'isPrint' => $request['isPrint'] ?? 0,
                'center_id' => Auth::user()->center_id,
                'created_by' => Auth::user()->id,
            ]);

            return $dataObj;
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
    
    public function SavePayment($payment, $treatment_id)
    {
        try {
            $dataObj = SavedTreatmentPayment::create([
                'template_id' => $treatment_id,
                'payment' => floatval($payment ?? 0),
                'created_by' => Auth::user()->id,
            ]);
            
            return $dataObj;
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
    
    public function getPatientTreatmentsWithPaymentDetails($patientId)
    {
        try {
            // Get treatments with payment summary
            $treatments = SavedTreatment::with(['priceLevels'])
            ->where('saved_treatments.patient_id', $patientId)
                ->join('template_headers', 'saved_treatments.template_id', '=', 'template_headers.id')
                ->leftJoin('saved_treatments_payments', 'saved_treatments.id', '=', 'saved_treatments_payments.template_id')
                ->where('template_headers.template_category_id', '!=', 3)
                ->where('isSettled', 0)
                ->select([
                    'saved_treatments.id',
                    'saved_treatments.template_id',
                    'saved_treatments.created_at',
                    'saved_treatments.isSettled',
                    'saved_treatments.isPrint',
                    'template_headers.name as template_name',
                    'template_headers.name as template',
                    \DB::raw('COALESCE(SUM(saved_treatments_payments.payment), 0) as payment')
                ])
                ->groupBy(
                    'saved_treatments.id',
                    'saved_treatments.template_id',
                    'saved_treatments.created_at',
                    'saved_treatments.isSettled',
                    'saved_treatments.isPrint',
                    'template_headers.name',
                )
                ->orderBy('saved_treatments.created_at', 'desc')
                ->get();

            return $treatments;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
    
    public function getPatientDrugTemplates($patientId)
    {
        try {
            $treatments = SavedTreatment::where('patient_id', $patientId)
                ->whereHas('template', function ($query) {
                    $query->where('template_category_id', 3)
                    ->where('isSettled', 0);
                })
                ->with(['template', 'doctor', 'center'])
                ->withSum('payments', 'payment')
                ->orderBy('created_at', 'desc')
                ->get();

            return $treatments;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
    
    public function getPreviousTreatements($patientId)
    {
        try {
            // Get treatments with payment summary
            $treatments = SavedTreatment::with(['template', 'doctor', 'center'])
                ->where('patient_id', $patientId)
                ->where('isSettled', 1)
                ->orderBy('created_at', 'desc')
                ->get();

            return $treatments;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
    
    public function PatientSettle($patientId)
    {
        try {
            $updated = SavedTreatment::where('patient_id', $patientId)
            ->update([
                'isSettled' => true,
                'updated_by' => Auth::id(),
                'updated_at' => now(),
            ]);

            return;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }

    public function getById($id)
    {
        return $id === null ? null : SavedTreatment::findOrFail($id);
    }

    public function deleteTreatment($id)
    {
        try {
            $dataObjUpd = $this->getById($id);
            $dataObjUpd->updated_by =  Auth::user()->id;
            $dataObjUpd->save();

            $dataObjDel = $this->getById($id);
            $dataObjDel->delete();

            return $dataObjDel;
        } catch (QueryException $exception) {
            Log::error('Error deleting Template Category : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = SavedTreatment::with([
            'template',
            'template.templateCategory',
            'patient',
            'doctor',
            'center',
            'priceLevels'
        ])->orderBy('id', 'DESC');
        
        foreach ($constraints as $field => $constraint) {
            if ($constraint !== null) {
                $this->applyConstraint($query, $field, $constraint);
            }
        }

        return $query->get();
    }

    public function applyConstraint($query, $field, $constraint)
    {
        switch ($field) {
            case 'id':
                $query->where('id', '=', trim($constraint));
                break;
            case 'name':
                $query->where($field, 'like', '%' . trim($constraint) . '%');
                break;
            case 'patient_id':
                $query->where($field, '=', $constraint);
                break;
            case 'template_category_id':
               $query->where($field, '=', $constraint);
                break;
            case 'payment':
                $query->where($field, '=', $constraint);
                break;
            case 'isSettled':
                $query->where($field, '=', $constraint);
                break;
            case 'deleted_at':
                $query->where($field, '=', $constraint);
                break;
            case 'created_at':
                $query->where($field, 'like', $constraint. '%');
                break;
            case 'isDisplay':
                $query->where($field, '=', trim($constraint));
                break;
        }
    }
    
    public function getRoutingTreatmentsToday()
    {
        try {
            $treatments = SavedTreatment::selectRaw('template_id, COUNT(*) as total')
                ->with('template')
                ->whereDate('created_at', Carbon::today())
                ->where('center_id', Auth::user()->center_id)
                ->whereHas('patient', function ($query) {
                    $query->where('patient_type_id', 1);
                })
                ->groupBy('template_id')
                ->orderByDesc('total')
                ->get();
    
            return $treatments;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
    
    public function getOrthodonticTreatmentsToday()
    {
        try {
            $treatments = SavedTreatment::selectRaw('template_id, COUNT(*) as total')
                ->with('template')
                ->whereDate('created_at', Carbon::today())
                ->where('center_id', Auth::user()->center_id)
                ->whereHas('patient', function ($query) {
                    $query->where('patient_type_id', 2);
                })
                ->groupBy('template_id')
                ->orderByDesc('total')
                ->get();
            return $treatments;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
    
    public function getPaymentToday()
    {
        try {
            $treatments = SavedTreatmentPayment::with([
                'savedTreatment.patient',
                'savedTreatment.template',
                'savedTreatment.doctor',
                'savedTreatment.center',
                'savedTreatment.priceLevels'
            ])
            ->whereDate('created_at', Carbon::today())
            ->whereHas('savedTreatment', function ($query) {
                $query->where('center_id', Auth::user()->center_id);
            })
            ->orderByDesc('created_at')
            ->get();
            
            return $treatments;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }


    
    public function getRoutingTreatmentsMonthly($monthStart,$monthEnd)
    {
        try {
            $treatments = SavedTreatment::selectRaw('template_id, COUNT(*) as total')
                ->with('template')
                ->whereBetween('created_at',[$monthStart,$monthEnd])
                ->where('center_id', Auth::user()->center_id)
                ->whereHas('patient', function ($query) {
                    $query->where('patient_type_id', 1);
                })
                ->groupBy('template_id')
                ->orderByDesc('total')
                ->get();
    
            return $treatments;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
    
    public function getOrthodonticTreatmentsMonthly($monthStart,$monthEnd)
    {
        try {
            $treatments = SavedTreatment::selectRaw('template_id, COUNT(*) as total')
                ->with('template')
                ->whereBetween('created_at',[$monthStart,$monthEnd])
                ->where('center_id', Auth::user()->center_id)
                ->whereHas('patient', function ($query) {
                    $query->where('patient_type_id', 2);
                })
                ->groupBy('template_id')
                ->orderByDesc('total')
                ->get();
            return $treatments;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
    
    public function getPaymentMonthly($monthStart,$monthEnd)
    {
        try {
            $treatments = SavedTreatmentPayment::with([
                'savedTreatment.patient',
                'savedTreatment.template',
                'savedTreatment.doctor',
                'savedTreatment.center',
                'savedTreatment.priceLevels'
            ])
            ->whereBetween('created_at',[$monthStart,$monthEnd])
            ->whereHas('savedTreatment', function ($query) {
                $query->where('center_id', Auth::user()->center_id);
            })
            ->orderByDesc('created_at')
            ->get();
            
            return $treatments;
            
        } catch (QueryException $exception) {
            return $exception->getMessage();
        }
    }
}