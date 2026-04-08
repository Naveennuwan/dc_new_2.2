<div class="form-group {{ $colClass }}">
    <div class="card h-100">
        <div class="card-body">
            <div class="table-responsive">

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th style="width:30%">Date</th>
                            <th style="text-align:right;width:40%">{{ $title }}</th>
                            <th style="text-align:right;width:30%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($payments as $row)
                            <tr>
                                <td>{{ $row->created_at }}</td>
                                <td class="text-right">
                                    {{ number_format($row->payment, 2) }}
                                </td>
                                <td class="text-right">
                                    <form action="{{ route('other-payment.destroy', $row->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="modern-btn btn-coral"
                                                onclick="return confirm('{{ $confirmText }}')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td><strong>Total</strong></td>
                            <td class="text-right">
                                <strong>{{ number_format($total, 2) }}</strong>
                            </td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
