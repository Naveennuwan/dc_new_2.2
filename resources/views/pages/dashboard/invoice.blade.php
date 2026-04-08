@extends('layouts.app')

@section('title', __('Routine Invoice'))

@section('toolbar')
    <div class="toolbar modern-toolbar">
        <div class="row col-12 col-sm-12 col-md-12 align-items-center">
            <div class="col-12 col-sm-5 col-md-6">
                <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">{{$routeName}} Invoice</h6>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-right">
                <div class="btn-toolbar justify-content-end text-right" role="toolbar" aria-label="Toolbar with button groups">
                    @include('components.toolbar', ['showExportButton' => false, 'showSearchButton' => true])
                    @if(is_object($patientDetails))
                    <div class="btn-group" role="group">
                        <button id="invoice-btn" class="modern-btn btn-lime fixed-width-button-130">Invoice</button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="card mb-2">
    <div class="card-body">
        <div class="row g-3">
            <!-- Patient -->
            <div class="col-12 col-md-8">
                <label for="patient_id" class="form-label">Patient</label>
                <select
                    class="js-example-basic-single form-control @error('patient_id') is-invalid @enderror"
                    id="patient_id"
                    name="patient_id"
                >
                    <option value="">Select patient</option>
                    @foreach ($patientObj as $patient)
                        <option
                            value="{{ $patient->id }}"
                            {{ old('patient_id', $searchingVals['patient_id'] ?? '') == $patient->id ? 'selected' : '' }}
                        >
                            {{ $patient->patientType->name[0] }}P-{{ $patient->patient_register_id }}
                            - {{ $patient->name }}
                            - {{ $patient->patient_address }}
                            - {{ $patient->patient_contact_no }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Doctor -->
            <div class="col-12 col-md-4">
                <label for="doctor_id" class="form-label">Doctor</label>
                <select
                    class="js-example-basic-single form-control @error('doctor_id') is-invalid @enderror"
                    id="doctor_id"
                    name="doctor_id"
                >
                    <option value="">Select doctor</option>
                    @foreach ($doctorObj as $doctor)
                        <option
                            value="{{ $doctor->id }}"
                            {{ old('doctor_id', $searchingVals['doctor_id'] ?? '') == $doctor->id ? 'selected' : '' }}
                        >
                            {{ $doctor->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        @if($patientDetails)
        <div style="display: flex; justify-content: center; align-Items:center; gap: 10px;">
            <div class="btn-group" role="group">
                <button id="advance-btn" style="width: 200px; height: 40px; font-size: 1rem;" class="modern-btn btn-lime" 
                    data-toggle="modal" data-target="#advanceModal">
                    <i class="fas fa-wallet mr-2"></i>
                    Add Advance
                </button>
            </div>
            <div class="btn-group" role="group">
                <button id="discount-btn"  style="width: 200px; height: 40px; font-size: 1rem;" class="modern-btn btn-lime" 
                    data-toggle="modal" data-target="#discountModal">
                    <i class="fas fa-tag mr-2"></i>
                    Add Discount
                </button>
            </div>
            <div class="btn-group" role="group">
                <button id="next-visit-btn" style="width: 200px; height: 40px; font-size: 1rem;" class="modern-btn btn-peach"
                    data-toggle="modal" data-target="#nextVisitModal">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    Add Next Visit
                </button>
            </div>
            <div class="btn-group" role="group">
                <button id="image-upload-btn" style="width: 200px; height: 40px; font-size: 1rem;" class="modern-btn btn-aqua"
                    data-toggle="modal" data-target="#imageUploadModal">
                    <i class="fas fa-upload mr-2"></i>
                    Upload Image
                </button>
            </div>
            <div class="btn-group" role="group">
                <button id="image-view-btn" style="width: 200px; height: 40px; font-size: 1rem;" class="modern-btn btn-aqua"
                    data-toggle="modal" data-target="#imageViewdModal">
                    <i class="fas fa-eye mr-2"></i>
                    View Images
                </button>
            </div>
        </div>
        <div class="form-row mt-3">
                <div class="form-group col-6 col-sm-6">
                    <label >Age :- </label>
                    {{$patientDetails->patient_age}}
                </div>
                <div class="form-group col-6 col-sm-6">
                    <label >Center :- </label>
                    {{$patientDetails->center->name}}
                </div>
            </div>

            @if($patientDetails->orthodonticPlanType)
            <div class="form-row">
                <div class="form-group col-6 col-sm-4">
                    <label >{{$templateDetails->name}} :- {{$templateDetails->price}}</label> /=<br/>
                </div>
            </div>
            @endif
            <div class="form-row">
                @if(count($alergies))
                <div class="form-group">
                    <label for="patient_id">Alergies :- </label>
                    @foreach ($alergies as $alergy)
                    {{$alergy->alergy->name}},
                    @endforeach
                </div>
                @endif
            </div>
            <div class="form-row">
                @if(count($diseases))
                <div class="form-group">
                    <label for="patient_id">Disease :- </label>
                    @foreach ($diseases as $disease)
                    {{$disease->disease->name}},
                    @endforeach
                </div>
                @endif
            </div>
            @endif
    </div>
</div>
@endsection

@section('content2')
<div class="row">
    <div class="form-group col-6 col-sm-6">
        @include('pages.dashboard.templates')
    </div>
    <div class="form-group col-6 col-sm-6">
        @include('pages.dashboard.patient_details')
    </div>
</div>
@include('pages.dashboard.model')
@endsection

@push('css')
@endpush

@push('js')

<!-- Button Clicks -->
<script>
    $(function () {
    // Make sure no duplicate select2 scripts are loaded.
    if (typeof $.fn.select2 === 'undefined') {
        console.error('Select2 is not loaded!');
        return;
    }

    // Optional: destroy if already initialized (prevents double-init issues)
    $('#patient_id').each(function () {
        if ($(this).data('select2')) $(this).select2('destroy');
    });
    $('#doctor_id').each(function () {
        if ($(this).data('select2')) $(this).select2('destroy');
    });

    // Initialize selects explicitly
    $('#patient_id').select2({
        width: '100%',
        placeholder: 'Select patient',
        allowClear: true
    });

    $('#doctor_id').select2({
        width: '100%',
        placeholder: 'Select doctor',
        allowClear: true
    });

    // If you also use the generic class, you can init remaining ones:
    $('.js-example-basic-multiple').not('#patient_id, #doctor_id').select2({ width: '100%' });
    });

    $(document).ready(function () {
        $('#search-btn').on('click', function (e) {
            e.preventDefault();

            const patientEl = document.getElementById('patient_id');
            const doctorEl  = document.getElementById('doctor_id');

            const patientId = patientEl ? patientEl.value : null;
            const doctorId  = doctorEl ? doctorEl.value : null;

            console.log(patientId)
            console.log(doctorId)

            if (!patientId) {
                alert('Please select a patient');
                return;
            }

            let url = `{{ url('/invoice') }}/${patientId}`;

            if (doctorId) {
                url += `/${doctorId}`;
            }

            window.location.href = url;
        });
    });
</script>

<!--Model Submit Button Clicks -->
<script>
    $(document).ready(function() {
        $('#advance-btn').on('click', function() {
            $('#advanceModal').modal('show');
        });
    });

    $(document).ready(function() {
        $('#discount-btn').on('click', function() {
            $('#discountModal').modal('show');
        });
    });
    
    $(document).ready(function() {
        $('#next-visit-btn').on('click', function() {
            $('#nextVisitModal').modal('show');
        });
    });
    
    $(document).ready(function() {
        $('#image-upload-btn').on('click', function() {
            $('#imageUploadModal').modal('show');
        });
    });
    
    $(document).ready(function() {
        $('#image-view-btn').on('click', function() {
            $('#imageViewModal').modal('show');
        });
    });
    
    $(document).ready(function() {
        $('#invoice-btn').on('click', function() {
            $('#invoiceModal').modal('show');
        });
    });
</script>

@endpush