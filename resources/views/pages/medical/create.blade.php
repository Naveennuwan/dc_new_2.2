@extends('layouts.app')

@section('title', __('Medical Certificates'))

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
            <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">Medical Certificates / Create</h6>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-right">
                <div class="btn-toolbar justify-content-end text-right" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group">
                        <a href="{{ route('medical.index') }}"
                        class="modern-btn btn-azure fixed-width-button-120">Back</a>
                    </div>
                    <div class="btn-group mr-2" role="group">
                    <button id="save-btn" class="modern-btn btn-lime fixed-width-button-120">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <br />
                        <form method="post" action="{{ route('medical.store') }}" name="addForm" id="addForm"
                            data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    @include('pages.medical.body')
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            $('#save-btn').on('click', function() {
                $('#addForm').submit();
            });
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('isDisplay').checked = true;
    });
</script>
@endpush
