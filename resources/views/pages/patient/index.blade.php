@extends('layouts.app')

@section('title', __('Patient'))

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
                <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title"> Patient / List</h6>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-right">
                <div class="btn-toolbar justify-content-end text-right" role="toolbar" aria-label="Toolbar with button groups">
                @include('components.toolbar', ['showExportButton' => false, 'showSearchButton' => true])
                    <div class="btn-group" role="group">
                        <a href="{{ route('patient.create') }}"
                            class="modern-btn fixed-width-button-130 btn-lime @cannot('patient-create') disabled @endcannot">Create Record</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="">
        <form action="{{ route('patient.search') }}" method="post" id="searchForm" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <p class="text-muted">Search Record...</p>
                        <div>
                            <a href="{{ route('patient.index') }}" class="modern-btn btn-amber fixed-width-button-100">Reset</a>
                        </div>
                    </div>
                    <div class="form-row">
                    <div class="form-group col-6 col-sm-3">
                            <label for="search_name">Name</label>
                            <input type="text" class="form-control" id="search_name" name="search_name"
                                placeholder="Name"
                                value="{{ Request::old('search_name', $searchingVals['name'] ?? '') }}" maxlength="255">
                        </div>
                        <div class="form-group col-6 col-sm-2">
                            <label for="search_name">Phone No.</label>
                            <input type="text" class="form-control" id="patient_contact_no" name="patient_contact_no"
                                placeholder="Phone No."
                                value="{{ Request::old('patient_contact_no', $searchingVals['patient_contact_no'] ?? '') }}" maxlength="255">
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label for="search_patient_type">Type</label>
                                <select
                                    class="js-example-basic-single form-control" id="search_patient_type" name="search_patient_type">
                                    <option value="" selected>select type</option>
                                    @foreach ($patientTypeObj as $type)
                                        <option
                                            {{ Request::old('patient_type_id', $searchingVals['patient_type_id'] ?? '') == $type->id ? 'selected' : '' }}
                                            value="{{ $type->id }}"> 
                                            {{ $type->name }}
                                        </option>
                                        @endforeach
                                </select>
                        </div>
                        <div class="form-group col-12 col-sm-4">
                            <label for="date_range">Date Range</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="start_date" name="start_date" 
                                value="{{ Request::old('start_date', $searchingVals['start_date'] ?? '') }}" placeholder="Start Date">
                                <span class="input-group-text">to</span>
                                <input type="date" class="form-control" id="end_date" name="end_date" 
                                value="{{ Request::old('end_date', $searchingVals['end_date'] ?? '') }}" placeholder="End Date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="">
        <form action="{{ route('patient.export') }}" method="post" id="exportForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="table-div">
                        <table  id="dataTable"  class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col"><input type="checkbox" id="checkAll"></th>
                                <th scope="col" style="width:10%">Reg. No</th>
                                <th scope="col" style="width:20%">Name</th>
                                <th scope="col" style="width:15%">Contact No</th>
                                <th scope="col" style="width:10%">Type</th>
                                <th scope="col">Display</th>
                                <th scope="col" style="width:25%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataObj as $row)
                                <tr>
                                    <th scope="row"><input type="checkbox" class="checkSingle" id="check_id" name="check_id[]" value="{{ $row->id }}"></th>
                                    <td>{{ $row->patientType->name[0] }}P-{{ $row->patient_register_id }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->patient_contact_no }}</td>
                                    <td>@if ($row->patient_type_id === 1)
                                        R T P
                                        @elseif ($row->patient_type_id === 2)
                                        O T P
                                        @endif
                                    </td>
                                    <td>{{ $row->created_at->format('Y-m-d') }}</td>
                                    <td class="row">
                                        <a href="{{ route('patient.edit', $row->id) }}"
                                        class="modern-btn btn-lime fixed-width-button-100 @cannot('patient-edit') disabled @endcannot">
                                            <i class="fas fa-pencil" title="Edit"></i>
                                            Edit
                                        </a>
                                        <a href="{{ route('patient.show', $row->id) }}"
                                        class="modern-btn btn-coral fixed-width-button-100 @cannot('patient-delete') disabled @endcannot">
                                            <i class="fas fa-trash" title="Delete"></i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </form>
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
