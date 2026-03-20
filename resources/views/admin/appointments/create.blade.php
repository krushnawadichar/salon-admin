@extends('layouts.admin')

@section('title', 'New Appointment')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">New Appointment</h1>
        <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.appointments.store') }}" method="POST" id="appointmentForm">
                @csrf
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="client_id" class="form-label">Client <span class="text-danger">*</span></label>
                        <select class="form-control @error('client_id') is-invalid @enderror" 
                                id="client_id" name="client_id" required>
                            <option value="">Select Client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }} ({{ $client->phone }})
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
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->user->name }}
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
                               value="{{ old('appointment_date', now()->format('Y-m-d')) }}" required>
                        @error('appointment_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="start_time" class="form-label">Start Time <span class="text-danger">*</span></label>
                        <input type="time" class="form-control @error('start_time') is-invalid @enderror" 
                               id="start_time" name="start_time" value="{{ old('start_time', '09:00') }}" required>
                        @error('start_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <h5 class="border-bottom pb-2 mb-3">Select Services</h5>
                <div class="row mb-3">
                    @foreach($services as $service)
                    <div class="col-md-3 mb-2">
                        <div class="form-check">
                            <input class="form-check-input service-checkbox" type="checkbox" 
                                   name="services[]" value="{{ $service->id }}" 
                                   id="service{{ $service->id }}"
                                   data-price="{{ $service->price }}"
                                   data-duration="{{ $service->duration }}"
                                   {{ is_array(old('services')) && in_array($service->id, old('services')) ? 'checked' : '' }}>
                            <label class="form-check-label" for="service{{ $service->id }}">
                                {{ $service->name }} - ₹{{ $service->price }} ({{ $service->duration }} mins)
                            </label>
                        </div>
                    </div>
                    @endforeach
                    @error('services')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Total Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="text" class="form-control" id="total_amount" readonly value="0.00">
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="discount" class="form-label">Discount (₹)</label>
                        <input type="number" step="0.01" min="0" class="form-control @error('discount') is-invalid @enderror" 
                               id="discount" name="discount" value="{{ old('discount', 0) }}">
                        @error('discount')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Final Amount</label>
                        <div class="input-group">
                            <span class="input-group-text">₹</span>
                            <input type="text" class="form-control" id="final_amount" readonly value="0.00">
                        </div>
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" 
                                  id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Create Appointment
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        function calculateTotals() {
            let total = 0;
            let totalDuration = 0;
            
            $('.service-checkbox:checked').each(function() {
                total += parseFloat($(this).data('price'));
                totalDuration += parseInt($(this).data('duration'));
            });
            
            $('#total_amount').val(total.toFixed(2));
            
            let discount = parseFloat($('#discount').val()) || 0;
            let finalAmount = total - discount;
            $('#final_amount').val(finalAmount.toFixed(2));
            
            // Update end time based on total duration
            let startTime = $('#start_time').val();
            if (startTime && totalDuration > 0) {
                let [hours, minutes] = startTime.split(':');
                let startDateTime = new Date();
                startDateTime.setHours(parseInt(hours), parseInt(minutes), 0);
                
                let endDateTime = new Date(startDateTime.getTime() + totalDuration * 60000);
                let endHours = endDateTime.getHours().toString().padStart(2, '0');
                let endMinutes = endDateTime.getMinutes().toString().padStart(2, '0');
                
                // You can display end time or store it in a hidden field
                console.log('End Time:', endHours + ':' + endMinutes);
            }
        }
        
        $('.service-checkbox').change(calculateTotals);
        $('#discount').keyup(calculateTotals);
        $('#start_time').change(calculateTotals);
        
        // Initial calculation
        calculateTotals();
    });
</script>
@endpush
@endsection