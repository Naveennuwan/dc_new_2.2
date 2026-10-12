@extends('layouts.app')

@section('title', __('Appointments'))

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
                <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">Patient / Appointments / List</h6>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-right">
                <div class="btn-toolbar justify-content-end text-right" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group" role="group">
                        <a href="{{ route('appointment.display') }}"
                            class="modern-btn btn-lime fixed-width-button-120">Display</a>
                    </div>
                    @include('components.toolbar', ['showExportButton' => false, 'showSearchButton' => true])
                    <div class="btn-group" role="group">
                        <a href="{{ route('appointment.create') }}"
                            class="modern-btn btn-lime fixed-width-button-120">Create Record</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="">
        <form action="{{ route('appointment.search') }}" method="post" id="searchForm" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <p class="text-muted">Search Record...</p>
                        <div>
                            <a href="{{ route('appointment.index') }}" class="modern-btn btn-amber fixed-width-button-100">Reset</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-4">
                            <label for="search_name">Name</label>
                            <input type="text" class="form-control" id="search_name" name="search_name"
                                placeholder="Name"
                                value="{{ Request::old('search_name', $searchingVals['search_name'] ?? '') }}" maxlength="255">
                        </div>
                        <div class="form-group col-12 col-sm-4">
                        <label for="search_date">Date</label>
                            <input type="date" class="form-control"  id="search_date" name="search_date" placeholder="Search date"
                            value="{{ Request::old('search_date', $searchingVals['search_date'] ?? '') }}">
                    </div>
                    <div class="form-group col-12 col-sm-2 col-md-4">
                        <label for="search_status">Display</label>
                            <select class="js-example-basic-single form-control" id="search_status" name="search_status">
                                <option value="" selected>All</option>
                                <option value="cancelled"
                                    {{ Request::old('search_status', $searchingVals['search_status'] ?? '') == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                                <option value="pending"
                                    {{ Request::old('search_status', $searchingVals['search_status'] ?? '') == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="confirmed"
                                    {{ Request::old('search_status', $searchingVals['search_status'] ?? '') == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="completed"
                                    {{ Request::old('search_status', $searchingVals['search_status'] ?? '') == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
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
                        <table  id="dataTable"  class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col"  style="width:10%">Que No</th>
                                <th scope="col" style="width:15">Name</th>
                                <th scope="col" style="width:15%">Contact No</th>
                                <th scope="col" style="width:15%">Date & Time</th>
                                <th scope="col" style="width:15%">Surgeon</th>
                                <th scope="col" style="width:30%">Status</th>
                                <th scope="col" style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointmentObj as $row)
                                <tr>
                                    <th>{{ $row->appointment_no }}</td>
                                    <td>{{ $row->name ?? $row->patient->name ?? '-' }}</td>
                                    <td>{{ $row->contact_no ?? $row->patient->patient_contact_no ?? '-' }}</td>
                                    <td>{{ $row->appointment_date }} {{ $row->appointment_time }}</td>
                                    <td>{{ $row->doctor->name }}</td>
                                    <td>
                                        <div class="row g-1">
                                            <div class="col-6">
                                                <form method="POST" action="{{ route('appointments.status', $row->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="cancelled">
                                                    <button class="btn btn-sm w-100 {{ $row->status === 'cancelled' ? 'btn-danger active-status' : 'btn-outline-danger' }}">
                                                        Cancel
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <form method="POST" action="{{ route('appointments.status', $row->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="confirmed">
                                                    <button class="btn btn-sm w-100 {{ $row->status === 'confirmed' ? 'btn-primary active-status' : 'btn-outline-primary' }}">
                                                        Confirmed
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <form method="POST" action="{{ route('appointments.status', $row->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="pending">
                                                    <button class="btn btn-sm w-100 {{ $row->status === 'pending' ? 'btn-warning active-status' : 'btn-outline-warning' }}">
                                                        Pending
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <form method="POST" action="{{ route('appointments.status', $row->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button class="btn btn-sm w-100 {{ $row->status === 'completed' ? 'btn-success active-status' : 'btn-outline-success' }}">
                                                        Completed
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('patient.create', [
                                                'name' => $row->name,
                                                'patient_contact_no' => $row->contact_no
                                            ]) }}"
                                         class="modern-btn btn-lime fixed-width-button-100 @cannot('brand-edit') disabled @endcannot">
                                            <i class="fas fa-pencil" title="Edit"></i>
                                            Save
                                        </a>
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
