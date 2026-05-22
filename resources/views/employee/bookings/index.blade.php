@extends('layouts.employee')

@section('title', 'Appointments')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Appointments</h1>
        <a href="{{ route('employee.booking.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Appointment
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Appointment #</th>
                            <th>Client</th>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Services</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Appointment Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_number }}</td>
                            <td>{{ $appointment->client->name }}</td>
                            <td>{{ $appointment->employee->user->name }}</td>
                            <td>{{ $appointment->appointment_date->format('d M Y') }}</td>
                            <td>{{ $appointment->start_time->format('H:i') }}</td>
                            <td>
                                @foreach($appointment->services as $service)
                                    <span class="badge bg-info">{{ $service->name }}</span>
                                @endforeach
                            </td>
                            <td>₹{{ number_format($appointment->final_amount, 2) }}</td>
                            <td>
                            <button type="button"
                                class="btn btn-sm 
                                {{ $appointment->payment_status == 'paid' ? 'btn-success' : ($appointment->payment_status == 'partial' ? 'btn-warning' : 'btn-danger') }}"
                                data-bs-toggle="modal"
                                data-bs-target="#paymentModal{{ $appointment->id }}">

                                @if($appointment->payment_status == 'paid')
                                    <i class="fas fa-check-circle"></i> Paid
                                @elseif($appointment->payment_status == 'partial')
                                    <i class="fas fa-hourglass-half"></i> Partial
                                @else
                                    <i class="fas fa-clock"></i> Pending
                                @endif
                            </button>

                                <!-- Payment Status Modal -->
                                <div class="modal fade"
                                    id="paymentModal{{ $appointment->id }}"
                                    tabindex="-1"
                                    role="dialog">

                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content shadow">

                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title">
                                                    Change Payment Status
                                                </h5>
                                                <button type="button"
                                                    class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <strong>Appointment:</strong>
                                                    {{ $appointment->appointment_number }}
                                                    <br>

                                                    <strong>Client:</strong>
                                                    {{ $appointment->client->name }}
                                                    <br>

                                                    <strong>Total Amount:</strong>
                                                    ₹{{ number_format($appointment->final_amount, 2) }}
                                                </div>

                                                <form action="{{ route('employee.booking.update-payment-status', $appointment) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('PATCH')

                                                    <!-- Payment Status -->
                                                    <div class="form-group">
                                                        <label>
                                                            Payment Status
                                                        </label>

                                                        <select class="form-control payment-status"
                                                            name="payment_status"
                                                            data-id="{{ $appointment->id }}">

                                                            <option value="pending"
                                                                {{ $appointment->payment_status == 'pending' ? 'selected' : '' }}>
                                                                ⏳ Pending
                                                            </option>

                                                            <option value="partial"
                                                                {{ $appointment->payment_status == 'partial' ? 'selected' : '' }}>
                                                                🔶 Partial
                                                            </option>

                                                            <option value="paid"
                                                                {{ $appointment->payment_status == 'paid' ? 'selected' : '' }}>
                                                                ✅ Paid
                                                            </option>

                                                            <option value="refunded"
                                                                {{ $appointment->payment_status == 'refunded' ? 'selected' : '' }}>
                                                                ↩️ Refunded
                                                            </option>
                                                        </select>
                                                    </div>

                                                    <!-- Partial Payment -->
                                                    <div id="paymentFields{{ $appointment->id }}"
                                                        style="{{ $appointment->payment_status == 'partial' ? '' : 'display:none;' }}">

                                                        <div class="form-group">
                                                            <label>
                                                                Payment Amount
                                                            </label>

                                                            <div class="input-group">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        ₹
                                                                    </span>
                                                                </div>

                                                                <input type="number"
                                                                    class="form-control"
                                                                    step="0.01"
                                                                    min="0.01"
                                                                    max="{{ $appointment->final_amount }}"
                                                                    name="payment_amount"
                                                                    value="{{ $appointment->final_amount }}">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>
                                                                Payment Method
                                                            </label>

                                                            <select class="form-control"
                                                                name="payment_method">

                                                                <option value="cash">💵 Cash</option>
                                                                <option value="card">💳 Card</option>
                                                                <option value="upi">📱 UPI</option>
                                                                <option value="other">🔄 Other</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <button type="submit"
                                                        class="btn btn-primary btn-block mt-2">

                                                        <i class="fas fa-save"></i>
                                                        Update Status
                                                    </button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-{{ $appointment->appointment_status == 'completed' ? 'success' : ($appointment->appointment_status == 'scheduled' ? 'primary' : 'danger') }}">
                                    {{ ucfirst($appointment->appointment_status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('employee.booking.show', $appointment) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('employee.booking.edit', $appointment) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
               {{ $appointments->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).on('change', '.payment-status', function () {

        let id = $(this).data('id');
        let status = $(this).val();

        if (status === 'partial') {
            $('#paymentFields' + id).slideDown();
        } else {
            $('#paymentFields' + id).slideUp();
        }
    });
</script>
@endpush