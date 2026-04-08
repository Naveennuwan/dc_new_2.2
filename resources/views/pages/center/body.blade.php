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
            <label for="name_sin" class="form-label col-3 col-sm-3 col-md-4">Name_Sinhala
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('name_sin') is-invalid @enderror"
                    id="name_sin" name="name_sin" placeholder="Name_Sinhala"
                    value="{{ Request::old('name_sin', $dataObj->name ?? '') }}" maxlength="255">
                @error('name_sin')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <!--div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <input type="checkbox" id="isDisplay" name="isDisplay" value="1"
                        {{ Request::old('isDisplay', isset($dataObj) && $dataObj->isDisplay ? '1' : '') == '1' ? 'checked' : '' }}>
                </div>
            </div>
            <label for="isDisplay" class="form-label col-3 col-sm-3 col-md-4">Display</label>
        </div>
    </div-->
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="address_01" class="form-label col-3 col-sm-3 col-md-4">Address 01
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('address_01') is-invalid @enderror"
                    id="address_01" name="address_01" placeholder="address_01"
                    value="{{ Request::old('address_01', $dataObj->address_01 ?? '') }}" maxlength="255">
                @error('address_01')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="address_01_sin" class="form-label col-3 col-sm-3 col-md-4">Address 01_Sinhala
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('address_01') is-invalid @enderror"
                    id="address_01_sin" name="address_01_sin" placeholder="address_01_sinhala"
                    value="{{ Request::old('address_01_sin', $dataObj->address_01 ?? '') }}" maxlength="255">
                @error('address_01_sin')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">      
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="address_02" class="form-label col-3 col-sm-3 col-md-4">Address 02
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('address_02') is-invalid @enderror"
                    id="address_02" name="address_02" placeholder="address_02"
                    value="{{ Request::old('address_02', $dataObj->address_02 ?? '') }}" maxlength="255">
                @error('address_02')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="address_02_sinhala" class="form-label col-3 col-sm-3 col-md-4">Address 02_Sinhala
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('address_02_sinhala') is-invalid @enderror"
                    id="address_02_sinhala" name="address_02_sinhala" placeholder="address_02_Sinhala"
                    value="{{ Request::old('address_02_sinhala', $dataObj->address_02 ?? '') }}" maxlength="255">
                @error('address_02_sinhala')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="week_days" class="form-label col-3 col-sm-3 col-md-4">Week Days Discri...
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('week_days') is-invalid @enderror"
                    id="week_days" name="week_days" placeholder="week_days"
                    value="{{ Request::old('week_days', $dataObj->week_days ?? '') }}" maxlength="255">
                @error('week_days')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="week_days_sin" class="form-label col-3 col-sm-3 col-md-4">Week Days Sinhala
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('week_days_sin') is-invalid @enderror"
                    id="week_days_sin" name="week_days_sin" placeholder="week_days_sinhala"
                    value="{{ Request::old('week_days_sin', $dataObj->week_days ?? '') }}" maxlength="255">
                @error('week_days_sin')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>   
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="week_day_service_time" class="form-label col-3 col-sm-3 col-md-4">Service Time
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('week_day_service_time') is-invalid @enderror"
                    id="week_day_service_time" name="week_day_service_time" placeholder="week_day_service_time"
                    value="{{ Request::old('week_day_service_time', $dataObj->week_day_service_time ?? '') }}" maxlength="255">
                @error('week_day_service_time')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="week_day_service_time_sin" class="form-label col-3 col-sm-3 col-md-4">Service Time Sin..
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('week_day_service_time_sin') is-invalid @enderror"
                    id="week_day_service_time_sin" name="week_day_service_time_sin" placeholder="week_day_service_time_sinhala"
                    value="{{ Request::old('week_day_service_time_sin', $dataObj->week_day_service_time ?? '') }}" maxlength="255">
                @error('week_day_service_time_sin')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="week_ends" class="form-label col-3 col-sm-3 col-md-4">Weekends Discri...
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('week_ends') is-invalid @enderror"
                    id="week_ends" name="week_ends" placeholder="week_ends"
                    value="{{ Request::old('week_ends', $dataObj->week_ends ?? '') }}" maxlength="255">
                @error('week_ends')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="week_ends_sin" class="form-label col-3 col-sm-3 col-md-4">Weekends Sinhala
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('week_ends_sin') is-invalid @enderror"
                    id="week_ends_sin" name="week_ends_sin" placeholder="week_ends_sinhala"
                    value="{{ Request::old('week_ends_sin', $dataObj->week_ends ?? '') }}" maxlength="255">
                @error('week_ends_sin')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="week_ends_service_time" class="form-label col-3 col-sm-3 col-md-4">Service Time
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('week_ends_service_time') is-invalid @enderror"
                    id="week_ends_service_time" name="week_ends_service_time" placeholder="week_ends_service_time"
                    value="{{ Request::old('week_ends_service_time', $dataObj->week_ends_service_time ?? '') }}" maxlength="255">
                @error('week_ends_service_time')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="week_ends_service_time_sin" class="form-label col-3 col-sm-3 col-md-4">Service Time Sin..
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('week_ends_service_time_sin') is-invalid @enderror"
                    id="week_ends_service_time_sin" name="week_ends_service_time_sin" placeholder="week_ends_service_time_sinhala"
                    value="{{ Request::old('week_ends_service_time_sin', $dataObj->week_ends_service_time ?? '') }}" maxlength="255">
                @error('week_ends_service_time_sin')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="contact_no" class="form-label col-3 col-sm-3 col-md-4">Contact no
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('contact_no') is-invalid @enderror"
                    id="contact_no" name="contact_no" placeholder="contact_no"
                    value="{{ Request::old('contact_no', $dataObj->contact_no ?? '') }}" maxlength="10">
                @error('contact_no')
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
