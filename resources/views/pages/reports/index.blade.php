@extends('layouts.app')

@section('title', __('Supplier'))

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
                <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">Other Reports</h6>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-right">
                <div class="btn-toolbar justify-content-end text-right" role="toolbar" aria-label="Toolbar with button groups">
                    @include('components.toolbar', ['showExportButton' => false,'showSearchButton' => false])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="">
        <h2 class="mb-4">Sales Reports</h2>

        <div class="row">

            <div class="col-md-4 mb-3">
                <a href="{{ route('reports.daily') }}" class="btn btn-primary w-100">
                    Daily Sales Report
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{ route('reports.monthly') }}" class="btn btn-success w-100">
                    Monthly Sales Report
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{ route('reports.doctor') }}" class="btn btn-info w-100">
                    Doctor Revenue Report
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{ route('reports.treatment') }}" class="btn btn-warning w-100">
                    Treatment Sales Report
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{ route('reports.center') }}" class="btn btn-secondary w-100">
                    Center Sales Report
                </a>
            </div>

            <div class="col-md-4 mb-3">
                <a href="{{ route('reports.outstanding') }}" class="btn btn-danger w-100">
                    Outstanding Payments
                </a>
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
