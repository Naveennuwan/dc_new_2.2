<?php

namespace App\Http\DataLayer;

use App\Models\Patient;
use App\Models\PatientAlergy;
use App\Models\PatientDisease;
use App\Models\PatientImage;
use App\Models\PatientNextVisit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientDataLayer
{
    public function getAll()
    {
        return Patient::orderBy('id', 'DESC')->get()->isEmpty() ? [] : Patient::orderBy('id', 'DESC')->get();
    }
    
    public function getAllActive()
    {
        return Patient::orderBy('id', 'DESC')
        ->where('patient_center_id', Auth::user()->center_id)
        ->where('deleted_at', NULL)->get()->isEmpty() ? [] : Patient::orderBy('id', 'DESC')
        ->where('patient_center_id', Auth::user()->center_id)
        ->where('deleted_at', NULL)->get();
    }

    public function getById($id)
    {
        return $id === null ? null : Patient::with([
            'patientType',
            'orthodonticPlanType',
            'alergies',
            'disease',
            'parent', 
            'children',
        ])->findOrFail($id);
    }

    public function getPatientAlergy($id)
    {
        return PatientAlergy::where('patient_id', $id)->get();
    }

    public function getPatientDisease($id)
    {
        return PatientDisease::where('patient_id', $id)->get();
    }

    public function getPatientByType($id)
    {
        return Patient::where('patient_type_id', $id)->get();
    }

    public function insert($request)
    {
        try {
            $lastId = (Patient::where('patient_type_id', $request->input('patient_type_id'))->max('patient_register_id') ?? 0) + 1;

            $dataObj = Patient::create([
                'name' => trim($request->input('name')),
                'patient_register_id' => $lastId,
                'patient_nic_no' => trim($request->input('patient_nic_no')),
                'patient_incharge' => trim($request->input('patient_incharge')),
                'patient_address' => trim($request->input('patient_address')),
                'patient_contact_no' => trim($request->input('patient_contact_no')),
                'patient_gender' => trim($request->input('patient_gender')),
                'patient_age' => (int) $request->input('patient_age'),
                'patient_type_id' => (int) $request->input('patient_type_id'),
                'orthodontice_plan_id' => trim($request->input('orthodontice_plan_id')) ? trim($request->input('orthodontice_plan_id')) : null,
                'patient_center_id' => Auth::user()->center_id,
                'parent_patient_id' => $request->input('parent_patient_id') ? $request->input('parent_patient_id') : null,
                'isDisplay' => trim(intval($request->input('isDisplay'))) ? 1 : 0,
                'created_by' => Auth::user()->id,
            ]);
            
            $allergenIds = $request->input('allergen_ids');
            if (!is_null($allergenIds)) {
                foreach ($allergenIds as $allergen) {
                    PatientAlergy::create([
                        'patient_id' => $dataObj->id,
                        'alergy_id' => $allergen,
                    ]);
                }
            }

            $diseaseIds = $request->input('disease_ids');
            if (!is_null($diseaseIds)) {
                foreach ($diseaseIds as $disease) {
                    PatientDisease::create([
                        'patient_id' => $dataObj->id,
                        'disease_id' => $disease,
                    ]);
                }
            }

            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error inserting Patient : ' . $exception->getMessage());
            return null;
        }
    }

    public function update($request, $id)
    {
        try {
            $dataObj = $this->getById($id);
            $dataObj->name = trim($request->input('name'));
            $dataObj->patient_nic_no = trim($request->input('patient_nic_no'));
            $dataObj->patient_incharge = trim($request->input('patient_incharge'));
            $dataObj->patient_address = trim($request->input('patient_address'));
            $dataObj->patient_contact_no = trim($request->input('patient_contact_no'));
            $dataObj->patient_gender = trim($request->input('patient_gender'));
            $dataObj->patient_age = trim($request->input('patient_age'));
            $dataObj->patient_type_id = trim($request->input('patient_type_id'));
            $dataObj->orthodontice_plan_id = trim($request->input('orthodontice_plan_id')) ? trim($request->input('orthodontice_plan_id')) : null;
            $dataObj->isDisplay = trim($request->input('isDisplay')) ? 1 : 0;
            $dataObj->parent_patient_id = $request->input('parent_patient_id') ?: null;

            $dataObj->updated_by =  Auth::user()->id;

            PatientAlergy::where('patient_id', $id)->delete();
            $allergenIds = $request->input('allergen_ids');
            if (!is_null($allergenIds)) {
                foreach ($allergenIds as $allergen) {
                    PatientAlergy::create([
                        'patient_id' => $dataObj->id,
                        'alergy_id' => $allergen,
                    ]);
                }
            }

            PatientDisease::where('patient_id', $id)->delete();
            $diseaseIds = $request->input('disease_ids');
            if (!is_null($diseaseIds)) {
                foreach ($diseaseIds as $disease) {
                    PatientDisease::create([
                        'patient_id' => $dataObj->id,
                        'disease_id' => $disease,
                    ]);
                }
            }

            $dataObj->save();

            return $dataObj;
        } catch (QueryException $exception) {
            Log::error('Error updating Patient : ' . $exception->getMessage());
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $dataObjUpd = $this->getById($id);
            $dataObjUpd->updated_by =  Auth::user()->id;
            $dataObjUpd->save();

            $dataObjDel = $this->getById($id);
            $dataObjDel->delete();

            return $dataObjDel;
        } catch (QueryException $exception) {
            Log::error('Error deleting Patient : ' . $exception->getMessage());
            return null;
        }
    }

    public function doSearchingQuery($constraints)
    {
        $query = Patient::query()->orderBy('id', 'DESC');
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
            case 'patient_contact_no':
                $query->where($field, 'like', '%' . trim($constraint) . '%');
                break;
            case 'patient_type_id':
                $query->where($field, '=', trim($constraint));
                break;
            case 'isDisplay':
                $query->where($field, '=', trim($constraint));
                break;
            case 'start_date':
                $query->whereDate('created_at', '>=', trim($constraint));
                break;
            case 'end_date':
                $query->whereDate('created_at', '<=', trim($constraint));
                break;
        }
    }

    public function getLastId()
    {
        try {
            $data = Patient::withTrashed()->max('id');
            return $data ?? 0;
        } catch (QueryException $exception) {
            Log::error('Error getLastId Patient : ' . $exception->getMessage());
            return null;
        }
    }

    public function getTodayPatientRegisterCountByType()
    {
        try {
    
            return Patient::select(
                    'patient_type_id',
                    DB::raw('COUNT(*) as total')
                )
                ->whereDate('created_at', Carbon::today())
                ->where('patient_center_id', Auth::user()->center_id)
                ->groupBy('patient_type_id')
                ->with('patientType')
                ->get();
    
        } catch (QueryException $exception) {
            Log::error('Error getting today patient register count : ' . $exception->getMessage());
            return [];
        }
    }
    
    public function getTotalPatients($monthStart,$monthEnd,$type = null)
    {
        try {
            $centerId = Auth::user()->center_id;

            // dd($centerId, $monthStart, $monthEnd, $type);
    
            return Patient::whereBetween('created_at', [$monthStart, $monthEnd])
            ->where('patient_center_id', $centerId)
            ->when($type !== null, function ($query) use ($type) {
                $query->where('patient_type_id', $type);
            })
            ->count();
    
        } catch (QueryException $exception) {
            Log::error('Error getting today patient register count : ' . $exception->getMessage());
            return [];
        }
    }
}
