<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_id" class="form-label col-3 col-sm-3 col-md-4">Select Pateint
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('patient_id') is-invalid @enderror"
                    id="patient_id" name="patient_id">
                    <option value="" selected>select Pateint</option>
                    @foreach ($patientObj as $patient)
                    <option
                            {{ old('patient_id', isset($dataObj) && $dataObj->patient_id == $patient->id ? $patient->id : '') == $patient->id ? 'selected' : '' }}
                            value="{{ $patient->id }}">
                            {{ $patient->name }}
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
            <label for="leave_requests_id" class="form-label col-3 col-sm-3 col-md-4">Select Request
                <span class="text-danger">*</span>
            </label>
            <div class="col-9 col-sm-9 col-md-8">
                <select class="js-example-basic-single form-control @error('leave_requests_id') is-invalid @enderror"
                    id="leave_requests_id" name="leave_requests_id"> <option value="" selected>select Request</option>
                    @foreach ($leaveRequestObj as $request)
                    <option
                            {{ old('leave_requests_id', isset($dataObj) && $dataObj->leave_requests_id == $request->id ? $request->id : '') == $request->id ? 'selected' : '' }}
                            value="{{ $request->id }}">
                            {{ $request->name }}
                        </option>

                    @endforeach
                    <input type="hidden" class="form-control @error('leave_requests_id') is-invalid @enderror">
                    @error('reson')
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
            <label for="doctor_id" class="form-label col-3 col-sm-3 col-md-4">Select Doctor
                <span class="text-danger">*</span></label>
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
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="from_date" class="form-label col-3 col-sm-3 col-md-4">From Date
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="date" class="form-control @error('from_date') is-invalid @enderror"
                    id="from_date" name="from_date" placeholder="from_date"
                    value="{{ Request::old('from_date', $dataObj->from_date ?? '') }}" maxlength="255">
                @error('from_date')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="to_date" class="form-label col-3 col-sm-3 col-md-4">To Date
                <span class="text-danger">*</span>
            </label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="date" class="form-control @error('to_date') is-invalid @enderror"
                    id="to_date" name="to_date" placeholder="to_date"
                    value="{{ Request::old('to_date', $dataObj->to_date ?? '') }}" maxlength="255">
                @error('to_date')
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
