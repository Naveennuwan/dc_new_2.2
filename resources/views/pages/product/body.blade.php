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
            <label for="brand_id" class="form-label col-3 col-sm-3 col-md-4">Brand
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('brand_id') is-invalid @enderror"
                    id="brand_id" name="brand_id">
                    <option value="" selected>select brand</option>
                    @foreach ($brandObj as $brand)
                    <option
                            {{ old('brand_id', isset($dataObj) && $dataObj->brand_id == $brand->id ? $brand->id : '') == $brand->id ? 'selected' : '' }}
                            value="{{ $brand->id }}">
                            {{ $brand->name }}
                        </option>

                    @endforeach
                    <input type="hidden" class="form-control @error('brand_id') is-invalid @enderror">
                    @error('brand_id')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="category_id" class="form-label col-3 col-sm-3 col-md-4">Category
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('category_id') is-invalid @enderror"
                    id="category_id" name="category_id">
                    <option value="" selected>select category</option>
                    @foreach ($categoryObj as $category)
                    <option
                            {{ old('category_id', isset($dataObj) && $dataObj->category_id == $category->id ? $category->id : '') == $category->id ? 'selected' : '' }}
                            value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>

                    @endforeach
                    <input type="hidden" class="form-control @error('category_id') is-invalid @enderror">
                    @error('category_id')
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
            <label for="product_type_id" class="form-label col-3 col-sm-3 col-md-4">Product Type
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('product_type_id') is-invalid @enderror"
                    id="product_type_id" name="product_type_id">
                    <option value="" selected>select product type</option>
                    @foreach ($productTypeObj as $type)
                    <option
                            {{ old('product_type_id', isset($dataObj) && $dataObj->product_type_id == $type->id ? $type->id : '') == $type->id ? 'selected' : '' }}
                            value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>

                    @endforeach
                    <input type="hidden" class="form-control @error('product_type_id') is-invalid @enderror">
                    @error('product_type_id')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="supplier_id" class="form-label col-3 col-sm-3 col-md-4">Supplier
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('supplier_id') is-invalid @enderror"
                    id="supplier_id" name="supplier_id">
                    <option value="" selected>select supplier</option>
                    @foreach ($supplierObj as $supplier)
                    <option
                            {{ old('supplier_id', isset($dataObj) && $dataObj->supplier_id == $supplier->id ? $supplier->id : '') == $supplier->id ? 'selected' : '' }}
                            value="{{ $supplier->id }}">
                            {{ $supplier->name }}
                        </option>

                    @endforeach
                    <input type="hidden" class="form-control @error('supplier_id') is-invalid @enderror">
                    @error('supplier_id')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
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
