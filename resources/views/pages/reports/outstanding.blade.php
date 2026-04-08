@extends('layouts.app')

@section('title', __('Out-Standing Report'))

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
            <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">Other Reports / Out-Standing Report</h6>
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
    
</div>
@endsection