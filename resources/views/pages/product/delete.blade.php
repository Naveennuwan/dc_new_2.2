@extends('layouts.app')

@section('title', __('Product'))

@section('toolbar')
    <div class="toolbar">
        <div class="row col-12 col-sm-12 col-md-12">
            <div class="col-12 col-sm-5 col-md-6">
            <h6 class="text-muted font-weight-bold modern-toolbar-title toolbar-3d-title">Product / Delete </h6>
            </div>
            <div class="col-12 col-sm-7 col-md-6 text-right">
                <div class="btn-toolbar justify-content-end text-right" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group">
                        <a href="{{ route('product.index') }}"
                            class="btn btn-sm back-btn-color fixed-width-button-100">Back</a>
                    </div>
                    <div class="btn-group mr-2" role="group">
                    <button id="delete-btn" class="modern-btn fixed-width-button-130 btn-coral" data-toggle="modal" data-target="#deleteModal">Delete</button>
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
                        <form method="POST" action="{{ route('product.destroy', $dataObj->id) }}" name="deleteForm"
                            id="deleteForm">
                            @csrf
                            @method('delete')
                            <div class="card">
                                <div class="card-body">
                                    @include('pages.product.body')
                                </div>
                            </div>
                        </form>
                        <div class="">
                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                                aria-labelledby="deleteModalTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body text-center mt-3 mb-3">
                                            <h6 class="modal-title" id="deleteModalTitle">Do you want to delete this ?</h6>
                                        </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="modern-btn btn-amber fixed-width-button-100"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="button" class="modern-btn btn-lime fixed-width-button-100"
                                                onclick="deleteSubmit()">Ok</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        disabledForm();
    });

    function disabledForm() {
        var input_text = document.querySelectorAll('input[type="text"]');
        for (var i = 0; i < input_text.length; i++) {
            input_text[i].disabled = true;
        }

        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            checkboxes[i].disabled = true;
        }

        var input_file = document.querySelectorAll('input[type="file"]');
        for (var i = 0; i < input_file.length; i++) {
            input_file[i].disabled = true;
        }

        var input_delete = document.querySelectorAll('input[type="delete"]');
        for (var i = 0; i < input_delete.length; i++) {
            input_delete[i].disabled = true;
        }

    }
</script>
    <script>
        $(document).ready(function() {
            $('#delete-btn').on('click', function() {
                $('#deleteModal').modal('show');
            });
        });

        function deleteSubmit() {
            document.getElementById("deleteForm").submit();
        }
    </script>
@endpush
