@extends('layouts.app')

@section('title', __('Alergy'))

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
                <h6 class="text-muted">@lang('general.nav.master_control') / Alergy / Edit</h6>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-right">
                <div class="btn-toolbar justify-content-end text-right" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group">
                        <a href="{{ route('alergy.index') }}"
                            class="btn btn-sm back-btn-color fixed-width-button-100">Back</a>
                    </div>
                    <div class="btn-group mr-2" role="group">
                        <button id="save-btn" class="btn btn-sm create-btn-color fixed-width-button-100"
                            value="edit">Save Changers</button>
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
                        <form method="post" action="{{ route('alergy.update', $dataObj->id) }}" name="editForm"
                            id="editForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    @include('pages.alergy.body')
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
                $('#editForm').submit();
            });
        });
    </script>
@endpush
