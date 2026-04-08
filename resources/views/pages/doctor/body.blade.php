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
            <label for="designation" class="form-label col-3 col-sm-3 col-md-4">Designation
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('designation') is-invalid @enderror"
                    id="designation" name="designation" placeholder="Designation"
                    value="{{ Request::old('designation', $dataObj->designation ?? '') }}" maxlength="255">
                @error('designation')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="base_hospital" class="form-label col-3 col-sm-3 col-md-4">Base Hospital
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('base_hospital') is-invalid @enderror"
                    id="base_hospital" name="base_hospital" placeholder="Base Hospital"
                    value="{{ Request::old('base_hospital', $dataObj->base_hospital ?? '') }}" maxlength="255">
                @error('base_hospital')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="campus" class="form-label col-3 col-sm-3 col-md-4">Campus
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('campus') is-invalid @enderror"
                    id="campus" name="campus" placeholder="Campus"
                    value="{{ Request::old('campus', $dataObj->campus ?? '') }}" maxlength="255">
                @error('campus')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="slmc_reg_no" class="form-label col-3 col-sm-3 col-md-4">SLMC Register no.
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('slmc_reg_no') is-invalid @enderror"
                    id="slmc_reg_no" name="slmc_reg_no" placeholder="SLMC Register no."
                    value="{{ Request::old('slmc_reg_no', $dataObj->slmc_reg_no ?? '') }}" maxlength="255">
                @error('slmc_reg_no')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="contact" class="form-label col-3 col-sm-3 col-md-4">Contact No
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('contact') is-invalid @enderror"
                    id="contact" name="contact" placeholder="Contact No"
                    value="{{ Request::old('contact', $dataObj->contact ?? '') }}" maxlength="255">
                @error('contact')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

@push('css')
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
