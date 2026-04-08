@extends('layouts.app')

@section('title', __('Leave Certificates'))

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
                <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">Patient / Leave Certificates / List</h6>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-right">
                <div class="btn-toolbar justify-content-end text-right" role="toolbar" aria-label="Toolbar with button groups">
                @include('components.toolbar', ['showExportButton' => false, 'showSearchButton' => true])
                    <div class="btn-group" role="group">
                        <a href="{{ route('leave.create') }}"
                            class="modern-btn btn-lime fixed-width-button-120 @cannot('center-create') disabled @endcannot">Create Record</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="">
        <form action="{{ route('leave.search') }}" method="post" id="searchForm" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <p class="text-muted">Search Record...</p>
                        <div>
                            <a href="{{ route('leave.index') }}" class="modern-btn btn-amber fixed-width-button-100">Reset</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-2">
                            <label for="search_id">Id</label>
                            <input type="text" class="form-control" id="search_id" name="search_id"
                                placeholder="Id"
                                value="{{ Request::old('search_id', $searchingVals['id'] ?? '') }}" maxlength="255">
                        </div>
                        <div class="form-group col-12 col-sm-5">
                            <label for="search_name">Name</label>
                            <input type="text" class="form-control" id="search_name" name="search_name"
                                placeholder="Name"
                                value="{{ Request::old('search_name', $searchingVals['name'] ?? '') }}" maxlength="255">
                        </div>
                        <div class="form-group col-12 col-sm-2 col-md-2">
                            <label for="search_display">Display</label>
                            <select class="js-example-basic-single form-control" id="search_display" name="search_display">
                                <option value="" selected>All</option>
                                <option value="1"
                                    {{ Request::old('search_display', $searchingVals['isDisplay'] ?? '') == '1' ? 'selected' : '' }}>
                                    Display</option>
                                <option value="0"
                                    {{ Request::old('search_display', $searchingVals['isDisplay'] ?? '') == '0' ? 'selected' : '' }}>
                                    Hidden</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <br>
    <div class="">
        <form action="{{ route('leave.export') }}" method="post" id="exportForm">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive" id="table-div">
                        <table  id="dataTable"  class="table">
                            <thead class="thead-dark">
                                <tr>
                                <th scope="col"><input type="checkbox" id="checkAll"></th>
                                <th scope="col" style="width:30%">Name</th>
                                <th scope="col" style="width:30%">Surgeon</th>
                                <th scope="col" style="width:40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dataObj as $row)
                                <tr>
                                    <th scope="row"><input type="checkbox" class="checkSingle" id="check_id" name="check_id[]" value="{{ $row->id }}"></th>
                                    <td>{{ $row->patient->name }}</td>
                                    <td>{{ $row->doctor->name }}</td>
                                    <td class="row">
                                    <a href="{{ route('leave.report', $row->id) }}"
                                        class="modern-btn btn-lime fixed-width-button-100 @cannot('center-edit') disabled @endcannot">
                                            <i class="fas fa-download" title="Report"></i>
                                            Download
                                        </a>
                                        <a href="{{ route('leave.show', $row->id) }}"
                                        class="modern-btn btn-coral fixed-width-button-100 @cannot('center-delete') disabled @endcannot">
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
