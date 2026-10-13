<div class="appointment-form">
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="patient_id" class="form-label">
                    Select Patient
                </label>

                <select
                    class="js-example-basic-single form-control @error('patient_id') is-invalid @enderror"
                    id="patient_id"
                    name="patient_id">
                    <option value="">Select Patient</option>

                    @foreach ($patientObj as $patient)
                        <option
                            value="{{ $patient->id }}"
                            {{ old('patient_id', $dataObj->patient_id ?? '') == $patient->id ? 'selected' : '' }}>
                            {{ $patient->patientType->name[0] ?? '' }}P-{{ $patient->patient_register_id }}
                            - {{ $patient->name }}
                            - {{ $patient->patient_address }}
                            - {{ $patient->patient_contact_no }}
                        </option>
                    @endforeach
                </select>

                @error('patient_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="patient_type_id" class="form-label">
                    Select Patient Type
                </label>

                <select
                    class="js-example-basic-single form-control @error('patient_type_id') is-invalid @enderror"
                    id="patient_type_id"
                    name="patient_type_id">
                    <option value="">Select Patient Type</option>

                    @foreach ($patientTypeObj as $type)
                        <option
                            value="{{ $type->id }}"
                            {{ old('patient_type_id', $dataObj->patient_type_id ?? '') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>

                @error('patient_type_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        <div class="form-group row">
            <label for="name" class="form-label col-3 col-sm-3 col-md-4">
                Name
            </label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    placeholder="Name"
                    value="{{ old('name', $dataObj->name ?? '') }}"
                    maxlength="255"
                    required>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group row">
            <label for="contact_no" class="form-label col-3 col-sm-3 col-md-4">
                Contact No
            </label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text"
                    class="form-control @error('contact_no') is-invalid @enderror"
                    id="contact_no"
                    name="contact_no"
                    placeholder="Contact no"
                    value="{{ old('contact_no', $dataObj->contact_no ?? '') }}"
                    maxlength="255"
                    required>

                @error('contact_no')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-12">
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
    </div>

    <div class="row">
        <div class="col-12">
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
</div>

@push('css')
<style>
    .select2-container .select2-selection--single {
        height: 38px;
    }

    .appointment-form {
        width: 100%;
        max-width: 100%;
    }

    .appointment-form .row {
        row-gap: 8px;
    }

    .appointment-form .form-group {
        margin-bottom: 16px;
        min-width: 0;
    }

    .appointment-form .form-label {
        display: block;
        width: 100%;
        margin-bottom: 6px;
        font-weight: 600;
        font-size: 14px;
        color: #444;
    }

    .appointment-form .form-control {
        width: 100%;
        min-width: 0;
        min-height: 38px;
        box-sizing: border-box;
    }

    /* Select2 dropdown fields */
    .appointment-form .select2-container {
        width: 100% !important;
        max-width: 100%;
    }

    .appointment-form .select2-container .select2-selection--single {
        height: 38px;
        display: flex;
        align-items: center;
        box-sizing: border-box;
    }

    .appointment-form .select2-container .select2-selection__rendered {
        line-height: 36px;
        padding-right: 30px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .appointment-form .select2-container .select2-selection__arrow {
        height: 36px;
    }

    .appointment-form .invalid-feedback {
        display: block;
    }

    /* Tablets */
    @media (max-width: 768px) {
        .appointment-form .form-group {
            margin-bottom: 14px;
        }

        .appointment-form .form-label {
            font-size: 14px;
        }
    }

    /* Mobile phones */
    @media (max-width: 576px) {
        .appointment-form .row {
            margin-left: -8px;
            margin-right: -8px;
        }

        .appointment-form .row > [class*="col-"] {
            padding-left: 8px;
            padding-right: 8px;
        }

        .appointment-form .form-group {
            margin-bottom: 12px;
        }

        .appointment-form .form-label {
            margin-bottom: 5px;
            font-size: 13px;
        }

        .appointment-form .form-control,
        .appointment-form .select2-container .select2-selection--single {
            min-height: 42px;
            font-size: 14px;
        }

        .appointment-form .select2-container .select2-selection__rendered {
            line-height: 40px;
        }

        .appointment-form .select2-container .select2-selection__arrow {
            height: 40px;
        }
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
    
<script>
    $(document).ready(function () {

        function togglePatientFields() {
            var patientSelected = $('#patient_id').val() !== '';

            // Name field
            $('#name')
                .prop('disabled', patientSelected)
                .prop('required', !patientSelected);

            // Contact number field
            $('#contact_no')
                .prop('disabled', patientSelected)
                .prop('required', !patientSelected);
        }

        // Run when the patient selection changes
        $('#patient_id').on('change', function () {
            togglePatientFields();
        });

        // Set the correct state when the form loads
        togglePatientFields();

        // Keep your existing checkbox logic
        $("#isDisplay").on("change", function () {
            var isChecked = $(this).prop("checked");
            $(this).val(isChecked ? 1 : 0);
        });

    });
</script>
@endpush
