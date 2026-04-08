@if(count($routineTemplateObj))
    @if(count($templateTypeObj))
        @foreach ($templateTypeObj->filter(function ($type) { return $type->id === 1; }) as $type)
        <div class="card mb-3">
            <div class="card-header">
                {{ $type->name }}
            </div>
            <div class="card-body card-grid">
                <div class="container text-center">
                    <div class="row row-cols-4">
                        @foreach ($routineTemplateObj->where('template_type_id', $type->id) as $template)
                        <div class="col-4">
                        @include('pages.dashboard.template_button', [
                            'template'       => $template,
                            'patientDetails' => $patientDetails ?? null,
                            'btnClass'       => 'modern-btn btn-emerald',
                            'width'          => '230px',
                        ])
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="row">
        @foreach ($templateTypeObj->filter(function ($type) {return $type->id !== 1; }) as $type)
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-header">
                        {{ $type->name }}
                    </div>
                    <div class="card-body card-grid">
                        @foreach ($routineTemplateObj->where('template_type_id', $type->id) as $template)
                        <div>
                        @include('pages.dashboard.template_button', [
                            'template'       => $template,
                            'patientDetails' => $patientDetails ?? null,
                            'btnClass'       => 'modern-btn btn-sapphire',
                            'width'          => '210px',
                        ])
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
@endif

@if(count($orthodonticTemplateObj))
<div class="card mb-3">
    <div class="card-header">
        Orthodontic Template
    </div>
    <div class="card-body card-grid">
        <div class="container text-center">
            <div class="row row-cols-2">
                @foreach ($orthodonticTemplateObj as $template)
                <div class="col">
                @include('pages.dashboard.template_button', [
                    'template'       => $template,
                    'patientDetails' => $patientDetails ?? null,
                    'btnClass'       => 'modern-btn btn-amber',
                    'width'          => '300px',
                ])
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

@if(count($IssueingTemplateObj))
<div class="card mb-3">
    <div class="card-header">
        Issueing Drug Template
    </div>
    <div class="card-body card-grid">
        <div class="container text-center">
            <div class="row row-cols-2">
                @foreach ($IssueingTemplateObj as $template)
                <div class="col">
                    <button type="button" class="modern-btn btn-amethyst" style="width: 300px;"
                        onclick="handleIsPrint('{{ $template->id }}')">
                        <i class="bi bi-box-arrow-up-right"></i>
                        {{ $template->name }}
                    </button>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif

<!--Template Payment Section Modal -->
<div class="modal fade" id="templatePaymentSectionModal" tabindex="-1" role="dialog" aria-labelledby="templatePaymentSectionModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <h5 class="modal-title text-white" id="templatePaymentSectionModalTitle">Select Payment</h5>
                <button type="button" class="close bg-white-font" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="template-details mb-3">
                    <p id="template-id-display" class="mb-1"></p>
                    <p id="template-name-display" class="mb-1"></p>
                    <p id="template-price-display" class="mb-1"></p>
                </div>
                <div class="text-center">
                    <p>Please select your payment option:</p>
                </div>
                
                <!-- Initial Payment Options -->
                <div class="text-center mt-3" id="initial-payment-options">
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <button type="button" class="modern-btn btn-lime flex-grow-1" style="max-width: 45%; height: 30px; font-size: 0.8rem;" id="pay-now-btn">Pay Now</button>
                        <button type="button" class="modern-btn btn-aqua flex-grow-1" style="max-width: 45%; height: 30px; font-size: 0.8rem;" id="pay-later-btn">Pay Later</button>
                    </div>
                </div>

                <!-- Pay Now Options (hidden initially) -->
                <div class="text-center mt-3" id="pay-now-options" style="display: none;">

                <div class="form-group mt-3">
                        <label for="custom-amount">Enter Custom Amount:</label>
                        <input type="number" class="form-control" id="custom-amount" placeholder="Enter amount">
                    </div>

                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <button type="button" class="modern-btn btn-lime mt-2" style="width: 300px; height: 30px; font-size: 0.8rem;" id="submit-custom-payment">Submit Payment</button>
                        <button type="button" class="modern-btn btn-rose flex-grow-1" style="max-width: 30%; height: 30px; font-size: 0.8rem;" id="back-to-options-btn">Back</button>
                    </div>


                    <!-- <div class="d-flex justify-content-center align-items-center gap-3">
                    <button type="button" class="modern-btn btn-lime mt-2" style="width: 300px; height: 30px; font-size: 0.8rem;" id="submit-custom-payment">Submit Payment</button>
                        <button type="button" class="modern-btn btn-lime flex-grow-1" style="max-width: 30%; height: 30px; font-size: 0.8rem;" id="full-payment-btn">Full Payment</button>
                        <button type="button" class="modern-btn btn-aqua flex-grow-1" style="max-width: 30%; height: 30px; font-size: 0.8rem;" id="custom-payment-btn">Custom Payment</button>
                        <button type="button" class="modern-btn btn-rose flex-grow-1" style="max-width: 30%; height: 30px; font-size: 0.8rem;" id="back-to-options-btn">Back</button>
                    </div> -->
                </div>
                
                <!-- Custom Payment Form (hidden initially) -->
                <!-- <div id="custom-payment-form" style="display: none;">
                    <div class="form-group mt-3">
                        <label for="custom-amount">Enter Custom Amount:</label>
                        <input type="number" class="form-control" id="custom-amount" placeholder="Enter amount">
                    </div>

                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <button type="button" class="modern-btn btn-lime mt-2" style="width: 300px; height: 30px; font-size: 0.8rem;" id="submit-custom-payment">Submit Payment</button>
                        <button type="button" class="modern-btn btn-rose mt-2" style="width: 300px; height: 30px; font-size: 0.8rem;" id="back-to-pay-options">Back</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<!-- Confirm Modal -->
<div class="modal fade" id="confirmTemplateModal" tabindex="-1" role="dialog" aria-labelledby="confirmTemplateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="confirmTemplateModalLabel">Confirm Action</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p id="confirm-template-name" class="mb-2"></p>
        <p><strong>Are you sure you want to add this Treatement ?</strong></p>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="modern-btn btn-rose" data-dismiss="modal">Cancel</button>
        <button type="button" class="modern-btn btn-lime" id="confirm-template-btn">Yes, Proceed</button>
      </div>
    </div>
  </div>
</div>


<!--PrintModal Modal -->
<div class="modal fade" id="isPrintModal" tabindex="-1" role="dialog" aria-labelledby="imageUploadModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-black">
                <button type="button" class="close bg-white-font" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to change the isPrint status for this template?</p>
                <input type="hidden" name="template_id" id="template_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" id="printButton" onclick="handleDrugIssueButtonClick('print')">Print</button>
                <button type="submit" class="btn btn-primary" id="issueButton" onclick="handleDrugIssueButtonClick('issue')">Issue</button>
            </div>
        </div>
    </div>
</div>

@push('css')
<style>
    .card-grid {
        height: 350px;
        overflow-y: auto;
        white-space: nowrap; 
    }
    
    .template-details {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        border-left: 4px solid #28a745;
    }

    .template-details p {
        margin-bottom: 5px;
        font-size: 0.9rem;
    }
</style>
@endpush

@push('js')
<!--Template Button Clicks -->
<script> 
    function handleButtonClick(templateId) {
        const patientId = document.getElementById('patient_id').value;
        const doctorId = document.getElementById('doctor_id').value;
        // const payment = document.getElementById('payment').value;
        
        // Get the clicked button to extract template details
        const clickedButton = event.target;
        const templateName = clickedButton.textContent.trim();
        // Assuming you have data attributes for price and ID on the button
        const templatePrice = clickedButton.getAttribute('data-price') || 'N/A';
        
        // Set the template details in the modal before showing it
        document.getElementById('templatePaymentSectionModalTitle').textContent = `Payment for ${templateName}`;
        document.getElementById('template-id-display').textContent = `Template ID: ${templateId}`;
        document.getElementById('template-name-display').textContent = `Name: ${templateName}`;
        document.getElementById('template-price-display').textContent = `Price: ${templatePrice}`;
        
        $('#templatePaymentSectionModal').modal('show');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Pay Now button click handler
        document.getElementById('pay-now-btn').addEventListener('click', function() {
            document.getElementById('initial-payment-options').style.display = 'none';
            document.getElementById('pay-now-options').style.display = 'block';
        });
        
        // Back button from Pay Now options
        document.getElementById('back-to-options-btn').addEventListener('click', function() {
            document.getElementById('pay-now-options').style.display = 'none';
            document.getElementById('initial-payment-options').style.display = 'block';
        });
        
        // Custom Payment button click handler
        // document.getElementById('custom-payment-btn').addEventListener('click', function() {
        //     document.getElementById('pay-now-options').style.display = 'none';
        //     document.getElementById('custom-payment-form').style.display = 'block';
        // });
        
        // Back button from Custom Payment form
        // document.getElementById('back-to-pay-options').addEventListener('click', function() {
        //     document.getElementById('custom-payment-form').style.display = 'none';
        //     document.getElementById('pay-now-options').style.display = 'block';
        // });
        
        // Submit Custom Payment handler
        document.getElementById('submit-custom-payment').addEventListener('click', function() {
            const customAmount = document.getElementById('custom-amount').value;
            const templateId = document.getElementById('template-id-display').textContent.replace(/\D+/g, '');
            const patientId = document.getElementById('patient_id').value;
            const doctorId = document.getElementById('doctor_id').value;
            
            if (!customAmount || isNaN(customAmount)) {
                alert('Please enter a valid amount');
                return;
            }else if (!patientId) {
                alert('Please Select The Patient.');
                return;
            }else if (!doctorId) {
                alert('Please Select The Doctor.');
                return;
            } else {
                const url = `{{ url('/invoice') }}/${templateId}/${patientId}/${doctorId}/${customAmount}`;
                window.location.href = url;
            }
        });
        
        // Full Payment button handler
        // document.getElementById('full-payment-btn').addEventListener('click', function() {
        //     const priceText = document.getElementById('template-price-display').textContent;
        //     const templatePrice = parseFloat(priceText.replace(/[^\d.]/g, ''));
        //     const templateId = document.getElementById('template-id-display').textContent.replace(/\D+/g, '');
        //     const patientId = document.getElementById('patient_id').value;
        //     const doctorId = document.getElementById('doctor_id').value;
            
        //     if (!patientId) {
        //         alert('Please Select The Patient.');
        //         return;
        //     }else if (!doctorId) {
        //         alert('Please Select The Doctor.');
        //         return;
        //     } else {
        //         const url = `{{ url('/invoice') }}/${templateId}/${patientId}/${doctorId}/${templatePrice}`;
        //         window.location.href = url;
        //     }
        // });
        
        // Later Payment button handler
        document.getElementById('pay-later-btn').addEventListener('click', function() {
            const templatePrice = 0;
            const templateId = document.getElementById('template-id-display').textContent.replace(/\D+/g, '');
            const patientId = document.getElementById('patient_id').value;
            const doctorId = document.getElementById('doctor_id').value;
            
            if (!patientId) {
                alert('Please Select The Patient.');
                return;
            }else if (!doctorId) {
                alert('Please Select The Doctor.');
                return;
            } else {
                const url = `{{ url('/invoice') }}/${templateId}/${patientId}/${doctorId}/${templatePrice}`;
                window.location.href = url;
            }
        });
    });

    function handleIsPrint(templateId) {
        document.getElementById('template_id').value = templateId;
        document.getElementById('printButton').setAttribute('data-template-id', templateId);
        document.getElementById('issueButton').setAttribute('data-template-id', templateId);
        
        // Show the modal
        var changeIsPrintModal = new bootstrap.Modal(document.getElementById('isPrintModal'));
        changeIsPrintModal.show();
    }
    
    function handleDrugIssueButtonClick(action) {
        const templateId = document.getElementById(action + 'Button').getAttribute('data-template-id');
        const patientId = document.getElementById('patient_id').value;
        const doctorId = document.getElementById('doctor_id').value;
        
        if (patientId && doctorId) {
            url = `{{ url('/invoice-drug') }}/${templateId}/${patientId}/${doctorId}/${action}`;
            window.location.href = url;
        } else {
            alert('Please select both patient and doctor.');
            $('#isPrintModal').modal('hide');
        }
    }
</script>


<!--Orthodontic Button Clicks -->
<script> 
let selectedTemplateId = null;

function handleOrthodonticButtonClick(templateId) {
    const patientId = document.getElementById('patient_id').value;
    const doctorId = document.getElementById('doctor_id').value;

    if (!patientId) {
        alert('Please Select The Patient.');
        return;
    }
    if (!doctorId) {
        alert('Please Select The Doctor.');
        return;
    }

    selectedTemplateId = templateId;

    // Set template name in modal (optional)
    const clickedButton = event.currentTarget;
    const templateName = clickedButton.getAttribute("data-name");
    document.getElementById("confirm-template-name").textContent = `Template: ${templateName}`;

    // Show the confirm modal
    $('#confirmTemplateModal').modal('show');
}

document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("confirm-template-btn").addEventListener("click", function () {
        const patientId = document.getElementById('patient_id').value;
        const doctorId = document.getElementById('doctor_id').value;

        if (selectedTemplateId && patientId && doctorId) {
            const url = `{{ url('/invoice') }}/${selectedTemplateId}/${patientId}/${doctorId}/0`;
            window.location.href = url;
        }
    });
});

</script>
@endpush