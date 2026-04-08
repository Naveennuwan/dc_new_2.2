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
            <label for="template_category_id" class="form-label col-3 col-sm-3 col-md-4">Template Category
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('template_category_id') is-invalid @enderror"
                    id="template_category_id" name="template_category_id">
                    <option value="" selected>select category</option>
                    @foreach ($templateCategoryObj as $category)
                    <option
                            {{ old('template_category_id', isset($dataObj) && $dataObj->template_category_id == $category->id ? $category->id : '') == $category->id ? 'selected' : '' }}
                            value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                    <input type="hidden" class="form-control @error('template_category_id') is-invalid @enderror">
                    @error('template_category_id')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="template_type_id" class="form-label col-3 col-sm-3 col-md-4">Template Type
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
            <select
                    class="js-example-basic-single form-control @error('template_type_id') is-invalid @enderror"
                    id="template_type_id" name="template_type_id">
                    <option value="" selected>select type</option>
                    @foreach ($templateTypeObj as $type)
                    <option
                            {{ old('template_type_id', isset($dataObj) && $dataObj->template_type_id == $type->id ? $type->id : '') == $type->id ? 'selected' : '' }}
                            value="{{ $type->id }}">
                            {{ $type->name }}
                        </option>

                    @endforeach
                    <input type="hidden" class="form-control @error('template_type_id') is-invalid @enderror">
                    @error('template_type_id')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </select>
            </div>
        </div>
    </div>
</div>

@if (!request()->routeIs('template.edit'))
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="price" class="form-label col-3 col-sm-3 col-md-4">Price
                <span class="text-danger">*</span></label>
            <div class="col-9 col-sm-9 col-md-8">
                <input type="text" class="form-control @error('price') is-invalid @enderror"
                    id="price" name="price" placeholder="price"
                    value="{{ Request::old('price', $dataObj->price ?? '') }}" maxlength="255">
                @error('price')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
        <div class="form-group row">
            <label for="price" class="form-label col-3 col-sm-3 col-md-4">
                Add Drugs
                <span class="text-danger">*</span>
            </label>
            <div class="col-9 col-sm-9 col-md-8">
                <table id="table_product">
                    <thead>
                        <tr>
                            <th width="20%" style="text-align: left;">Drug Name <span class="text-danger">*</span></th>
                            <th width="20%" style="text-align: center;">Quantity <span class="text-danger">*</span></th>
                            <th width="20%" style="text-align: center;">Dose</th>
                            <th width="20%" style="text-align: center;">Duration</th>
                            <th width="20%" style="text-align: center;">Frequency</th>
                            <th width="20%" style="text-align: center;">Add</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select style="width: 150px"  class="js-example-basic-single form-control" id="template_product_id" required>
                                    @if (count($productObj))
                                    <option value="">select drug</option>
                                    @foreach ($productObj as $row)
                                    <option value="{{ $row->id }}">
                                        {{ $row->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <input type="text" name="template_product_qty" id="template_product_qty" class="form-control"
                                style="width: 150px" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            </td>
                            <td>
                                <input type="text" name="template_dose" id="template_dose" class="form-control"
                                style="width: 150px" maxlength="10">
                            </td>
                            <td>
                                <input type="text" name="template_duration" id="template_duration" class="form-control"
                                style="width: 150px" maxlength="10">
                            </td>
                            <td>
                            <select style="width: 150px" class="js-example-basic-single form-control" id="template_frequency_id">
                                    @if (count($drugFrequencyObj))
                                    <option value="">select frequency</option>
                                    @foreach ($drugFrequencyObj as $row)
                                    <option value="{{ $row->id }}">
                                        {{ $row->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <button type="button" name="addDrugRow" id="addDrugRow" class="btn-plus">+</button>
                            </td>
                        </tr>
                        @if (count($dataBodyObj))
                        @foreach ($dataBodyObj as $index => $row)
                        <tr id="{{ 'row' . $index }}" class="new-table-row">
                            <input type="hidden" name="arr_body_row_id[]" value="{{ $row->id }}" class="form-control" id="arr_body_row_id{{ $row->id }}">
                            <td>
                                <select class="js-example-basic-single additives_batch_display form-control uniform-width"
                                    name="arr_body_product_id[]" id="arr_body_product_id{{ $row->product_id }}" readonly>
                                    <option value="" selected>select drug</option> 
                                    @if (count($productObj))
                                    @foreach ($productObj as $product)
                                    <option value="{{ $product->id }}" {{ $product->id == $row->product_id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <input type="text" value="{{ $row->quantity }}" placeholder="quantity"
                                    id="arr_body_product_qty{{ $index }}" name="arr_body_product_qty[]" 
                                    class="form-control uniform-width" maxlength="6" readonly>
                            </td>
                            <td>
                                <input type="text" value="{{ $row->dose }}" placeholder="dose"
                                    id="arr_body_dose{{ $index }}" name="arr_body_dose[]" 
                                    class="form-control uniform-width" maxlength="6" readonly>
                            </td>
                            <td>
                                <input type="text" value="{{ $row->duration }}" placeholder="duration"
                                    id="arr_body_duration{{ $index }}" name="arr_body_duration[]" 
                                    class="form-control uniform-width" maxlength="6" readonly>
                            </td>
                            <td>
                                <select style="width: 150px" class="js-example-basic-single form-control" id="template_frequency_id" 
                                    name="arr_body_frequency_id[]" id="arr_body_frequency_id{{ $row->id }}"readonly>
                                    @if (count($drugFrequencyObj))
                                    <option value="">select frequency</option>
                                    @foreach ($drugFrequencyObj as $drugFrequency)
                                    <option value="{{ $drugFrequency->id }}" {{ $drugFrequency->id == $row->frequency_id ? 'selected' : '' }}>
                                        {{ $drugFrequency->name }}
                                    </option>
                                    @endforeach
                                    @endif
                                </select>
                            </td>
                            <td>
                                <button class="btn_remove" onclick="removeNewCreatedTR(this)">X</button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row" id="laboratorySection">
    <div class="batch-display-area col-11 col-md-11 col-lg-11 ml-5 p-3">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group row">
                    <label for="" class="form-label col-2 col-sm-2 col-md-2">
                        Add Laboratory Items
                    </label>
                    <div class="col-9 col-sm-9 col-md-10">
                        <div class="input-box">
                            <table id="table_laboratory">
                                <thead>
                                    <tr>
                                        <th width="55%" style="text-align: left;">Laboratory Items</th>
                                        <th width="25%" style="text-align: center;">Quantity</th>
                                        <th width="20%" style="text-align: center;">Add</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="js-example-basic-single form-control" id="template_laboratory_id"  style="width: 300px" required>
                                                @if (count($laboratoryExpenseObj))
                                                <option value="">select laboratory items</option>
                                                @foreach ($laboratoryExpenseObj as $row)
                                                <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="template_laboratory_qty" id="template_laboratory_qty" class="form-control"
                                                style="width: 150px" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </td>
                                        <td>
                                            <button type="button" name="addLabItemRow" id="addLabItemRow"
                                                class="btn-plus">+</button>
                                        </td>
                                    </tr>
                                    
                                    @if (count($dataLabObj))
                                    @foreach ($dataLabObj as $index => $row)
                                    <tr id="{{ 'row' . $index }}" class="new-table-row">
                                        <input type="hidden" name="arr_laboratory_row_id[]" value="{{ $row->id }}" id="arr_laboratory_row_id{{ $row->id }}">
                                        <td>
                                            <select class="js-example-basic-single additives_batch_display form-control uniform-width"
                                                name="arr_laboratory_id[]" id="arr_laboratory_id{{ $row->id }}" readonly>
                                                <option value="" selected>select drug</option> 
                                                @if (count($laboratoryExpenseObj))
                                                @foreach ($laboratoryExpenseObj as $labItem)
                                                <option value="{{ $labItem->id }}" {{ $labItem->id == $row->laboratory_id ? 'selected' : '' }}>
                                                    {{ $labItem->name }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ $row->quantity }}" placeholder="quantity"
                                            id="arr_laboratory_qty{{ $index }}" name="arr_laboratory_qty[]" class="form-control uniform-width" maxlength="6" readonly>
                                        </td>
                                        <td><button class="btn_remove" onclick="removeNewCreatedTR(this)">X</button></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if (!request()->routeIs('body.create'))
<div class="row" id="priceLevelSection">
    <div class="batch-display-area col-11 col-md-11 col-lg-11 ml-5 p-3">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group row">
                    <label for="" class="form-label col-2 col-sm-2 col-md-2">
                        Add Price Level
                    </label>
                    <div class="col-9 col-sm-9 col-md-10">
                        <div class="input-box">
                            <table id="table_price_level">
                                <thead>
                                    <tr>
                                        <th width="55%" style="text-align: left;">Price</th>
                                        <th width="25%" style="text-align: center;">Effective Date</th>
                                        <th width="20%" style="text-align: center;">Add</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" name="template_price_level" id="template_price_level" class="form-control"
                                                maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                                        </td>
                                        <td>
                                            <input type="date" name="template_effective_from" id="template_effective_from" class="form-control">
                                        </td>
                                        <td>
                                            <button type="button" name="addPriceLevelRow" id="addPriceLevelRow"
                                                class="btn-plus">+</button>
                                        </td>
                                    </tr>
                                    
                                    @if (count($dataPriceObj))
                                    @foreach ($dataPriceObj as $index => $row)
                                    <tr id="{{ 'row' . $index }}" class="new-table-row">
                                        <input type="hidden" name="arr_price_level_row_id[]" value="{{ $row->id }}" id="arr_price_level_row_id{{ $row->id }}">
                                        <input type="hidden" name="arr_price_level_is_active[]" value="{{ $row->is_active }}" id="arr_price_level_is_active{{ $row->id }}">
                                        <td>
                                            <input type="text" value="{{ $row->price }}" 
                                             id="arr_price_level{{ $index }}" name="arr_price_level[]" class="form-control uniform-width" maxlength="6" readonly>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ date('Y-m-d', strtotime($row->effective_from)) }}" placeholder="quantity"
                                            id="arr_price_level_effective_from{{ $index }}" name="arr_price_level_effective_from[]" class="form-control uniform-width" maxlength="6" readonly>
                                        </td>
                                        <td><button class="btn_remove {{ $row->is_active ? 'disabled-btn' : '' }}" @if($row->is_active) disabled @endif>X</button></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@push('css')
<style>
    .select2-container .select2-selection--single {
        height: 38px;
    }
    
    table {
            width: 60%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
    th,
    td {
        padding: 5px;
        text-align: left;
        border: 1px solid #ddd;
    }
    
    th {
        background-color: #f2f2f2;
    }
    
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    
    tr:hover {
        background-color: #e0e0e0;
    }
    
    .btn-plus {
        background: #277061;
        border-radius: 5px;
        margin: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 35px;
        font-size: 16px;
    }
    
    .btn_remove {
        background: #ED7E7E;
        border-radius: 5px;
        margin: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 35px;
        font-size: 16px;
    }
    
    .item-checkbox {
        padding-left: 2rem;
    }

    .div_target_course {
        background: #F9F9F9;
        padding-left: 5px;
        padding-right: 10px;
        margin-top: 30px;
    }
    
    .top_margin {
        margin-top: 5px;
    }
    
    .radio-group input[type=radio] {
        width: 18px;
        height: 18px;
        margin-right: 10px;
    }
    
    .radio-group label {
        min-width: auto;
        width: fit-content;
    }
    
    .radio_1 {
        margin-right: 20px;
    }
    
    .scroll-non {
        width: 1250px;
    }
    
    .member-upload .member-preview>div {
        width: 100%;
        height: 100%;
        margin-left: 5px;
        padding: 10px;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
    
    .table-che {
        border-collapse: collapse;
        background-color: #F9F9F9;
        width: 100%;
        border: 1px solid #F9F9F9 !important;
    }
    
    .table-che td {
        border: 1px solid #F9F9F9 !important;
    }
    
    .disabled-btn {
        background-color: #ccc;
        cursor: not-allowed;
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
        var i = 0;
        
        $('#addDrugRow').click(function() {
            var productID = document.getElementById('template_product_id').value;
            var productIDElement = document.getElementById('template_product_id');
            var selectedproductText = productIDElement.options[productIDElement.selectedIndex].text;
            
            var orderQty = $("input[name='template_product_qty']").val();
            var dose = $("input[name='template_dose']").val();
            var duration = $("input[name='template_duration']").val();
            
            var frequencyID = document.getElementById('template_frequency_id').value;
            var frequencyIDElement = document.getElementById('template_frequency_id');
            var selectedFrequencyText = frequencyIDElement.options[frequencyIDElement.selectedIndex].text;
            
            if (productID === "") {
                toastr.error('Please enter the product name.');
                $("#arr_body_product_id").val('').focus();
                return false;
            }
            
            if (orderQty === "") {
                toastr.error('Please enter the quantity.');
                $("#template_product_qty").val('').focus();
                return false;
            }
            
            var arr = $("input[name='arr_body_product_id[]']");
            for (var j = 0; j < arr.length; j++) {
                var product_id = arr[j].value;
                if (product_id == productID) {
                    toastr.error('The product has been duplicated.');
                    $("#arr_product_id").val('').focus();
                    $("#arr_template_product_qty").val('');
                    return false;
                }
            }
            
            i++;
            $('#table_product').append(
                '<tr id="row' + i + '">' +
                    '<input type="hidden" name="arr_body_row_id[]" value="' + 0 + '" class="form-control" id="arr_body_row_id{{ $row->id }}">'+
                    '<td style="display: none;">' +
                        '<input type="hidden" name="arr_body_product_id[]" value="' + productID + '" class="form-control" id="arr_body_product_id' + i + '">' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="arr_product_name[]" value="' + selectedproductText.trim() + '" class="form-control" style="width: 150px" id="arr_product_name' + i + '" disabled>' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="arr_body_product_qty[]" value="' + orderQty +  '" class="form-control bg-grey" style="width: 150px" id="arr_body_product_qty' + i + '" readonly>' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="arr_body_dose[]" value="' + dose + '" class="form-control bg-grey" style="width: 150px" id="arr_body_dose' + i + '" readonly>' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="arr_body_duration[]" value="' + duration + '" class="form-control bg-grey" style="width: 150px" id="arr_body_duration' + i + '" readonly>' +
                    '</td>' +
                    '<td style="display: none;">' +
                        '<input type="hidden" name="arr_body_frequency_id[]" value="' + frequencyID + '" class="form-control" id="arr_body_frequency_id' + i + '" readonly>' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="arr_frequency_name[]" value="' + selectedFrequencyText.trim() + '" class="form-control" style="width: 150px" id="arr_frequency_name' + i + '" disabled>' +
                    '</td>' +
                    '<td>' +
                        '<button type="button" name="drug_remove" id="drug_remove' + i + '" class="btn_remove">X</button>' +
                    '</td>' +
                '</tr>');
                
            $("#template_product_qty").val('');
            $("#template_dose").val('');
            $("#template_duration").val('');
            
            var productSelect = document.getElementById('template_product_id');
            var frequencySelect = document.getElementById('template_frequency_id');
            
            var selectDrugOption = productSelect.querySelector('option[value=""]');
            var frequencyOption = frequencySelect.querySelector('option[value=""]');
            
            selectDrugOption.selected = true;
            frequencyOption.selected = true;
            
            $(productSelect).trigger('change');
            $(frequencySelect).trigger('change');
        });
        
        $(document).on('click', '.drug_remove', function() {
            $(this).closest('tr').remove();
            var arr_qty = $("input[name='arr_template_product_qty[]']");
            var tot = 0;
            for (var k = 0; k < arr_qty.length; k++) {
                if (parseFloat(arr_qty[k].value))
                tot += parseFloat(arr_qty[k].value);
            }
            
            var total_quantity = document.getElementById("total_quantity");
            total_quantity.value = parseFloat(tot);
        });
    });
</script>

<script>
    $(document).ready(function() {
        var i = 0;
        
        $('#addLabItemRow').click(function() {
            var laboratoryID = document.getElementById('template_laboratory_id').value;
            var laboratoryIDElement = document.getElementById('template_laboratory_id');
            var selectedText = laboratoryIDElement.options[laboratoryIDElement.selectedIndex].text;
            var orderQty = $("input[name='template_laboratory_qty']").val();
            if (laboratoryID === "") {
                toastr.error('Please enter the laboratory item.');
                $("#template_laboratory_id").val('').focus();
                return false;
            }
            
            if (orderQty === "") {
                toastr.error('Please enter the quantity.');
                $("#template_laboratory_qty").val('').focus();
                return false;
            }
            
            var arr = $("input[name='arr_laboratory_id[]']");
            for (var j = 0; j < arr.length; j++) {
                var lab_id = arr[j].value;
                if (lab_id == laboratoryID) {
                    toastr.error('The laboratory item has been duplicated.');
                    $("#template_laboratory_id").val('').focus();
                    $("#template_laboratory_qty").val('');
                    return false;
                }
            }
            
            i++;
            $('#table_laboratory').append(
                '<tr id="row' + i + '">' +
                    '<input type="hidden" name="arr_laboratory_row_id[]" value="' + 0 + '" class="form-control" id="arr_laboratory_row_id{{ $row->id }}">'+
                    '<td style="display: none;">' +
                        '<input type="hidden" name="arr_laboratory_id[]" value="' + laboratoryID + '" class="form-control" id="arr_laboratory_id' + i + '">' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="arr_laboratory_name[]" value="' + selectedText.trim() + '" class="form-control" style="width: 300px" id="arr_laboratory_name' + i + '" disabled>' +
                    '</td>' +
                    '<td>' + 
                        '<input type="text" name="arr_laboratory_qty[]" value="' + orderQty + '" class="form-control bg-grey" style="width: 150px" id="arr_laboratory_qty' + i + '" readonly>' +
                    '</td>' + 
                    '<td>' +
                        '<button type="button" name="lab_item_remove" id="lab_item_remove' + i + '" class="btn_remove">X</button>' +
                    '</td>' +
                '</tr>'
            );
            
            $("#template_laboratory_qty").val('');
            var productSelect = document.getElementById('template_laboratory_id');
            var selectDrugOption = productSelect.querySelector('option[value=""]');
            selectDrugOption.selected = true;
            $(productSelect).trigger('change');
        });
        
        $(document).on('click', '.btn_remove', function() {
            $(this).closest('tr').remove();
            var arr_qty = $("input[name='arr_template_laboratory_qty[]']");
            var tot = 0;
            for (var k = 0; k < arr_qty.length; k++) {
                if (parseFloat(arr_qty[k].value))
                tot += parseFloat(arr_qty[k].value);
            }
            
            var total_quantity = document.getElementById("total_quantity");
            total_quantity.value = parseFloat(tot);
        });
    });
</script>

<script>
    $(document).ready(function() {
        var i = 0;
        
        $('#addPriceLevelRow').click(function() {
            var PriceLevel = $("input[name='template_price_level']").val();
            var EffectiveDate = $("input[name='template_effective_from']").val();

                if (PriceLevel === "") {
                    toastr.error('Please enter the Price Level.');
                    $("#template_price_level").val('').focus();
                    return false;
                }

                if (EffectiveDate === "") {
                    toastr.error('Please enter the Effective Date.');
                    $("#template_effective_from").val('').focus();
                    return false;
                }

                var arr = $("input[name='arr_template_price_level[]']");
                for (var j = 0; j < arr.length; j++) {
                    var price_level_id = arr[j].value;
                    if (price_level_id == PriceLevel) {
                        toastr.error('The Price Level item has been duplicated.');
                        $("#template_price_level").val('').focus();
                        $("#template_effective_from").val('');
                        return false;
                    }
                }
                console.log('PriceLevel:', PriceLevel);

            i++;
            $('#table_price_level').append(
                '<tr id="row' + i + '">' +
                    '<input type="hidden" name="arr_price_level_row_id[]" value="' + 0 + '" id="arr_price_level_row_id{{ $row->id }}">'+
                    '<input type="hidden" name="arr_price_level_is_active[]" value="' + 0 + '" id="arr_price_level_is_active{{ $row->id }}">'+
                    '<td>' +
                        '<input type="text" name="arr_price_level[]" value="' + PriceLevel + '" class="form-control bg-grey" id="arr_price_level' + i + '" readonly>' +
                    '</td>' +
                    '<td>' +
                        '<input type="text" name="arr_price_level_effective_from[]" value="' + EffectiveDate + '" class="form-control bg-grey" id="arr_price_level_effective_from' + i + '" readonly>' +
                    '</td>' +
                    '<td>' +
                            '<button type="button" name="price_level_item_remove" id="price_level_item_remove' + i + '" class="btn_remove">X</button>' +
                    '</td>' +
                '</tr>'
            );
                    
            $("#template_price_level").val('');
            $("#template_effective_from").val('');
        });
        
        $(document).on('click', '.btn_remove', function() {

            // Count only rows that contain price data
            var totalDataRows = $('#table_price_level tbody tr')
                .has("input[name='arr_price_level[]']")
                .length;

            if (totalDataRows <= 1) {
                toastr.error('At least one price level is required.');
                return false;
            }

            $(this).closest('tr').remove();
        });
    });
</script>
@endpush
