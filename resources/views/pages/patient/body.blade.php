<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="name" class="form-label col-3 col-sm-3 col-md-4">Name
                <span class="text-danger">*</span></label>
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
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" id="isDisplay" name="isDisplay" value="1"
                        {{ Request::old('isDisplay', isset($dataObj) && $dataObj->isDisplay ? '1' : '') == '1' ? 'checked' : '' }}>
                </div>
            </div>
            <label for="isDisplay" class="form-label col-3 col-sm-3 col-md-4">Display</label>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_nic_no" class="form-label col-3 col-sm-3 col-md-4">Nic No.
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('patient_nic_no') is-invalid @enderror"
                id="patient_nic_no" name="patient_nic_no" placeholder="Nic No."
                value="{{ Request::old('patient_nic_no', $dataObj->patient_nic_no ?? '') }}" maxlength="255">
                @error('patient_nic_no')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_incharge" class="form-label col-3 col-sm-3 col-md-4">Patient incharge</label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('patient_incharge') is-invalid @enderror"
                    id="patient_incharge" name="patient_incharge" placeholder="Patient incharge"
                    value="{{ Request::old('patient_incharge', $dataObj->patient_incharge ?? '') }}" maxlength="255">
                @error('patient_incharge')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_address" class="form-label col-3 col-sm-3 col-md-4">Address
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('patient_address') is-invalid @enderror"
                    id="patient_address" name="patient_address" placeholder="Address"
                    value="{{ Request::old('patient_address', $dataObj->patient_address ?? '') }}" maxlength="255">
                @error('patient_address')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_contact_no" class="form-label col-3 col-sm-3 col-md-4">Contact No
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('patient_contact_no') is-invalid @enderror"
                    id="patient_contact_no" name="patient_contact_no" placeholder="Contact No"
                    value="{{ Request::old('patient_contact_no', $dataObj->patient_contact_no ?? '') }}" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('patient_contact_no')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_gender" class="form-label col-3 col-sm-3 col-md-4">Gender
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('patient_gender') is-invalid @enderror"
                    id="patient_gender" name="patient_gender">
                    <option value="" selected>select Gender</option>
                    <option
                        {{ old('patient_gender', isset($dataObj) && $dataObj->patient_gender == "Male" ? "Male" : '') == "Male" ? 'selected' : '' }}
                        value="Male">
                        Male
                    </option>
                    <option
                        {{ old('patient_gender', isset($dataObj) && $dataObj->patient_gender == "Female" ? "Female" : '') == "Female" ? 'selected' : '' }}
                        value="Female">
                        Female
                    </option>
                    <input type="hidden" class="form-control @error('patient_gender') is-invalid @enderror">
                    @error('patient_gender')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_age" class="form-label col-3 col-sm-3 col-md-4">Age
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('patient_age') is-invalid @enderror"
                    id="patient_age" name="patient_age" placeholder="Address"
                    value="{{ Request::old('patient_age', $dataObj->patient_age ?? '') }}" maxlength="2" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                @error('patient_age')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="patient_type_id" class="form-label col-3 col-sm-3 col-md-4">Patient Type
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('patient_type_id') is-invalid @enderror"
                    id="patient_type_id" name="patient_type_id">
                    <option value="" selected>select patient type</option>
                    @foreach ($patientTypes as $type)
                    <option
                            {{ old('patient_type_id', isset($dataObj) && $dataObj->patient_type_id == $type->id ? $type->id : '') == $type->id ? 'selected' : '' }}
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
    <div id="Orthodontice_Plan_Area" class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="orthodontice_plan_id" class="form-label col-3 col-sm-3 col-md-4">Orthodontice Plan
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('orthodontice_plan_id') is-invalid @enderror"
                    id="orthodontice_plan_id" name="orthodontice_plan_id">
                    <option value="" selected>select orthodontice plan</option>
                    @foreach ($orthodonticPlans as $plan)
                    <option 
                            {{ old('orthodontice_plan_id', isset($dataObj) && $dataObj->orthodontice_plan_id == $plan->id ? $plan->id : '') == $plan->id ? 'selected' : '' }}
                            value="{{ $plan->id }}">
                            {{ $plan->name }}
                        </option>

                    @endforeach
                    <input type="hidden" class="form-control @error('orthodontice_plan_id') is-invalid @enderror">
                    @error('orthodontice_plan_id')
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
            <label for="parent_patient_id" class="form-label col-3 col-sm-3 col-md-4">Parent Patient</label>
            <div class="col-9 col-sm-9 col-md-8">
                <select
                    class="js-example-basic-single form-control @error('parent_patient_id') is-invalid @enderror"
                    id="parent_patient_id" name="parent_patient_id">
                    <option value="">Select Parent Patient</option>
                    @foreach ($patients as $patient)
                        {{-- Prevent selecting itself as a parent --}}
                        @if (!isset($dataObj) || $dataObj->id !== $patient->id)
                            <option
                                {{ old('parent_patient_id', $dataObj->parent_patient_id ?? '') == $patient->id ? 'selected' : '' }}
                                value="{{ $patient->id }}">
                                {{ $patient->name }} ({{ $patient->patient_contact_no }})
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('parent_patient_id')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>


<div class="form-group row">
    <label for="allergen" class="form-label col-3 col-sm-3 col-md-2">Alergy</label>
    <div class="col-9 col-sm-9 col-md-10">
        @if (count($alergys))
            @foreach ($alergys as $allergen)
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="allergen_ids[]"
                id="allergen_{{ $allergen->id }}" value="{{ $allergen->id }}"
                {{ old('patientAlergies', isset($patientAlergies) && $patientAlergies->contains('alergy_id', $allergen->id)) ? 'checked' : '' }}>
                <label class="form-check-label" for="allergen_{{ $allergen->id }}">{{ $allergen->name }}</label>
                </div>
            @endforeach
        @endif
    </div>
</div>

<div class="form-group row">
    <label for="disease" class="form-label col-3 col-sm-3 col-md-2">Diseases</label>
    <div class="col-9 col-sm-9 col-md-10">
        @if (count($diseases))
            @foreach ($diseases as $disease)
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="disease_ids[]"
                        id="disease_{{ $disease->id }}" value="{{ $disease->id }}"
                        {{ old('patientDiseases', isset($patientDiseases) && $patientDiseases->contains('disease_id', $disease->id) ? 'checked' : '') }}>
                    <label class="form-check-label" for="disease_{{ $disease->id }}">{{ $disease->name }}</label>
                </div>
            @endforeach
        @endif
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

    <script>
        $(document).ready(function() {
            function toggleOrthodonticPlanArea() {
                const patientTypeId = $('#patient_type_id').val();
                if (patientTypeId === '2') {
                    $('#Orthodontice_Plan_Area').show();
                } else {
                    $('#Orthodontice_Plan_Area').hide();
                }
            }

            // Initial check
            toggleOrthodonticPlanArea();

            // On change event
            $('#patient_type_id').change(function() {
                toggleOrthodonticPlanArea();
            });
        });
    </script>


<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        var patientTypeSelect = document.getElementById('patient_type_id');
        const orthoPlanArea = document.getElementById('Orthodontice_Plan_Area');

        // console.log(patientTypeSelect).value;
        // console.log(orthoPlanArea);
        console.log(patientTypeSelect.value);

        // Debugging: Ensure elements are selected
        console.log('Patient Type Select Element:', patientTypeSelect);
        console.log('Orthodontice Plan Area Element:', orthoPlanArea);

        // Check if the elements exist
        if (!patientTypeSelect || !orthoPlanArea) {
            console.error('One or more elements are not found in the DOM.');
            return;
        }

// Ensure the event listener is added correctly
patientTypeSelect.addEventListener('change', function () {
    console.log('Patient type changed:', this.value);
    if (this.value == 1) {
        orthoPlanArea.style.display = 'block';
    } else {
        orthoPlanArea.style.display = 'none';
    }
});

        patientTypeSelect.addEventListener('change', function () {
            console.log('Patient type changed:', this.value);
            if (this.value == 1) {
                orthoPlanArea.style.display = 'block';
            } else {
                orthoPlanArea.style.display = 'none';
            }
        });

        // Check the initial state on page load
        if (patientTypeSelect.value == 1) {
            orthoPlanArea.style.display = 'block';
        } else {
            orthoPlanArea.style.display = 'none';
        }
    });
</script> -->

    <!-- <script>
        // When click radio button yes or no handle
        function checkRadioButton(radio) {
            const patientTypeSelect = document.getElementById('patient_type_id');
            const orthoPlanArea = document.getElementById('Orthodontice_Plan_Area');

            if (patientTypeSelect.value == 1) {
                patientTypeSelect.style.display = '';
                orthoPlanArea.style.display = 'none';
            } else {
                patientTypeSelect.style.display = 'none';
                orthoPlanArea.style.display = '';
            }
        }
    </script> -->
@endpush
