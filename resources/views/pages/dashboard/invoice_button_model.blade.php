
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div style="display: flex; justify-content: center; align-Items:center; gap: 10px; margin-Top: 10px">
                <div class="btn-group" role="group">
                    <button 
                    id="drug-issue-btn" 
                        style="width: 230px; height: 40px; font-size: 1rem;" 
                        class="modern-btn btn-lime">Drug Recipt</button>
                </div>
            </div>
            <div style="display: flex; justify-content: center; align-Items:center; gap: 10px; margin-Top: 10px">
                <div class="btn-group" role="group">
                    <button 
                    id="treatement-issue-btn" 
                        style="width: 230px; height: 40px; font-size: 1rem;" 
                        class="modern-btn btn-lime">Treatement Invoice</button>
                </div>
            </div>
            <div style="display: flex; justify-content: center; align-Items:center; gap: 10px; margin-Top: 10px">
                <div class="btn-group" role="group">
                    <button 
                    id="treatement-drug-issue-btn" 
                        style="width: 230px; height: 40px; font-size: 1rem;" 
                        class="modern-btn btn-lime">Treatement And Drug Invoice</button>
                </div>
            </div>
            <!-- <div style="display: flex; justify-content: center; align-Items:center; gap: 10px; margin-Top: 10px;">
                <div class="btn-group" role="group">
                    <button 
                    id="invoice-for-today-btn" 
                        style="width: 230px; height: 40px; font-size: 1rem;" 
                        class="modern-btn btn-lime">Invoice for Today</button>
                </div>
            </div> -->
            <div style="display: flex; justify-content: center; align-Items:center; gap: 10px; margin-Top: 10px; margin-Bottom: 10px;">
                <div class="btn-group" role="group">
                    <button 
                        id="settle-btn" 
                        style="width: 230px; height: 40px; font-size: 1rem;" 
                        class="modern-btn btn-lime">Settle
                    </button>
                </div>
            </div>
        </div>
    </div>

@push('js')

<script>

$('#treatement-issue-btn').click(function () {
    const patientId = $('#patient_id').val();
    if (patientId) {
        window.open(`/treatement-invoice/${patientId}`, '_blank');
    } else {
        alert('Select a patient first');
    }
});

$('#drug-issue-btn').click(function () {
    const patientId = $('#patient_id').val();
    if (patientId) {
        window.open(`/drug-invoice/${patientId}`, '_blank');
    } else {
        alert('Select a patient first');
    }
});

$('#treatement-drug-issue-btn').click(function () {
    const patientId = $('#patient_id').val();
    if (patientId) {
        window.open(`/treatement-drug-invoice/${patientId}`, '_blank');
    } else {
        alert('Select a patient first');
    }
});

$('#settle-btn').click(function () {
    const patientId = $('#patient_id').val();
    if (patientId) {
        url = `{{ url('/invoice-settle') }}/${patientId}`;
        window.location.href = url;
    } else {
        alert('Select a patient first');
    }
});

</script>

@endpush