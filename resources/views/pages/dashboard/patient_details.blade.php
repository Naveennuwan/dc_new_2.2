@php
$totalAdvance  = collect($advancePayments)->sum('payment');
$totalDiscount = collect($discountPayments)->sum('payment');

$totalTreatement = 0;

$hasAdvance  = is_countable($advancePayments) && count($advancePayments);
$hasDiscount = is_countable($discountPayments) && count($discountPayments);
$colClass = ($hasAdvance && $hasDiscount) ? 'col-12 col-md-6' : 'col-12';

@endphp

<div class="form-row">
    @if($hasAdvance)
        @include('pages.dashboard.payment_table', [
            'payments'     => $advancePayments,
            'title'        => 'Advance Payment',
            'confirmText'  => 'Delete this advance payment?',
            'colClass'     => $colClass,
            'total'       => $totalAdvance,
        ])
    @endif


    @if($hasDiscount)
        @include('pages.dashboard.payment_table', [
            'payments'     => $discountPayments,
            'title'        => 'Discount Payment',
            'confirmText'  => 'Delete this discount payment?',
            'colClass'     => $colClass,
            'total'       => $totalDiscount,
        ])
    @endif
</div>

@if(count($savedTemplates))
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            @if(count($savedTemplates))
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th style="width:30%">Treatement</th>
                        <th>Date</th>
                        <th class="text-right">Treatement Payment</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($savedTemplates as $row)
                    @php
                        $price = 0;

                        if ($row->priceLevels->count() === 1) {
                            $price = $row->priceLevels->first()->price;
                        } elseif ($row->priceLevels->count() >= 2) {

                            $nextPrice = $row->priceLevels
                            ->sortByDesc('effective_from')
                            ->first(function ($item) use ($patientDetails) {
                                return $item->effective_from->lte($patientDetails->created_at);
                            });

                            $price = $nextPrice ? $nextPrice->price : 0;
                        }
                        $totalTreatement = $totalTreatement + $price;

                        $isPaid = (float)$price == (float)$row->payment;
                    @endphp
                    <tr>
                        <td>{{ $row->template_name }}</td>
                        <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td>
                        <td class="text-center">{{ number_format($row->payment, 2) }}</td>
                        <td class="d-flex justify-content-center align-items-center">
                            <form action="{{ route('invoice.destroy', $row->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="modern-btn btn-coral fixed-width-button-120" onclick="return confirm('Are you sure you want to delete this Treatment?')">
                                    <i class="fas fa-trash" title="Delete"></i>
                                    Delete
                                </button>
                            </form>
                            <button
                                class="modern-btn btn-lime ml-1 pay-advance-btn fixed-width-button-120 {{ $isPaid ? 'disabled' : '' }}"
                                data-toggle="modal"
                                data-target="{{ $isPaid ? '' : '#payAdvanceModal' }}"
                                data-row-id="{{ $row->id }}"
                                data-template-value="{{ $price }}"
                                {{ $isPaid ? 'disabled' : '' }}>
                                
                                {{ $isPaid ? 'Paid' : 'Pay Balance' }}

                            </button>
                        </td>
                    </tr>
                @endforeach
                    <tr>
                        <td></td>
                        <td class="text-center"><strong>Total :</strong></td>
                        <td class="text-center"><strong>{{ number_format($savedTemplates->sum('payment'), 2) }}</strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <br/>
            @endif
        </div>
    </div>
</div>
<br/>
@endif

@if(count($savedDrugTemp))
<div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive" id="table-div">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Drug Treatement</th>
                            <th>Date</th>
                            <th>Print / Issue</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($savedDrugTemp as $row)
                        <tr>
                            <td>{{ $row->template->name }}</td>
                            <td>{{ date('Y-m-d', strtotime($row->created_at)) }}</td>
                            <td>
                                @if ($row->isPrint === 1)
                                <p class="font-weight-bold">For Recipt</p>
                                @else
                                <p class="font-weight-light">Issued</p>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('invoice.destroy', $row->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                        <button type="submit" class="modern-btn btn-coral" onclick="return confirm('Are you sure you want to delete this?')">
                                            <i class="fas fa-trash" title="Delete"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>

    <form id="deleteForm" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>
@endif

@if(is_object($patientDetails))
<div class="card mb-3">
    <div class="card-header">Summery of Payments</div>
    <div class="form-group col-9 col-sm-9">
        <div class="card-body card-grid">
            <div class="container text-center">
                <div class="table-responsive">
                    <table style="width:100%; border-spacing: 30px 10px;"> 
                        <tbody>
                            @if($totalAdvance)
                            <tr>
                                <td style="text-align: left;">Advance Payment</td>
                                <td style="text-align: right;">Rs. {{number_format($totalAdvance, 2)}} /=</td>
                            </tr>
                            @endif
                            @if($totalDiscount)
                            <tr>
                                <td style="text-align: left;">Discount</td>
                                <td style="text-align: right;">Rs. {{number_format($totalDiscount, 2)}} /=</td>
                            </tr>
                            @endif
                            @if(is_object($patientDetails) && $patientDetails->patient_type_id ===1) 
                                @if(number_format(($totalAdvance + $savedTemplates->sum('payment') - $totalDiscount), 2) > 0)
                                <tr>
                                    <td style="text-align: left;">Total Payments</td>
                                    <td style="text-align: right;">Rs. {{number_format(($totalAdvance + $savedTemplates->sum('payment') - $totalDiscount), 2)}} /=</td>
                                </tr>
                                @endif
                            @endif
                            <tr>
                                <td style="text-align: left;"></td>
                                <td style="text-align: right;"></td>
                            </tr>
                            @if(is_object($patientDetails) && $patientDetails->patient_type_id ===2)
                            <tr>
                                <td style="text-align: left;"><b>{{$templateDetails->name}}</b></td>
                                <td style="text-align: right;"><b>Rs. {{number_format($templateDetails->price, 2)}} /=</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Total To Pay With Discount</td>
                                <td style="text-align: right;">Rs. {{number_format($templateDetails->price - $totalDiscount, 2)}} /=</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;">Total Payments</td>
                                <td style="text-align: right;">Rs. {{number_format($totalAdvance + $savedTemplates->sum('payment'), 2)}} /=</td>
                            </tr>
                            <tr>
                                <td style="text-align: left;"><b>Due Payment</b></td>
                                <td style="text-align: right;"><b>Rs. {{number_format(($templateDetails->price - $totalDiscount) - ($totalAdvance + $savedTemplates->sum('payment')), 2)}} /=</b></td>
                            </tr>
                            @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(count($previousTreatements))
<div class="card">
    <div class="card-header">
        Previous Treatements
    </div>
    <div class="card-body">
        <div class="table-responsive" id="table-div">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th style="width:50%">Treatement Name</th>
                        <th>Doctor</th>
                        <th>Center</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($previousTreatements as $row)
                    <tr>
                        <td>{{ $row->template->name }}</td>
                        <td>{{ $row->doctor->name }}</td>
                        <td>{{ $row->center->name }}</td>
                        <td>{{ $row->created_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>
@endif

<!-- Pay Balance Modal -->
<div class="modal fade" id="payAdvanceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Pay Treatment Balance</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">

                <p>
                    Template Value balance:
                    <strong id="templateValueText"></strong>
                </p>

                <!-- CUSTOM PAYMENT FORM (HIDDEN) -->
                <form method="POST"
                      action="{{ route('invoice.pay-custom') }}"
                      id="customPaymentForm"
                      class="mt-3">
                    @csrf

                    <input type="hidden" name="row_id" id="custom_row_id">

                    <div class="form-group">
                        <label>Enter amount</label>
                        <input type="number"
                               step="0.01"
                               name="amount"
                               class="form-control"
                               required>
                    </div>

                    <button type="submit" class="modern-btn btn-lime w-100">
                        Submit Payment
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>




@push('js')

<script>
$('.pay-advance-btn').on('click', function () {

    const rowId   = $(this).data('row-id');
    const value = parseFloat($(this).data('template-value'));

    $('#templateValueText').text(value.toFixed(2));

    // Full payment form
    $('#full_row_id').val(rowId);
    $('#full_amount').val(value);

    // Custom payment form
    $('#custom_row_id').val(rowId);
});
</script>


<!-- <script>
$(function () {
    $('#advance-issue-btn').click(function () {
        const patientId = $('#patient_id').val();
        if (patientId) {
            window.open(`/advance-invoice/${patientId}`, '_blank');
        } else {
            alert('Select a patient first');
        }
    });
    
    $('#invoice-for-today-btn').click(function () {
        const patientId = $('#patient_id').val();
        if (patientId) {
            window.open(`/today-invoice/${patientId}`, '_blank');
        } else {
            alert('Select a patient first');
        }
    });

    $('#settle-btn').click(function () {
        const pathParts = window.location.pathname.split('/').filter(Boolean);
        const patientId = pathParts[pathParts.length - 1];
        if (patientId) {
            window.location.href = `/settlement/${patientId}`;
        } else {
            alert('No patient ID found');
        }
    });

    $('#treatement-issue-btn').click(function () {
        const patientId = $('#patient_id').val();
        if (patientId) {
            window.open(`/treatement-invoice/${patientId}`, '_blank');
        } else {
            alert('Select a patient first');
        }
    });

    $('#invoice-issue-btn').click(function () {
        const patientId = $('#patient_id').val();
        if (patientId) {
            window.open(`/copy-invoice/${patientId}`, '_blank');
        } else {
            alert('Select a patient first');
        }
    });

    $('#print-recipt-btn').click(function () {
        const patientId = $('#patient_id').val();
        if (patientId) {
            window.open(`/drug-invoice/${patientId}`, '_blank');
        } else {
            alert('Select a patient first');
        }
    });
});
</script> -->
@endpush