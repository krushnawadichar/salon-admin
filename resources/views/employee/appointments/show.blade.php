{{-- resources/views/employee/appointments/show.blade.php --}}
@extends('layouts.employee')

@section('title', 'Appointment Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Appointment Details</h1>
        <a href="{{ route('employee.appointments') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-md-8">
            <!-- Appointment Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Appointment Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="text-muted">Appointment Number</label>
                            <p class="font-weight-bold">{{ $appointment->appointment_number }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted">Date & Time</label>
                            <p class="font-weight-bold">
                                {{ $appointment->appointment_date->format('l, d M Y') }} at 
                                {{ $appointment->start_time->format('H:i') }}
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted">Appointment Status</label>
                            <p>
                                <span class="badge bg-{{ $appointment->appointment_status == 'completed' ? 'success' : ($appointment->appointment_status == 'scheduled' ? 'primary' : 'danger') }} p-2">
                                    {{ ucfirst($appointment->appointment_status) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="text-muted">Payment Status</label>
                            <p>
                                <span class="badge bg-{{ $appointment->payment_status == 'paid' ? 'success' : ($appointment->payment_status == 'partial' ? 'warning' : 'danger') }} p-2">
                                    {{ ucfirst($appointment->payment_status) }}
                                </span>
                            </p>
                        </div>
                        @if($appointment->notes)
                        <div class="col-12 mb-3">
                            <label class="text-muted">Notes</label>
                            <p>{{ $appointment->notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Services Provided -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Services Provided</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointment->services as $service)
                                <tr>
                                    <td>{{ $service->name }}</td>
                                    <td>${{ number_format($service->pivot->price, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="text-end">Total Amount:</th>
                                    <th>${{ number_format($appointment->total_amount, 2) }}</th>
                                </tr>
                                @if($appointment->discount > 0)
                                <tr>
                                    <th class="text-end">Discount:</th>
                                    <th>-${{ number_format($appointment->discount, 2) }}</th>
                                </tr>
                                <tr>
                                    <th class="text-end">Final Amount:</th>
                                    <th>${{ number_format($appointment->final_amount, 2) }}</th>
                                </tr>
                                @endif
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Payments -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payments</h6>
                </div>
                <div class="card-body">
                    @if($appointment->payments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Payment #</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Method</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointment->payments as $payment)
                                    <tr>
                                        <td>{{ $payment->payment_number }}</td>
                                        <td>{{ $payment->payment_date->format('d M Y') }}</td>
                                        <td>${{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ ucfirst($payment->payment_method) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2" class="text-end">Total Paid:</th>
                                        <th>${{ number_format($appointment->payments->sum('amount'), 2) }}</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted my-3">No payments recorded yet.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Client Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Client Information</h6>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-bold">{{ $appointment->client->name }}</h5>
                    <p class="mb-1"><i class="fas fa-phone me-2"></i> {{ $appointment->client->phone }}</p>
                    @if($appointment->client->email)
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i> {{ $appointment->client->email }}</p>
                    @endif
                    @if($appointment->client->address)
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i> {{ $appointment->client->address }}</p>
                    @endif
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <small class="text-muted d-block">Total Visits</small>
                            <strong>{{ $appointment->client->total_visits }}</strong>
                        </div>
                        <div class="col-6">
                            <small class="text-muted d-block">Total Spent</small>
                            <strong>${{ number_format($appointment->client->total_spent, 2) }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    @if($appointment->appointment_status == 'scheduled')
                        <button class="btn btn-success btn-block w-100 mb-2" onclick="updateStatus('completed')">
                            <i class="fas fa-check me-2"></i> Mark as Completed
                        </button>
                        <button class="btn btn-danger btn-block w-100" onclick="updateStatus('cancelled')">
                            <i class="fas fa-times me-2"></i> Mark as Cancelled
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function updateStatus(status) {
    if (confirm('Are you sure you want to mark this appointment as ' + status + '?')) {
        $.ajax({
            url: '{{ route("employee.appointments.update-status", $appointment) }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                status: status
            },
            success: function(response) {
                if (response.success) {
                    location.reload();
                }
            }
        });
    }
}
</script>
@endpush
@endsection