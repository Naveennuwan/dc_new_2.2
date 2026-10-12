<!--Advance Modal -->
<div class="modal fade" id="advanceModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header"></div>

            <div class="modal-body text-center">
                <h6>Do you want to advance this?</h6>
            </div>

            @include('pages.dashboard._form', [
                'paymentType' => 'ADVANCE',
                'label' => 'Advance Payment'
            ])

            <div class="modal-footer">
                <button class="btn bg-grey" data-dismiss="modal">Cancel</button>
                <button class="btn bg-red submit-payment">Save</button>
            </div>

        </div>
    </div>
</div>

<!--Discount Modal -->
<div class="modal fade" id="discountModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header"></div>

            <div class="modal-body text-center">
                <h6>Do you want to discount this?</h6>
            </div>

            @include('pages.dashboard._form', [
                'paymentType' => 'DISCOUNT',
                'label' => 'Discount Payment'
            ])

            <div class="modal-footer">
                <button class="btn bg-grey" data-dismiss="modal">Cancel</button>
                <button class="btn bg-red submit-payment">Save</button>
            </div>

        </div>
    </div>
</div>

<!--Image View Modal -->
<div class="modal fade" id="imageViewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Patient Images</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                @include('pages.dashboard.patient_images')
            </div>

            <div class="modal-footer">
                <button class="btn bg-grey" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- Next Visit Modal -->
<div class="modal fade" id="nextVisitModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header">
                <h5 class="modal-title">Add Next Visit</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- FORM START -->
            <form method="POST" action="{{ route('next-visit.store') }}" id="nextVisitForm">
                @csrf

                <div class="modal-body">

                    <!-- Patient -->
                    <div class="form-group">
                        <label>Patient</label>
                        <select name="patient_id"
                                class="form-control js-example-basic-single w-100"
                                required>
                            <option value="">Select patient</option>
                            @foreach ($patientObj as $patient)
                            <option
                            value="{{ $patient->id }}"
                            {{ old('patient_id', $searchingVals['patient_id'] ?? '') == $patient->id ? 'selected' : '' }}
                        >
                            {{ $patient->patientType->name[0] }}P-{{ $patient->patient_register_id }}
                            - {{ $patient->name }}
                            - {{ $patient->patient_address }}
                            - {{ $patient->patient_contact_no }}
                        </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Doctor -->
                    <div class="form-group">
                        <label>Doctor</label>
                        <select name="doctor_id"
                                class="form-control js-example-basic-single w-100"
                                required>
                            <option value="">Select doctor</option>
                            @foreach ($doctorObj as $doctor)
                                <option value="{{ $doctor->id }}">
                                    {{ $doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date & Time in ONE ROW -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Date</label>
                            <input type="date"
                                   name="appointment_date"
                                   class="form-control"
                                   required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Time</label>
                            <input type="time"
                                   name="appointment_time"
                                   class="form-control"
                                   required>
                        </div>
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>

                    <!-- ✅ Proper submit -->
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>

            </form>
            <!-- FORM END -->

        </div>
    </div>
</div>

<!-- Image Upload Modal -->
<div class="modal fade" id="imageUploadModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header"></div>

            <!-- Form -->
            <form method="POST"
                  action="{{ route('patient.image') }}"
                  id="imageUploadForm"
                  class="form-horizontal form-label-left"
                  enctype="multipart/form-data"
                  data-parsley-validate>

                @csrf

                <div class="modal-body">

                    <!-- Patient -->
                    <div class="form-group">
                        <label for="patient_id">Patient</label>
                        <select name="patient_id"
                                id="patient_id"
                                class="js-example-basic-single form-control @error('patient_id') is-invalid @enderror">
                            <option value="">Select patient</option>
                            @foreach ($patientObj as $patient)
                                <option value="{{ $patient->id }}"
                                    {{ old('patient_id', $searchingVals['patient_id'] ?? '') == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->patient_register_id }} - {{ $patient->name }} - {{ $patient->patient_address }}
                                </option>
                            @endforeach
                        </select>
                        @error('patient_id')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="form-group">
                        <label>Choose Image File <span class="text-danger">*</span></label>

                        <div class="image-preview-area mb-2">
                            <img id="image-preview"
                                 class="images-size"
                                 src="{{ old('patient_image') ?? '' }}"
                                 alt="">
                        </div>

                        @error('patient_image')
                            <span class="invalid-feedback d-block">{{ $message }}</span>
                        @enderror

                        <div class="d-flex align-items-center">
                            <label for="main-image-upload" class="modern-btn btn-aqua mr-2">
                                Choose Image
                            </label>

                            <label for="main-image-delete" class="modern-btn btn-peach">
                                Remove Image
                            </label>

                            <input type="file"
                                   name="patient_image"
                                   id="main-image-upload"
                                   accept="image/*"
                                   hidden>

                            <input type="button"
                                   id="main-image-delete"
                                   hidden>
                        </div>
                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="modern-btn btn-peach" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="modern-btn btn-lime">
                        Save
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Invoice Modal -->
<div class="modal fade" id="invoiceModal" >
@include('pages.dashboard.invoice_button_model')
</div>

        
@push('css')
<style>
    .select2-container--default .select2-selection--single {
        height: 40px;
        border-radius: 10px;
    }
    
    .select2-container {
    width: 100% !important;
}

    .select2-container .select2-selection--single {
        height: 40px;
    }

    /* ===== Common Modal Style ===== */
    .modal-content {
        border-radius: 16px;
        border: none;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0,0,0,0.25);
        background: #fff;
    }

    .modal-header {
        border-bottom: none;
        padding: 12px 16px;
    }

    .modal-body {
        padding: 20px 24px 10px;
    }

    .modal-footer {
        border-top: none;
        padding: 14px 20px 18px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    /* Close Button */
    .modal .close {
        background: #ffffff;
        border-radius: 25%;
        text-align: center;
        font-size: 22px;
        font-weight: 600;
        opacity: 1;
        border: none;
        transition: all 0.25s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    }

    .modal .close span {
        color: #333;
    }

    .modal .close:hover {
        background: #f5f5f5;
        transform: rotate(90deg) scale(1.1);
    }

    /* Inputs */
    .modal .form-control {
        border-radius: 10px;
        height: 40px;
        border: 1px solid #ddd;
        transition: 0.25s;
    }

    .modal .form-control:focus {
        box-shadow: 0 0 0 0.2rem rgba(0,0,0,0.1);
    }

    /* advanceModal */
    #advanceModal .modal-header {
        background: linear-gradient(135deg, #1e88e5, #0d47a1);
    }

    #advanceModal .form-control:focus {
        border-color: #1e88e5;
        box-shadow: 0 0 0 0.2rem rgba(30,136,229,0.3);
    }

    #advanceModal .bg-red {
        background: linear-gradient(135deg, #1e88e5, #1565c0);
        color: #fff;
    }

    /* discountModal */
    #discountModal .modal-header {
        background: linear-gradient(135deg, #8e24aa, #4a148c);
    }

    #discountModal .form-control:focus {
        border-color: #8e24aa;
        box-shadow: 0 0 0 0.2rem rgba(142,36,170,0.3);
    }

    #discountModal .bg-red {
        background: linear-gradient(135deg, #8e24aa, #6a1b9a);
        color: #fff;
    }

    /* nextVisitModal */
    #nextVisitModal .modal-header {
        background: linear-gradient(135deg, #2e7d32, #1b5e20);
    }

    #nextVisitModal .form-control:focus {
        border-color: #2e7d32;
        box-shadow: 0 0 0 0.2rem rgba(46,125,50,0.3);
    }

    #nextVisitModal .bg-red {
        background: linear-gradient(135deg, #2e7d32, #388e3c);
        color: #fff;
    }

    /* imageUploadModal */
    #imageUploadModal .modal-header {
        background: linear-gradient(135deg, #fb8c00, #ef6c00);
    }

    #imageUploadModal .form-control:focus {
        border-color: #fb8c00;
        box-shadow: 0 0 0 0.2rem rgba(251,140,0,0.3);
    }

    #imageUploadModal .btn-lime {
        background: linear-gradient(135deg, #fb8c00, #f57c00);
        color: #fff;
    }

    .modal-content {
    border-radius: 14px;
    border: none;
    box-shadow: 0 20px 40px rgba(0,0,0,.25);
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-footer {
        border-top: none;
    }

    /* ===== Theme Colors ===== */
    .modal-theme-primary .modal-header { background:#1565c0; color:#fff; }
    .modal-theme-purple .modal-header { background:#6a1b9a; color:#fff; }
    .modal-theme-success .modal-header { background:#2e7d32; color:#fff; }
    .modal-theme-warning .modal-header { background:#ef6c00; color:#fff; }

    /* ===== Image ===== */
    .images-size {
        width:100%;
        max-height:220px;
        object-fit:cover;
        border-radius:8px;
    }
</style>
@endpush

@push('js')
<script>
    $(document).on('click', '.submit-payment', function () {

    const modal = $(this).closest('.modal');
    const form  = modal.find('.other-payment-form');
    const value = form.find('.payment-input').val().trim();

    if (!value || parseInt(value) <= 0) {
        alert('Please enter a valid payment amount.');
        return;
    }

    form.submit();
    });
    
    $(document).ready(function() {
        $('#save-next-visit-btn').on('click', function() {
            $('#nextVisitForm').submit();
        });
    });

    $('#save_image_upload_btn').on('click', function () {
        $('#imageUploadForm').submit();
    });
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const fileInput   = document.getElementById('main-image-upload');
    const removeBtn   = document.getElementById('main-image-delete');
    const previewImg  = document.getElementById('image-preview');
    const form        = document.getElementById('imageUploadForm');
    const modalId     = '#imageUploadModal';

    // -----------------------------
    // IMAGE PREVIEW ON FILE SELECT
    // -----------------------------
    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];

        if (!file) {
            resetImage();
            return;
        }

        // Validate image type (optional but recommended)
        if (!file.type.startsWith('image/')) {
            alert('Please select a valid image file');
            resetImage();
            return;
        }

        const reader = new FileReader();

        reader.onload = function (event) {
            previewImg.src = event.target.result;
            previewImg.style.display = 'block';
        };

        reader.readAsDataURL(file);
    });

    // -----------------------------
    // REMOVE IMAGE
    // -----------------------------
    removeBtn.addEventListener('click', function () {
        resetImage();
    });

    function resetImage() {
        fileInput.value = '';
        previewImg.src = '';
        previewImg.style.display = 'none';
    }

    // -----------------------------
    // CANCEL BUTTON → CLOSE MODAL
    // -----------------------------
    const cancelButtons = document.querySelectorAll('[data-dismiss="modal"]');
    cancelButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            $(modalId).modal('hide');
        });
    });

    // -----------------------------
    // FORM SUBMIT (SAVE BUTTON)
    // -----------------------------
    form.addEventListener('submit', function () {
        // Optional: add loader or disable button here
        // Example:
        // document.querySelector('button[type="submit"]').disabled = true;
    });

    // -----------------------------
    // RESET FORM WHEN MODAL CLOSES
    // -----------------------------
    $(modalId).on('hidden.bs.modal', function () {
        form.reset();
        resetImage();
    });

});
</script>

@endpush