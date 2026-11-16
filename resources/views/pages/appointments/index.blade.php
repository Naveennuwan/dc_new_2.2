@extends('layouts.app')

@section('title', __('Appointments'))

@section('toolbar')
    <div class="toolbar appointment-toolbar">
        <div class="toolbar-heading">
            <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">
                Patient / Appointments / List
            </h6>
        </div>

        <div class="toolbar-actions">
            <a href="{{ route('appointment.display') }}"
               class="modern-btn btn-lime fixed-width-button-120">
                Display
            </a>

            @include('components.toolbar', [
                'showExportButton' => false,
                'showSearchButton' => true
            ])

            <a href="{{ route('appointment.create') }}"
               class="modern-btn btn-lime fixed-width-button-120">
                Create Record
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="">
        <form action="{{ route('appointment.search') }}" method="post" id="searchForm" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="search-heading">
                        <p class="text-muted">Search Record...</p>
                        <div>
                            <a href="{{ route('appointment.index') }}" class="modern-btn btn-amber fixed-width-button-100">Reset</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label for="search_name">Name</label>
                            <input type="text" class="form-control" id="search_name" name="search_name" placeholder="Name" value="{{ Request::old('search_name', $searchingVals['search_name'] ?? '') }}" maxlength="255">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="center_id">Center</label>
                            <select class="js-example-basic-single form-control" id="center_id" name="center_id">
                                <option value="" selected>All</option>
                                @foreach ($centerObj as $center)
                                        <option {{ Request::old('center_id', $searchingVals['center_id'] ?? '') == $center->id ? 'selected' : '' }}
                                            value="{{ $center->id }}"> 
                                            {{ $center->name }}
                                        </option>
                                        @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="search_date">Date</label>
                            <input type="date" class="form-control"  id="appointment_date" name="appointment_date" placeholder="Search date" value="{{ Request::old('appointment_date', $searchingVals['appointment_date'] ?? '') }}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label for="status">Display</label>
                            <select class="js-example-basic-single form-control" id="status" name="status">
                                <option value="" selected>All</option>
                                <option value="cancelled" { Request::old('status', $searchingVals['status'] ?? '') == 'cancelled' ? 'selected' : '' }}> Cancelled</option>
                                <option value="pending" {{ Request::old('status', $searchingVals['status'] ?? '') == 'pending' ? 'selected' : '' }}> Pending</option>
                                <option value="confirmed" {{ Request::old('status', $searchingVals['status'] ?? '') == 'confirmed' ? 'selected' : '' }}> Confirmed</option>
                                <option value="completed" {{ Request::old('status', $searchingVals['status'] ?? '') == 'completed' ? 'selected' : '' }}> Completed</option>
                                <option value="uncompleted" {{ Request::old('status', $searchingVals['status'] ?? '') == 'uncompleted' ? 'selected' : '' }}> Uncompleted</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="table-div">
                        <table  id="dataTable"  class="table appointment-table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col"  style="width:10%">Que No</th>
                                <th scope="col" style="width:15">Name</th>
                                <th scope="col" style="width:15%">Contact No</th>
                                <th scope="col" style="width:10%">Date & Time</th>
                                <th scope="col" style="width:10%">Surgeon</th>
                                <th scope="col" style="width:10%">Center</th>
                                <th scope="col" style="width:10%">Status</th>
                                <th scope="col" style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointmentObj as $row)
                                <tr>
                                    <th>{{ $row->appointment_no }}</td>
                                    <td>{{ $row->name ?? $row->patient->name ?? '-' }}</td>
                                    <td>{{ $row->contact_no ?? $row->patient->patient_contact_no ?? '-' }}</td>
                                    <td>
                                        {{ date('Y-m-d', strtotime($row->appointment_date)) }}
                                        {{ date('h:i A', strtotime($row->appointment_time)) }}
                                    </td>
                                    <td>{{ $row->doctor->name }}</td>
                                    <td>{{ $row->center->name }}</td>
                                    <td>
                                        <div class="status-grid">
                                                <form method="POST" action="{{ route('appointments.status', $row->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button class="btn btn-sm w-100 {{ $row->status === 'cancelled' ? 'btn-danger active-status' : 'btn-outline-danger' }}">
                                                        Cancel
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('appointments.status', $row->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button class="btn btn-sm w-100 {{ $row->status === 'confirmed' ? 'btn-primary active-status' : 'btn-outline-primary' }}">
                                                        Confirmed
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('appointments.status', $row->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="pending">
                                                    <button class="btn btn-sm w-100 {{ $row->status === 'pending' ? 'btn-warning active-status' : 'btn-outline-warning' }}">
                                                        Pending
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('appointments.status', $row->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button class="btn btn-sm w-100 {{ $row->status === 'completed' ? 'btn-success active-status' : 'btn-outline-success' }}">
                                                        Completed
                                                    </button>
                                                </form>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($row->patient)
                                            <a href="javascript:void(0)"
                                            class="modern-btn btn-lime fixed-width-button-100 disabled"
                                            style="pointer-events: none; opacity: 0.5; cursor: not-allowed;"
                                            aria-disabled="true"
                                            title="Patient already selected">
                                                <i class="fas fa-pencil"></i>
                                                Save
                                            </a>
                                        @else
                                            <a href="{{ route('patient.create', [
                                                    'name' => $row->name,
                                                    'patient_contact_no' => $row->contact_no
                                                ]) }}"
                                            class="modern-btn btn-lime fixed-width-button-100 @cannot('brand-edit') disabled @endcannot">
                                                <i class="fas fa-pencil" title="Edit"></i>
                                                Save
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </div>
@endsection

@push('css')
    <style>
        .select2-container .select2-selection--single {
            height: 38px;
        }

        .row a {
            margin-right: 8px;
        }

        .row a:last-child {
            margin-right: 0;
        }

        button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .active-status {
            transform: scale(1.05);
            box-shadow: 0 0 8px rgba(0,0,0,0.25);
            font-weight: 600;
        }
        
        #searchForm .form-row {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px;
            margin-left: 0;
            margin-right: 0;
        }

        #searchForm .form-row .form-group {
            width: 100%;
            min-width: 0;
            max-width: 100%;
            padding-left: 0;
            padding-right: 0;
            margin-bottom: 0;
        }

        #searchForm .form-row label {
            display: block;
            margin-bottom: 8px;
        }

        #searchForm .form-row .form-control,
        #searchForm .form-row .select2-container {
            width: 100% !important;
            max-width: 100%;
            box-sizing: border-box;
        }

        /* Mobile and tablet - Two columns */
        @media (max-width: 768px) {
            #searchForm .form-row {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 16px 12px;
            }
        }

        /* Very small screens - Keep two columns */
        @media (max-width: 360px) {
            #searchForm .form-row {
                gap: 12px 8px;
            }
        }


    </style>
@endpush

@push('css')
<style>
    /* Prevent horizontal overflow */
    .appointment-toolbar,
    .appointment-toolbar *,
    .card,
    .card-body {
        box-sizing: border-box;
    }

    .appointment-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        width: 100%;
        padding: 10px 0;
    }

    .toolbar-heading {
        flex: 1 1 250px;
        min-width: 0;
    }

    .toolbar-heading h6 {
        margin: 0;
        overflow-wrap: anywhere;
    }

    .toolbar-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        flex-wrap: wrap;
        gap: 8px;
    }

    .toolbar-actions .btn-group {
        margin: 0;
    }

    .search-heading {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 15px;
    }

    .search-heading p {
        margin: 0;
    }

    .card {
        max-width: 100%;
    }

    .card-body {
        min-width: 0;
    }

    /* Appointment table */
    #table-div {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .appointment-table {
        width: 100%;
        min-width: 850px;
        margin-bottom: 0;
    }

    .appointment-table th,
    .appointment-table td {
        vertical-align: middle;
        padding: 10px 8px;
    }

    .appointment-table td {
        overflow-wrap: anywhere;
    }

    /* Status buttons */
    .appointment-table .status-grid {
        display: grid;
        /* grid-template-columns: repeat(2, minmax(0, 1fr)); */
        gap: 6px;
        min-width: 130px;
    }

    .appointment-table .status-grid form {
        margin: 0;
        min-width: 0;
    }

    .appointment-table .status-grid .btn {
        width: 100%;
        min-height: 34px;
        white-space: normal;
        padding: 5px 3px;
        font-size: 12px;
    }

    .active-status {
        transform: none;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        font-weight: 600;
    }

    .appointment-table .modern-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        max-width: 100%;
        white-space: nowrap;
    }

    /* Tablet */
    @media (max-width: 768px) {
        .appointment-toolbar {
            align-items: stretch;
        }

        .toolbar-heading,
        .toolbar-actions {
            flex: 1 1 100%;
            width: 100%;
        }

        .toolbar-actions {
            justify-content: flex-start;
        }

        .toolbar-actions .modern-btn {
            min-height: 38px;
        }

        .card-body {
            padding: 15px;
        }

        .appointment-table {
            min-width: 800px;
        }
    }

    /* Mobile */
    @media (max-width: 576px) {
        .appointment-toolbar {
            padding: 8px 0;
        }

        .toolbar-heading h6 {
            font-size: 13px;
            line-height: 1.5;
        }

        .toolbar-actions {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 8px;
        }

        .toolbar-actions > *,
        .toolbar-actions .btn-group {
            width: 100%;
            min-width: 0;
        }

        .toolbar-actions .modern-btn {
            width: 100%;
            min-width: 0;
            padding: 8px 5px;
            font-size: 12px;
            text-align: center;
            white-space: normal;
        }

        .search-heading {
            align-items: center;
        }

        .search-heading p {
            font-size: 14px;
        }

        .card-body {
            padding: 12px;
        }

        .appointment-table {
            min-width: 760px;
            font-size: 12px;
        }

        .appointment-table th,
        .appointment-table td {
            padding: 8px 6px;
        }

        .appointment-table .status-grid {
            gap: 5px;
        }

        .appointment-table .status-grid .btn {
            font-size: 11px;
            padding: 6px 2px;
        }
    }

    @media (max-width: 360px) {
        .toolbar-actions {
            grid-template-columns: 1fr;
        }

        .card-body {
            padding: 8px;
        }
    }
</style>
@endpush

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Check All functionality
            document.getElementById('checkAll').addEventListener('change', function() {
                var checkboxes = document.getElementsByClassName('checkSingle');
                for (var i = 0; i < checkboxes.length; i++) {
                    checkboxes[i].checked = this.checked;
                }
            });

            // Individual checkbox event handling
            var checkboxes = document.getElementsByClassName('checkSingle');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].addEventListener('change', function() {
                    document.getElementById('checkAll').checked = false;
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#search-btn').on('click', function() {
                $('#searchForm').submit();
            });

            $('#export-btn').on('click', function() {
                $('#exportForm').submit();
            });
        });
    </script>
@endpush
