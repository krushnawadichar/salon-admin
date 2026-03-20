@extends('layouts.admin')

@section('title', 'Appointment Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Appointment #{{ $appointment->appointment_number }}</h1>
        <div>
            <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Appointment Information</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th width="35%">Appointment Number</th>
                            <td>{{ $appointment->appointment_number }}</td>
                        </tr>
                        <tr>
                            <th>Client</th>
                            <td>
                                <strong>{{ $appointment->client->name }}</strong><br>
                                <small>Phone: {{ $appointment->client->phone }}</small><br>
                                <small>Email: {{ $appointment->client->email }}</small><br>
                                <small>Total Visits: {{ $appointment->client->total_visits }}</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Employee</th>
                            <td>
                                <strong>{{ $appointment->employee->user->name ?? 'N/A' }}</strong><br>
                                <small>Type: {{ ucfirst($appointment->employee->employment_type) }}</small>
                                @if(in_array($appointment->employee->employment_type, ['commission', 'both']))
                                    <br><small>Commission: {{ $appointment->employee->commission_percentage }}%</small>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Date & Time</th>
                            <td>
                                Date: {{ $appointment->appointment_date->format('d M Y') }}<br>
                                Time: {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - 
                                      {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Services</th>
                            <td>
                                @foreach($appointment->services as $service)
                                    <span class="badge bg-info p-2 mb-1 d-inline-block">
                                        {{ $service->name }} - ₹{{ number_format($service->pivot->price) }}
                                    </span>
                                    @if(!$loop->last)<br>@endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Amount Details</th>
                            <td>
                                Total: ₹{{ number_format($appointment->total_amount, 2) }}<br>
                                Discount: ₹{{ number_format($appointment->discount, 2) }}<br>
                                <strong>Final: ₹{{ number_format($appointment->final_amount, 2) }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-{{ $appointment->appointment_status == 'completed' ? 'success' : ($appointment->appointment_status == 'scheduled' ? 'primary' : 'danger') }} p-2">
                                    {{ ucfirst($appointment->appointment_status) }}
                                </span>
                                <span class="badge bg-{{ $appointment->payment_status == 'paid' ? 'success' : ($appointment->payment_status == 'partial' ? 'warning' : 'danger') }} p-2">
                                    Payment: {{ ucfirst($appointment->payment_status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Notes</th>
                            <td>{{ $appointment->notes ?? 'No notes' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-xl-6 col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Payments</h6>
                    @if($appointment->payment_status != 'paid')
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#paymentModal">
                            <i class="fas fa-money-bill"></i> Add Payment
                        </button>
                    @endif
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
                                            <td>{{ $payment->payment_date->format('d M Y h:i A') }}</td>
                                            <td>₹{{ number_format($payment->amount, 2) }}</td>
                                            <td>{{ ucfirst($payment->payment_method) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-light font-weight-bold">
                                        <td colspan="2" class="text-right">Total Paid:</td>
                                        <td colspan="2">₹{{ number_format($appointment->payments->sum('amount'), 2) }}</td>
                                    </tr>
                                    <tr class="bg-light">
                                        <td colspan="2" class="text-right">Remaining:</td>
                                        <td colspan="2">₹{{ number_format($appointment->final_amount - $appointment->payments->sum('amount'), 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center">No payments recorded yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.appointments.payment', $appointment) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="amount">Amount (₹)</label>
                        <input type="number" name="amount" id="amount" class="form-control" 
                               step="0.01" min="0.01" 
                               max="{{ $appointment->final_amount - $appointment->payments->sum('amount') }}" 
                               value="{{ $appointment->final_amount - $appointment->payments->sum('amount') }}" required>
                        <small class="text-muted">
                            Remaining: ₹{{ number_format($appointment->final_amount - $appointment->payments->sum('amount'), 2) }}
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label for="payment_method">Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="upi">UPI</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="payment_notes">Notes</label>
                        <textarea name="notes" id="payment_notes" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Process Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection