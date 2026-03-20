@extends('layouts.admin')

@section('title', 'Employee Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employee Details: {{ $employee->user->name }}</h1>
        <div>
            <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Employee
            </a>
            <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">
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

    <!-- Employee Overview Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Employee ID</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $employee->employee_id }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-id-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Employment Type</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($employee->employment_type == 'salary')
                                    💰 Salary Based
                                @elseif($employee->employment_type == 'commission')
                                    📊 Commission Based
                                @else
                                    ⚖️ Salary + Commission
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Status</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($employee->status == 'active')
                                    <span class="badge badge-success p-2">✅ Active</span>
                                @elseif($employee->status == 'inactive')
                                    <span class="badge badge-secondary p-2">⭕ Inactive</span>
                                @elseif($employee->status == 'on_leave')
                                    <span class="badge badge-warning p-2">🏖️ On Leave</span>
                                @else
                                    <span class="badge badge-danger p-2">❌ Terminated</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Experience</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $employee->experience_years ?? 0 }} Years</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Main Details Column -->
        <div class="col-lg-8">
            <!-- Personal Information Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                    <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            @if($employee->profile_photo)
                                <img src="{{ Storage::url($employee->profile_photo) }}" 
                                     alt="{{ $employee->user->name }}" 
                                     class="img-fluid rounded-circle" style="max-width: 120px;">
                            @else
                                <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                                     style="width: 120px; height: 120px; font-size: 3rem;">
                                    {{ strtoupper(substr($employee->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 35%">Full Name</th>
                                    <td>{{ $employee->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email Address</th>
                                    <td>{{ $employee->user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $employee->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Specialization</th>
                                    <td>{{ $employee->specialization ?? 'Not specified' }}</td>
                                </tr>
                                <tr>
                                    <th>Qualification</th>
                                    <td>{{ $employee->qualification ?? 'Not specified' }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $employee->address ?? 'Not provided' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Compensation Details Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Compensation Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 50%">Employment Type</th>
                                    <td>
                                        @if($employee->employment_type == 'salary')
                                            <span class="badge badge-info">Salary Based</span>
                                        @elseif($employee->employment_type == 'commission')
                                            <span class="badge badge-warning">Commission Based</span>
                                        @else
                                            <span class="badge badge-success">Salary + Commission</span>
                                        @endif
                                    </td>
                                </tr>
                                @if(in_array($employee->employment_type, ['salary', 'both']))
                                <tr>
                                    <th>Monthly Salary</th>
                                    <td><strong>₹{{ number_format($employee->salary_amount, 2) }}</strong></td>
                                </tr>
                                @endif
                                @if(in_array($employee->employment_type, ['commission', 'both']))
                                <tr>
                                    <th>Commission Percentage</th>
                                    <td><strong>{{ $employee->commission_percentage }}%</strong></td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Payment Frequency</th>
                                    <td>{{ ucfirst($employee->payment_frequency ?? 'monthly') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 50%">Joining Date</th>
                                    <td>{{ $employee->joining_date->format('d M, Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Total Working Days</th>
                                    <td>{{ $employee->attendances_count ?? 0 }} days</td>
                                </tr>
                                <tr>
                                    <th>This Month Commission</th>
                                    <td><strong class="text-success">₹{{ number_format($employee->commissions()->whereMonth('commission_date', now()->month)->sum('commission_amount'), 2) }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Total Commission Earned</th>
                                    <td><strong class="text-primary">₹{{ number_format($employee->commissions()->sum('commission_amount'), 2) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Services Offered</h6>
                </div>
                <div class="card-body">
                    @if($employee->services->count() > 0)
                        <div class="row">
                            @foreach($employee->services as $service)
                            <div class="col-md-4 mb-2">
                                <div class="card bg-light">
                                    <div class="card-body py-2">
                                        <strong>{{ $service->name }}</strong>
                                        <small class="d-block text-muted">₹{{ $service->price }} | {{ $service->duration }} mins</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No services assigned to this employee.</p>
                    @endif
                </div>
            </div>

            <!-- Emergency Contact Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Emergency Contact</h6>
                </div>
                <div class="card-body">
                    @if($employee->emergency_contact_name || $employee->emergency_contact_phone)
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 35%">Contact Name</th>
                                <td>{{ $employee->emergency_contact_name }}</td>
                            </tr>
                            <tr>
                                <th>Contact Phone</th>
                                <td>{{ $employee->emergency_contact_phone }}</td>
                            </tr>
                        </table>
                    @else
                        <p class="text-muted mb-0">No emergency contact provided.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Working Hours Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Working Schedule</h6>
                </div>
                <div class="card-body">
                    @php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        $workingHours = $employee->working_hours ?? [];
                    @endphp
                    
                    <table class="table table-sm">
                        @foreach($days as $day)
                        <tr>
                            <td><strong>{{ $day }}</strong></td>
                            <td>
                                @if(isset($workingHours[strtolower($day)]))
                                    {{ $workingHours[strtolower($day)]['start'] ?? '09:00' }} - 
                                    {{ $workingHours[strtolower($day)]['end'] ?? '18:00' }}
                                @else
                                    <span class="text-muted">09:00 - 18:00</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <!-- Recent Appointments Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Appointments</h6>
                </div>
                <div class="card-body p-0">
                    @php
                        $recentAppointments = $employee->appointments()
                            ->with('client')
                            ->latest()
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @if($recentAppointments->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentAppointments as $appointment)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $appointment->client->name }}</strong>
                                        <small class="d-block text-muted">
                                            {{ $appointment->appointment_date->format('d M, Y') }} at {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}
                                        </small>
                                    </div>
                                    <span class="badge badge-{{ $appointment->payment_status == 'paid' ? 'success' : 'warning' }}">
                                        ₹{{ number_format($appointment->final_amount, 0) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted p-3 mb-0">No appointments yet.</p>
                    @endif
                </div>
            </div>

            <!-- Attendance Summary Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Attendance Summary (This Month)</h6>
                </div>
                <div class="card-body">
                    @php
                        $currentMonth = now()->month;
                        $currentYear = now()->year;
                        $daysInMonth = now()->daysInMonth;
                        
                        // You can replace this with actual attendance count when you have the model
                        $presentDays = 0; // Placeholder
                        $absentDays = 0; // Placeholder
                        $leaves = 0; // Placeholder
                    @endphp
                    
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="h5 mb-0 font-weight-bold text-success">{{ $presentDays }}</div>
                            <div class="small text-gray-600">Present</div>
                        </div>
                        <div class="col-4">
                            <div class="h5 mb-0 font-weight-bold text-danger">{{ $absentDays }}</div>
                            <div class="small text-gray-600">Absent</div>
                        </div>
                        <div class="col-4">
                            <div class="h5 mb-0 font-weight-bold text-warning">{{ $leaves }}</div>
                            <div class="small text-gray-600">Leaves</div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <div class="progress" style="height: 20px;">
                            @php
                                $presentPercentage = $daysInMonth > 0 ? ($presentDays / $daysInMonth) * 100 : 0;
                            @endphp
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: {{ $presentPercentage }}%" 
                                 aria-valuenow="{{ $presentPercentage }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ round($presentPercentage) }}%
                            </div>
                        </div>
                    </div>
                    
                    <small class="text-muted d-block mt-2">
                        * Attendance module can be added separately
                    </small>
                </div>
            </div>

            <!-- Documents Card -->
            @if($employee->id_proof)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Documents</h6>
                </div>
                <div class="card-body">
                    <a href="{{ Storage::url($employee->id_proof) }}" target="_blank" class="btn btn-info btn-block">
                        <i class="fas fa-file-pdf"></i> View ID Proof
                    </a>
                </div>
            </div>
            @endif

            <!-- Notes Card -->
            @if($employee->notes)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Additional Notes</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $employee->notes }}</p>
                </div>
            </div>
            @endif

            <!-- Quick Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-primary btn-block mb-2">
                        <i class="fas fa-edit"></i> Edit Employee
                    </a>
                    
                    @if($employee->status == 'active')
                    <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#deactivateModal">
                        <i class="fas fa-pause-circle"></i> Deactivate Employee
                    </button>
                    @elseif($employee->status == 'inactive')
                    <form action="{{ route('admin.employees.activate', $employee) }}" method="POST" class="d-inline-block w-100 mb-2">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-play-circle"></i> Activate Employee
                        </button>
                    </form>
                    @endif
                    
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash"></i> Delete Employee
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Deactivate Modal -->
<div class="modal fade" id="deactivateModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deactivate Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.employees.deactivate', $employee) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <p>Are you sure you want to deactivate <strong>{{ $employee->user->name }}</strong>?</p>
                    <p class="text-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        This will prevent them from logging in and accepting new appointments.
                    </p>
                    
                    <div class="form-group">
                        <label for="deactivation_reason">Reason for Deactivation</label>
                        <textarea class="form-control" name="deactivation_reason" rows="2" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Deactivate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Warning:</strong> This action is permanent and cannot be undone!
                    </div>
                    
                    <p>Are you absolutely sure you want to delete <strong>{{ $employee->user->name }}</strong>?</p>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="confirm_delete" required>
                        <label class="form-check-label" for="confirm_delete">
                            I understand that all employee data, including attendance and commission history, will be permanently deleted.
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label for="delete_password">Enter your password to confirm</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="confirmDeleteBtn" disabled>Permanently Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Enable delete button only when checkbox is checked
        $('#confirm_delete').change(function() {
            $('#confirmDeleteBtn').prop('disabled', !$(this).is(':checked'));
        });
    });
</script>
@endpush
@endsection