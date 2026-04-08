@extends('layouts.app')

@section('title', __('Daily Report'))
            @php
            $totalTreatement = 0;
            @endphp

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
            <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">Other Reports / Daily Report</h6>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-right">
                <div class="btn-toolbar justify-content-end text-right" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group">
                        <a href="{{ route('reports.index') }}"
                        class="modern-btn btn-azure fixed-width-button-120">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="">
    <h4 class="mb-3">Today's Patient Registrations</h4>
    <div class="row">
        @forelse($todayPatients as $row)
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3">
            <div class="mini-card shadow-sm">
                <div class="mini-card-content text-center">
                    <div class="mini-card-count">{{ $row->total }}</div>
                    <div class="mini-card-title">{{ $row->patientType->name ?? 'Unknown' }}</div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="alert alert-warning text-center">
                No patients registered today.
            </div>
        </div>
        @endforelse
    </div>

    {{-- Other Payments Table --}}
    <h5 class="mt-5">Other Payments Today</h5>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Patient Name</th>
                <th>Payment Type</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($todayOtherPayments as $index => $payment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $payment->patient->name ?? 'Unknown' }}</td>
                <td>{{ $payment->payment_type ?? 'Unknown' }}</td>
                <td>{{ number_format($payment->payment, 2) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">No payments recorded today.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            @php
            $totalsByType = $todayOtherPayments->groupBy('payment_type')->map(function($group) {
                return $group->sum('payment');
            });
            @endphp
        
            @foreach($totalsByType as $type => $total)
            <tr class="table-secondary">
                <td colspan="3" class="text-end"><strong>Total {{ $type ?? 'Unknown' }}:</strong></td>
                <td><strong>{{ number_format($total, 2) }}</strong></td>
            </tr>
            @endforeach
        </tfoot>
    </table>

    <h5 class="mt-5">Routing Treatments Today</h5>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Template</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($getRoutingTreatmentsToday as $index => $treatment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $treatment->template->name ?? 'Unknown' }}</td>
                <td>{{ $treatment->total ?? 'Unknown' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No treatments recorded today.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="table-secondary">
                <td colspan="2" class="text-end"><strong>Total :</strong></td>
                <td><strong>{{ number_format($getRoutingTreatmentsToday->sum('total'), 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <h5 class="mt-5">Orthodontic Treatments Today</h5>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Template</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($getOrthodonticTreatmentsToday as $index => $treatment)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $treatment->template->name ?? 'Unknown' }}</td>
                <td>{{ $treatment->total ?? 'Unknown' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No treatments recorded today.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="table-secondary">
                <td colspan="2" class="text-end"><strong>Total :</strong></td>
                <td><strong>{{ number_format($getOrthodonticTreatmentsToday->sum('total'), 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <h5 class="mt-5">Payments</h5>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Patient</th>
                <th>Treatement Name</th>
                <th>Treatement Value</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>
            @forelse($getPaymentToday as $index => $payment)
            @php
                $price = 0;

                $treatment = $payment->savedTreatment;

                if ($treatment && $treatment->priceLevels->count() === 1) {
                    $price = $treatment->priceLevels->first()->price;

                } elseif ($treatment && $treatment->priceLevels->count() >= 2) {

                    $patient = $treatment->patient;

                    $nextPrice = $treatment->priceLevels
                        ->sortByDesc('effective_from')
                        ->first(function ($item) use ($patient) {
                            return $item->effective_from->lte($patient->created_at);
                        });

                    $price = $nextPrice ? $nextPrice->price : 0;
                }
                $totalTreatement += $price;
            @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $payment->savedTreatment->patient->name ?? 'Unknown' }}</td>
                <td>{{ $payment->savedTreatment->template->name ?? 'Unknown' }}</td>
                <td>{{ number_format($price, 2) ?? 'Unknown' }}</td>
                <td>{{ $payment->payment ?? 'Unknown' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No treatments recorded today.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="table-secondary">
                <td colspan="3" class="text-end"><strong>Total :</strong></td>
                <td><strong>{{ number_format($totalTreatement, 2) }}</strong></td>
                <td><strong>{{ number_format($getPaymentToday->sum('payment'), 2) }}</strong></td>
            </tr>
            <tr class="table-secondary">
                <td colspan="4" class="text-end"><strong>Profit :</strong></td>
                <td><strong>{{ number_format($getPaymentToday->sum('payment') - $totalTreatement, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@push('css')
<style>
/* Mini card styles */
.mini-card {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: white;
    border-radius: 12px;
    padding: 15px 10px;
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: default;
}

.mini-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

.mini-card-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.mini-card-count {
    font-size: 1.8rem;
    font-weight: bold;
}

.mini-card-title {
    font-size: 0.9rem;
    text-align: center;
    margin-top: 5px;
    line-height: 1.2;
}
</style>
@endpush