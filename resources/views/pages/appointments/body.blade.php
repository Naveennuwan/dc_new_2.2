<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_id" class="form-label col-3 col-sm-3 col-md-4">Select Patient</label>
            <div class="col-9 col-sm-9 col-md-8">
                <select
                    class="js-example-basic-single form-control @error('patient_id') is-invalid @enderror"
                    id="patient_id" name="patient_id">
                    <option value="" selected>select Patient</option>
                    @foreach ($patientObj as $patient)
                        <option
                            value="{{ $patient->id }}"
                            {{ old('patient_id', isset($dataObj) && $dataObj->patient_id == $patient->id ? $patient->id : '') == $patient->id ? 'selected' : '' }}>
                            
                            {{ $patient->patientType->name[0] }}P-{{ $patient->patient_register_id }}
                            - {{ $patient->name }}
                            - {{ $patient->patient_address }}
                            - {{ $patient->patient_contact_no }}
                        </option>
                    @endforeach
                    <input type="hidden" class="form-control @error('patient_id') is-invalid @enderror">
                    @error('patient_id')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_type_id" class="form-label col-3 col-sm-3 col-md-4">Select patient type</label>
            <div class="col-9 col-sm-9 col-md-8">
                <select
                    class="js-example-basic-single form-control @error('patient_type_id') is-invalid @enderror"
                    id="patient_type_id" name="patient_type_id">
                    <option value="" selected>select patient type</option>
                    @foreach ($patientTypeObj as $type)
                        <option
                            {{ old('patient_type_id', $dataObj['patient_type_id'] ?? '') == $type->id ? 'selected' : '' }}
                            value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>
                    @endforeach
                    <input type="hidden" class="form-control @error('patient_type_id') is-invalid @enderror">
                    @error('patient_type_id')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="name" class="form-label col-3 col-sm-3 col-md-4">Name</label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" placeholder="Name"
                    value="{{ Request::old('name', $dataObj->name ?? '') }}" maxlength="255">
                @error('name')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
       <div class="form-group row">
            <label for="contact_no" class="form-label col-3 col-sm-3 col-md-4">Contact No</label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('contact_no') is-invalid @enderror"
                    id="contact_no" name="contact_no" placeholder="Contact no"
                    value="{{ Request::old('contact_no', $dataObj->contact_no ?? '') }}" maxlength="255">
                @error('contact_no')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="doctor_id" class="form-label col-3 col-sm-3 col-md-4">Select Doctor</label>
            <div class="col-9 col-sm-9 col-md-8">
                <select
                    class="js-example-basic-single form-control @error('doctor_id') is-invalid @enderror"
                    id="doctor_id" name="doctor_id">
                    <option value="" selected>select Doctor</option>
                    @foreach ($doctorObj as $doctor)
                        <option
                            {{ old('doctor_id', isset($dataObj) && $dataObj->doctor_id == $doctor->id ? $doctor->id : '') == $doctor->id ? 'selected' : '' }}
                            value="{{ $doctor->id }}">
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                    <input type="hidden" class="form-control @error('doctor_id') is-invalid @enderror">
                    @error('doctor_id')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
            </div>
        </div>
    </div>
    
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="remark" class="form-label col-3 col-sm-3 col-md-4">Select Remark</label>
            <div class="col-9 col-sm-9 col-md-8">
                <select
                    class="js-example-basic-single form-control @error('remark') is-invalid @enderror"
                    id="remark" name="remark">
                    <option value="" selected>select Doctor</option>
                    <option value="on_call" selected>On Call</option>
                    <option value="riception" selected>Riception</option>
                    
                    <input type="hidden" class="form-control @error('remark') is-invalid @enderror">
                    @error('remark')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="appointment_date" class="form-label col-3 col-sm-3 col-md-4">Date</label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="date" class="form-control @error('appointment_date') is-invalid @enderror"
                    id="appointment_date" name="appointment_date" placeholder="appointment_date"
                    value="{{ Request::old('appointment_date', $dataObj->appointment_date ?? '') }}" maxlength="255">
                @error('appointment_date')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="appointment_time" class="form-label col-3 col-sm-3 col-md-4">Time</label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="time" class="form-control @error('appointment_time') is-invalid @enderror"
                    id="appointment_time" name="appointment_time" placeholder="appointment_time"
                    value="{{ Request::old('appointment_time', $dataObj->appointment_time ?? '') }}" maxlength="255">
                @error('appointment_time')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
@push('css')
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $("#isDisplay").on("change", function() {
                var input = this;
                var isChecked = $(input).prop("checked");
                $isDisplayValue = isChecked ? 1 : 0
                $(input).val($isDisplayValue);
            });
        });
    </script>
@endpush
