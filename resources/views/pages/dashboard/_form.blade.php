<form method="POST"
      action="{{ route('other-payment.store') }}"
      class="other-payment-form"
      data-payment-type="{{ $paymentType }}">
    @csrf

    <input type="hidden" name="payment_type" value="{{ $paymentType }}">
    <input type="hidden" name="isSettled" value="0">

    <div class="card-body">
        <div class="form-row">
            <div class="form-group col-sm-6">
                <label>Patient</label>
                <select class="js-example-basic-single form-control @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id">
                                        <option value="" selected>select patient</option>
                                        @foreach ($patientObj as $patient)
                                        <option {{ Request::old('patient_id', $searchingVals['patient_id'] ?? '') == $patient->id ? 'selected' : '' }} value="{{ $patient->id }}">
                                            {{ $patient->patient_register_id }} - {{ $patient->name }} - {{ $patient->patient_address }}
                                        </option>
                                        @endforeach
                                    </select>
            </div>

            <div class="form-group col-sm-6">
                <label>{{ $label }}</label>
                <input type="text"
                       name="payment"
                       class="form-control payment-input"
                       maxlength="8"
                       required
                       oninput="this.value=this.value.replace(/[^0-9]/g,'')">
            </div>
        </div>
    </div>
</form>
