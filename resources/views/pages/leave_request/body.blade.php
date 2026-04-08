<div class="row">
    <div class="col-12 col-sm-12 col-md-9 col-lg-9">
        <div class="form-group row">
            <label for="name" class="form-label col-3 col-sm-3 col-md-3">Leave request reason
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <textarea class="form-control @error('name') is-invalid @enderror"
                id="name" name="name" 
                maxlength="255">{{ Request::old('name', $dataObj->name ?? '') }}</textarea>
                @error('name')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-3 col-lg-3">
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
