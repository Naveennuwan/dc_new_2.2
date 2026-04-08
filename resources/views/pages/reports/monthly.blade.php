@extends('layouts.app')

@section('title', __('Monthly Report'))
            @php
            $totalTreatement = 0;
            @endphp

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
            <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">Other Reports / Monthly Report</h6>
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
<div class="container-fluid">
    <h3 class="mb-4 fw-bold">Monthly Summary Dashboard</h3>

    {{-- PATIENT STATS --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card dashboard-card text-white bg-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Total Patients</div>
                        <div class="card-value">{{ $totalPatients }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card dashboard-card text-white bg-success">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Routine Patients</div>
                        <div class="card-value">{{ $totalRoutinePatients }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card dashboard-card text-white bg-info">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">Orthodontic Patients</div>
                        <div class="card-value">{{ $totalOrthodonticPatients }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-teeth"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- PAYMENT SUMMARY --}}
    <div class="row">
        @php
        $totalsByType = $monthlyOtherPayments->groupBy('payment_type')->map(function($group){
            return $group->sum('payment');
        });
        @endphp

        @foreach($totalsByType as $type => $total)
        <div class="col-md-6 mb-4">
            <div class="card dashboard-card text-white bg-warning">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="card-title">{{ $type ?? 'Unknown' }} Payments</div>
                        <div class="card-value">{{ number_format($total,2) }}</div>
                    </div>
                    <div class="card-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>



    <h5 class="mt-5">Routing Treatments</h5>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Template</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($getRoutingTreatmentsMonthly as $index => $treatment)
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
                <td><strong>{{ number_format($getRoutingTreatmentsMonthly->sum('total'), 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <h5 class="mt-5">Orthodontic Treatments</h5>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Template</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($getOrthodonticTreatmentsMonthly as $index => $treatment)
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
                <td><strong>{{ number_format($getOrthodonticTreatmentsMonthly->sum('total'), 2) }}</strong></td>
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
            @forelse($getPaymentMonthly as $index => $payment)
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
                <td><strong>{{ number_format($getPaymentMonthly->sum('payment'), 2) }}</strong></td>
            </tr>
            <tr class="table-secondary">
                <td colspan="4" class="text-end"><strong>Profit :</strong></td>
                <td><strong>{{ number_format($getPaymentMonthly->sum('payment') - $totalTreatement, 2) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection

@push('css')
<style>

.dashboard-card{
    border-radius:15px;
    border:none;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.dashboard-card:hover{
    transform: translateY(-5px);
    box-shadow:0 8px 20px rgba(0,0,0,0.2);
}

.card-icon{
    font-size:30px;
    opacity:0.8;
}

.card-title{
    font-size:16px;
    font-weight:600;
}

.card-value{
    font-size:32px;
    font-weight:bold;
}
</style>
@endpush