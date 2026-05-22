@extends('layouts.employee')

@section('title', 'Edit Appointment')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Appointment #{{ $appointment->appointment_number }}</h1>
        <div>
            <a href="{{ route('employee.booking.show', $appointment) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> View Details
            </a>
            <a href="{{ route('employee.booking.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Appointment Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('employee.booking.update', $appointment) }}" method="POST" id="appointmentForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label>
                                <select class="form-control @error('client_id') is-invalid @enderror" 
                                        id="client_id" name="client_id" required>
                                    <option value="">Select Client</option>
                                    @foreach($clients as $client)
                                        <option value="{{ $client->id }}" 
                                            {{ old('client_id', $appointment->client_id) == $client->id ? 'selected' : '' }}>
                                            {{ $client->name }} 
                                            @if($client->phone)
                                                ({{ $client->phone }})
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('client_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="employee_id" class="form-label">Employee/Barber <span class="text-danger">*</span></label>
                                <select class="form-control @error('employee_id') is-invalid @enderror" 
                                        id="employee_id" name="employee_id" required>
                                    <option value="">Select Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" 
                                            {{ old('employee_id', $appointment->employee_id) == $employee->id ? 'selected' : '' }}
                                            data-employment-type="{{ $employee->employment_type }}"
                                            data-commission="{{ $employee->commission_percentage }}">
                                            {{ $employee->user->name }} 
                                            ({{ ucfirst($employee->employment_type) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="appointment_date" class="form-label">Appointment Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('appointment_date') is-invalid @enderror" 
                                       id="appointment_date" name="appointment_date" 
                                       value="{{ old('appointment_date', $appointment->appointment_date->format('Y-m-d')) }}" 
                                       min="{{ now()->format('Y-m-d') }}"
                                       required>
                                @error('appointment_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="start_time" class="form-label">Start Time <span class="text-danger">*</span></label>
                                <input type="time" class="form-control @error('start_time') is-invalid @enderror" 
                                       id="start_time" name="start_time" 
                                       value="{{ old('start_time', $appointment->start_time->format('H:i')) }}" 
                                       required>
                                @error('start_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label class="form-label">End Time</label>
                                <input type="text" class="form-control" id="end_time_display" 
                                       value="{{ $appointment->end_time->format('H:i') }}" readonly>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="appointment_status" class="form-label">Appointment Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('appointment_status') is-invalid @enderror" 
                                        id="appointment_status" name="appointment_status" required>
                                    <option value="scheduled" {{ old('appointment_status', $appointment->appointment_status) == 'scheduled' ? 'selected' : '' }}>
                                        ⏳ Scheduled
                                    </option>
                                    <option value="confirmed" {{ old('appointment_status', $appointment->appointment_status) == 'confirmed' ? 'selected' : '' }}>
                                        ✅ Confirmed
                                    </option>
                                    <option value="in_progress" {{ old('appointment_status', $appointment->appointment_status) == 'in_progress' ? 'selected' : '' }}>
                                        🔧 In Progress
                                    </option>
                                    <option value="completed" {{ old('appointment_status', $appointment->appointment_status) == 'completed' ? 'selected' : '' }}>
                                        ✔️ Completed
                                    </option>
                                    <option value="cancelled" {{ old('appointment_status', $appointment->appointment_status) == 'cancelled' ? 'selected' : '' }}>
                                        ❌ Cancelled
                                    </option>
                                    <option value="no_show" {{ old('appointment_status', $appointment->appointment_status) == 'no_show' ? 'selected' : '' }}>
                                        🚫 No Show
                                    </option>
                                </select>
                                @error('appointment_status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <h5 class="border-bottom pb-2 mb-3">
                            Select Services
                            <small class="text-muted">(Select at least one service)</small>
                        </h5>
                        
                        <div class="row mb-4">
                            @foreach($services as $service)
                            <div class="col-md-4 col-lg-3 mb-3">
                                <div class="card service-card h-100 {{ in_array($service->id, $selectedServices) ? 'border-primary selected' : '' }}">
                                    <div class="card-body">
                                        <div class="form-check">
                                            <input class="form-check-input service-checkbox" type="checkbox" 
                                                   name="services[]" value="{{ $service->id }}" 
                                                   id="service{{ $service->id }}"
                                                   data-price="{{ $service->price }}"
                                                   data-duration="{{ $service->duration }}"
                                                   {{ in_array($service->id, old('services', $selectedServices)) ? 'checked' : '' }}>
                                            <label class="form-check-label font-weight-bold" for="service{{ $service->id }}">
                                                {{ $service->name }}
                                            </label>
                                        </div>
                                        <div class="mt-2 small">
                                            <div>₹{{ number_format($service->price, 2) }} | {{ $service->duration }} mins</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('services')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Total Duration</label>
                                <input type="text" class="form-control" id="total_duration" readonly value="0">
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Total Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">₹</span>
                                    <input type="text" class="form-control" id="total_amount" readonly value="0.00">
                                </div>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="discount" class="form-label">Discount ($)</label>
                                <input type="number" step="0.01" min="0" class="form-control @error('discount') is-invalid @enderror" 
                                       id="discount" name="discount" value="{{ old('discount', $appointment->discount) }}">
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label class="form-label">Final Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" class="form-control font-weight-bold text-primary" 
                                           id="final_amount" readonly value="0.00">
                                </div>
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="notes" class="form-label">Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" 
                                          id="notes" name="notes" rows="2">{{ old('notes', $appointment->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Appointment
                            </button>
                            
                            @if($appointment->appointment_status != 'completed' && $appointment->appointment_status != 'cancelled')
                                <div>
                                    <button type="button" class="btn btn-success" onclick="quickComplete()">
                                        <i class="fas fa-check-circle"></i> Quick Complete
                                    </button>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Payment Section -->
        <div class="col-lg-4">
            <!-- Payment Status Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payment Information</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        @php
                            $statusColors = [
                                'paid' => 'success',
                                'partial' => 'warning',
                                'pending' => 'secondary',
                                'refunded' => 'danger'
                            ];
                            $statusIcon = [
                                'paid' => 'check-circle',
                                'partial' => 'exclamation-circle',
                                'pending' => 'clock',
                                'refunded' => 'undo'
                            ];
                        @endphp
                        
                        <div class="display-4 mb-2">₹{{ number_format($appointment->final_amount, 2) }}</div>
                        <div class="mb-3">
                            <span class="badge badge-{{ $statusColors[$appointment->payment_status] ?? 'secondary' }} p-2" style="font-size: 1rem;">
                                <i class="fas fa-{{ $statusIcon[$appointment->payment_status] ?? 'circle' }}"></i>
                                {{ ucfirst($appointment->payment_status) }}
                            </span>
                        </div>
                        
                        @php
                            $totalPaid = $appointment->payments->sum('amount');
                            $remainingAmount = $appointment->final_amount - $totalPaid;
                            $paidPercentage = $appointment->final_amount > 0 ? ($totalPaid / $appointment->final_amount) * 100 : 0;
                        @endphp
                        
                        @if($appointment->final_amount > 0)
                            <div class="progress mb-3" style="height: 20px;">
                                <div class="progress-bar bg-{{ $totalPaid >= $appointment->final_amount ? 'success' : 'info' }}" 
                                     role="progressbar" 
                                     style="width: {{ $paidPercentage }}%;" 
                                     aria-valuenow="{{ $paidPercentage }}" 
                                     aria-valuemin="0" 
                                     aria-valuemax="100">
                                    ₹{{ number_format($totalPaid, 0) }} paid
                                </div>
                            </div>
                            
                            <div class="row text-center">
                                <div class="col-6">
                                    <small class="text-muted d-block">Total Paid</small>
                                    <strong>₹{{ number_format($totalPaid, 2) }}</strong>
                                </div>
                                <div class="col-6">
                                    <small class="text-muted d-block">Remaining</small>
                                    <strong class="text-{{ $remainingAmount > 0 ? 'danger' : 'success' }}">
                                        ₹{{ number_format($remainingAmount, 2) }}
                                    </strong>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Quick Payment Status Update -->
                    <form action="{{ route('admin.appointments.update-payment-status', $appointment) }}" 
                          method="POST" id="paymentStatusForm">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-group">
                            <label>Change Payment Status</label>
                            <select class="form-control" name="payment_status" id="payment_status">
                                <option value="pending" {{ $appointment->payment_status == 'pending' ? 'selected' : '' }}>
                                    ⏳ Pending
                                </option>
                                <option value="partial" {{ $appointment->payment_status == 'partial' ? 'selected' : '' }}>
                                    🔶 Partial
                                </option>
                                <option value="paid" {{ $appointment->payment_status == 'paid' ? 'selected' : '' }}>
                                    ✅ Paid
                                </option>
                                <option value="refunded" {{ $appointment->payment_status == 'refunded' ? 'selected' : '' }}>
                                    ↩️ Refunded
                                </option>
                            </select>
                        </div>
                        
                        <div class="form-group" id="payment_amount_group" style="{{ $appointment->payment_status == 'partial' ? '' : 'display: none;' }}">
                            <label>Payment Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                <input type="number" step="0.01" class="form-control" 
                                       name="payment_amount" id="payment_amount" 
                                       value="{{ $remainingAmount > 0 ? min($remainingAmount, $appointment->final_amount) : $appointment->final_amount }}"
                                       max="{{ $appointment->final_amount }}" min="0.01">
                            </div>
                            <small class="text-muted">Max: ${{ number_format($appointment->final_amount, 2) }}</small>
                        </div>
                        
                        <div class="form-group" id="payment_method_group" style="{{ $appointment->payment_status == 'partial' ? '' : 'display: none;' }}">
                            <label>Payment Method</label>
                            <select class="form-control" name="payment_method" id="payment_method">
                                <option value="cash">💵 Cash</option>
                                <option value="card">💳 Card</option>
                                <option value="upi">📱 UPI</option>
                                <option value="other">🔄 Other</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-{{ $remainingAmount > 0 ? 'warning' : 'success' }} btn-block">
                            <i class="fas fa-{{ $remainingAmount > 0 ? 'dollar-sign' : 'check-circle' }}"></i>
                            {{ $remainingAmount > 0 ? 'Record Payment' : 'Update Status Only' }}
                        </button>
                    </form>
                    
                    @if($remainingAmount > 0 && $appointment->payment_status != 'paid')
                        <button type="button" class="btn btn-success btn-block mt-2" data-toggle="modal" data-target="#fullPaymentModal">
                            <i class="fas fa-check-double"></i> Mark as Fully Paid
                        </button>
                    @endif
                </div>
            </div>
            
            <!-- Payment History Card -->
            @if($appointment->payments->count() > 0)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payment History</h6>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @foreach($appointment->payments as $payment)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted d-block">{{ $payment->payment_date->format('M d, Y h:i A') }}</small>
                                    <strong>${{ number_format($payment->amount, 2) }}</strong>
                                    <span class="badge badge-info">{{ ucfirst($payment->payment_method) }}</span>
                                </div>
                                @if($payment->notes)
                                    <i class="fas fa-info-circle text-muted" data-toggle="tooltip" title="{{ $payment->notes }}"></i>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Full Payment Modal -->
<div class="modal fade" id="fullPaymentModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Mark as Fully Paid</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.appointments.full-payment', $appointment) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <p>Record full payment for this appointment?</p>
                    
                    @php
                        $totalPaid = $appointment->payments->sum('amount');
                        $remainingAmount = $appointment->final_amount - $totalPaid;
                    @endphp
                    
                    <div class="alert alert-info">
                        <div class="row">
                            <div class="col-6">Total Amount:</div>
                            <div class="col-6 text-right">${{ number_format($appointment->final_amount, 2) }}</div>
                            
                            <div class="col-6">Already Paid:</div>
                            <div class="col-6 text-right">${{ number_format($totalPaid, 2) }}</div>
                            
                            <div class="col-6 font-weight-bold">To be paid now:</div>
                            <div class="col-6 text-right font-weight-bold">${{ number_format($remainingAmount, 2) }}</div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select class="form-control" name="payment_method" required>
                            <option value="cash">💵 Cash</option>
                            <option value="card">💳 Card</option>
                            <option value="upi">📱 UPI</option>
                            <option value="other">🔄 Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Notes (Optional)</label>
                        <textarea class="form-control" name="notes" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Confirm Full Payment (${{ number_format($remainingAmount, 2) }})
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .service-card {
        cursor: pointer;
        transition: all 0.2s;
        border: 2px solid transparent;
    }
    .service-card:hover {
        border-color: #4e73df;
        background-color: #f8f9fc;
    }
    .service-card.selected {
        border-color: #4e73df;
        background-color: #e6f0ff;
    }
    .service-card .form-check {
        padding-left: 1.5rem;
    }
    .progress {
        border-radius: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Service card click handler
        $('.service-card').click(function(e) {
            if (!$(e.target).is('input[type="checkbox"]')) {
                const checkbox = $(this).find('.service-checkbox');
                checkbox.prop('checked', !checkbox.prop('checked'));
                $(this).toggleClass('selected', checkbox.prop('checked'));
                calculateTotals();
            }
        });
        
        // Service checkbox change handler
        $('.service-checkbox').change(function() {
            $(this).closest('.service-card').toggleClass('selected', $(this).is(':checked'));
            calculateTotals();
        });
        
        // Payment status change handler
        $('#payment_status').change(function() {
            if ($(this).val() === 'partial') {
                $('#payment_amount_group, #payment_method_group').slideDown();
            } else {
                $('#payment_amount_group, #payment_method_group').slideUp();
            }
        });
        
        // Calculate totals function
        function calculateTotals() {
            let total = 0;
            let totalDuration = 0;
            
            $('.service-checkbox:checked').each(function() {
                total += parseFloat($(this).data('price'));
                totalDuration += parseInt($(this).data('duration'));
            });
            
            $('#total_amount').val(total.toFixed(2));
            $('#total_duration').val(totalDuration);
            
            let discount = parseFloat($('#discount').val()) || 0;
            if (discount > total) {
                discount = total;
                $('#discount').val(total.toFixed(2));
            }
            
            let finalAmount = total - discount;
            $('#final_amount').val(finalAmount.toFixed(2));
            
            // Update end time
            let startTime = $('#start_time').val();
            if (startTime && totalDuration > 0) {
                let [hours, minutes] = startTime.split(':');
                let startDateTime = new Date();
                startDateTime.setHours(parseInt(hours), parseInt(minutes), 0);
                
                let endDateTime = new Date(startDateTime.getTime() + totalDuration * 60000);
                let endHours = endDateTime.getHours().toString().padStart(2, '0');
                let endMinutes = endDateTime.getMinutes().toString().padStart(2, '0');
                
                $('#end_time_display').val(endHours + ':' + endMinutes);
            }
        }
        
        // Event listeners
        $('.service-checkbox').change(calculateTotals);
        $('#discount').on('input', calculateTotals);
        $('#start_time').change(calculateTotals);   
        
        // Form validation
        $('#appointmentForm').submit(function(e) {
            if ($('.service-checkbox:checked').length === 0) {
                e.preventDefault();
                toastr.error('Please select at least one service');
                return false;
            }
        });
        
        // Payment status form validation
        $('#paymentStatusForm').submit(function(e) {
            const paymentStatus = $('#payment_status').val();
            const paymentAmount = $('#payment_amount').val();
            
            if (paymentStatus === 'partial' && (!paymentAmount || paymentAmount <= 0)) {
                e.preventDefault();
                toastr.error('Please enter a valid payment amount for partial payment');
                return false;
            }
        });
        
        // Initial calculation
        calculateTotals();
    });
    
    function quickComplete() {
        $('#appointment_status').val('completed');
        $('#appointmentForm').submit();
    }
</script>
@endpush
@endsection