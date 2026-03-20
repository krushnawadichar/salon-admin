@extends('layouts.admin')

@section('title', 'Client Details')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Client Details: {{ $client->name }}</h1>
        <div>
            <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Client
            </a>
            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">
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

    <!-- Client Overview Cards -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Client ID</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">#{{ $client->id }}</div>
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
                                Total Visits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $client->total_visits }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
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
                                Total Spent</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($client->total_spent, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-rupee-sign fa-2x text-gray-300"></i>
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
                                Status</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @if($client->status == 'active')
                                    <span class="badge badge-success p-2">✅ Active</span>
                                @else
                                    <span class="badge badge-danger p-2">⭕ Inactive</span>
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
    </div>

    <div class="row">
        <!-- Main Details Column -->
        <div class="col-lg-8">
            <!-- Personal Information Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Personal Information</h6>
                    <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                                 style="width: 120px; height: 120px; font-size: 3rem;">
                                {{ strtoupper(substr($client->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="col-md-9">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 35%">Full Name</th>
                                    <td>{{ $client->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email Address</th>
                                    <td>
                                        @if($client->email)
                                            <a href="mailto:{{ $client->email }}">{{ $client->email }}</a>
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>
                                        <a href="tel:{{ $client->phone }}">{{ $client->phone }}</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>
                                        @if($client->date_of_birth)
                                            {{ $client->date_of_birth->format('d M, Y') }}
                                            ({{ $client->date_of_birth->age }} years)
                                        @else
                                            <span class="text-muted">Not provided</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>
                                        @if($client->gender)
                                            {{ ucfirst($client->gender) }}
                                        @else
                                            <span class="text-muted">Not specified</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $client->address ?? 'Not provided' }}</td>
                                </tr>
                                <tr>
                                    <th>Member Since</th>
                                    <td>{{ $client->created_at->format('d M, Y') }} ({{ $client->created_at->diffForHumans() }})</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Appointment History Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Appointment History</h6>
                    <a href="{{ route('admin.appointments.create', ['client_id' => $client->id]) }}" class="btn btn-sm btn-success">
                        <i class="fas fa-plus"></i> New Appointment
                    </a>
                </div>
                <div class="card-body">
                    @if(isset($appointments) && $appointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Employee</th>
                                        <th>Services</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->appointment_date->format('d M Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }}</td>
                                        <td>{{ $appointment->employee->user->name ?? 'N/A' }}</td>
                                        <td>
                                            @if($appointment->services && $appointment->services->count() > 0)
                                                @foreach($appointment->services as $service)
                                                    <span class="badge badge-info">{{ $service->name }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No services</span>
                                            @endif
                                        </td>
                                        <td>₹{{ number_format($appointment->final_amount, 2) }}</td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'scheduled' => 'primary',
                                                    'confirmed' => 'info',
                                                    'in_progress' => 'warning',
                                                    'completed' => 'success',
                                                    'cancelled' => 'danger',
                                                    'no_show' => 'secondary'
                                                ];
                                            @endphp
                                            <span class="badge badge-{{ $statusColors[$appointment->appointment_status] ?? 'secondary' }}">
                                                {{ ucfirst(str_replace('_', ' ', $appointment->appointment_status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $paymentColors = [
                                                    'paid' => 'success',
                                                    'partial' => 'warning',
                                                    'pending' => 'secondary',
                                                    'refunded' => 'danger'
                                                ];
                                            @endphp
                                            <span class="badge badge-{{ $paymentColors[$appointment->payment_status] ?? 'secondary' }}">
                                                {{ ucfirst($appointment->payment_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-3">
                            {{ $appointments->links() }}
                        </div>
                    @else
                        <div class="text-center py-4">
                            <img src="{{ asset('img/no-appointments.svg') }}" alt="No appointments" style="max-width: 200px; opacity: 0.5;">
                            <h5 class="mt-3">No Appointments Yet</h5>
                            <p class="text-muted">This client hasn't booked any appointments.</p>
                            <a href="{{ route('admin.appointments.create', ['client_id' => $client->id]) }}" class="btn btn-primary">
                                <i class="fas fa-calendar-plus"></i> Create First Appointment
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Notes Card -->
            @if($client->notes)
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Additional Notes</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $client->notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Loyalty Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Loyalty Status</h6>
                </div>
                <div class="card-body">
                    @php
                        $totalVisits = $client->total_visits ?? 0;
                        $loyaltyLevel = 'Bronze';
                        $loyaltyColor = 'bronze';
                        $nextLevel = 'Silver';
                        $visitsNeeded = 10 - ($totalVisits % 10);
                        $progress = ($totalVisits % 10) * 10;
                        
                        if ($totalVisits >= 50) {
                            $loyaltyLevel = 'Platinum';
                            $loyaltyColor = 'dark';
                            $nextLevel = null;
                            $progress = 100;
                        } elseif ($totalVisits >= 30) {
                            $loyaltyLevel = 'Gold';
                            $loyaltyColor = 'warning';
                            $nextLevel = 'Platinum';
                            $visitsNeeded = 50 - $totalVisits;
                            $progress = (($totalVisits - 30) / 20) * 100;
                        } elseif ($totalVisits >= 10) {
                            $loyaltyLevel = 'Silver';
                            $loyaltyColor = 'secondary';
                            $nextLevel = 'Gold';
                            $visitsNeeded = 30 - $totalVisits;
                            $progress = (($totalVisits - 10) / 20) * 100;
                        } else {
                            $progress = ($totalVisits / 10) * 100;
                        }
                    @endphp
                    
                    <div class="text-center mb-4">
                        <div class="display-4 mb-2">
                            @if($loyaltyLevel == 'Bronze')
                                🥉
                            @elseif($loyaltyLevel == 'Silver')
                                🥈
                            @elseif($loyaltyLevel == 'Gold')
                                🥇
                            @elseif($loyaltyLevel == 'Platinum')
                                💎
                            @endif
                        </div>
                        <span class="badge badge-{{ $loyaltyColor }} p-2" style="font-size: 1.2rem;">
                            {{ $loyaltyLevel }} Member
                        </span>
                    </div>
                    
                    <div class="row text-center mb-3">
                        <div class="col-6">
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalVisits }}</div>
                            <div class="small text-gray-600">Total Visits</div>
                        </div>
                        <div class="col-6">
                            <div class="h3 mb-0 font-weight-bold text-gray-800">₹{{ number_format($client->total_spent, 0) }}</div>
                            <div class="small text-gray-600">Lifetime Spend</div>
                        </div>
                    </div>
                    
                    @if($nextLevel)
                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1">
                            <small class="text-muted">Progress to {{ $nextLevel }}</small>
                            <small class="text-muted">{{ $visitsNeeded }} more visits</small>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-{{ $loyaltyColor }}" role="progressbar" 
                                 style="width: {{ $progress }}%;" 
                                 aria-valuenow="{{ $progress }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Recent Activity Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body p-0">
                    @php
                        $recentActivities = $client->appointments()
                            ->with('employee.user')
                            ->latest()
                            ->limit(5)
                            ->get();
                    @endphp
                    
                    @if($recentActivities->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentActivities as $activity)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-calendar-check text-primary mr-2"></i>
                                        <strong>{{ $activity->appointment_date->format('d M') }}</strong>
                                        <small class="d-block text-muted">
                                            {{ \Carbon\Carbon::parse($activity->start_time)->format('h:i A') }} 
                                            with {{ $activity->employee->user->name ?? 'N/A' }}
                                        </small>
                                    </div>
                                    <span class="badge badge-{{ $activity->appointment_status == 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($activity->appointment_status) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted p-3 mb-0">No recent activity.</p>
                    @endif
                </div>
            </div>

            <!-- Preferences Card - Fixed with try-catch -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Preferences</h6>
                </div>
                <div class="card-body">
                    @php
                        $preferredEmployee = null;
                        $preferredService = null;
                        
                        try {
                            // Get preferred employee (most booked)
                            if (Schema::hasTable('appointments')) {
                                $preferredEmployeeData = DB::table('appointments')
                                    ->where('client_id', $client->id)
                                    ->where('appointment_status', 'completed')
                                    ->select('employee_id', DB::raw('count(*) as total'))
                                    ->groupBy('employee_id')
                                    ->orderBy('total', 'desc')
                                    ->first();
                                    
                                if ($preferredEmployeeData && $preferredEmployeeData->employee_id) {
                                    $preferredEmployee = App\Models\Employee::with('user')->find($preferredEmployeeData->employee_id);
                                }
                            }
                            
                            // Get preferred service (most booked) - with table check
                            if (Schema::hasTable('appointment_service') && Schema::hasTable('appointments')) {
                                $preferredServiceData = DB::table('appointment_service')
                                    ->join('appointments', 'appointments.id', '=', 'appointment_service.appointment_id')
                                    ->where('appointments.client_id', $client->id)
                                    ->select('appointment_service.service_id', DB::raw('count(*) as total'))
                                    ->groupBy('appointment_service.service_id')
                                    ->orderBy('total', 'desc')
                                    ->first();
                                    
                                if ($preferredServiceData && $preferredServiceData->service_id) {
                                    $preferredService = App\Models\Service::find($preferredServiceData->service_id);
                                }
                            }
                        } catch (\Exception $e) {
                            // Log error but don't show to user
                            \Log::error('Error fetching preferences: ' . $e->getMessage());
                        }
                    @endphp
                    
                    @if($preferredEmployee)
                        <div class="mb-3">
                            <small class="text-muted d-block">Preferred Staff</small>
                            <strong>
                                {{ $preferredEmployee->user->name ?? 'N/A' }}
                                <span class="badge badge-info">{{ $preferredEmployeeData->total ?? 0 }} visits</span>
                            </strong>
                        </div>
                    @endif
                    
                    @if($preferredService)
                        <div class="mb-3">
                            <small class="text-muted d-block">Preferred Service</small>
                            <strong>
                                {{ $preferredService->name ?? 'N/A' }}
                                <span class="badge badge-info">{{ $preferredServiceData->total ?? 0 }} times</span>
                            </strong>
                        </div>
                    @endif
                    
                    @if(!$preferredEmployee && !$preferredService)
                        <p class="text-muted mb-0">No preference data available.</p>
                    @endif
                </div>
            </div>

            <!-- Quick Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.appointments.create', ['client_id' => $client->id]) }}" class="btn btn-success btn-block mb-2">
                        <i class="fas fa-calendar-plus"></i> New Appointment
                    </a>
                    
                    <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-primary btn-block mb-2">
                        <i class="fas fa-edit"></i> Edit Details
                    </a>
                    
                    @if($client->email)
                    <a href="mailto:{{ $client->email }}" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-envelope"></i> Send Email
                    </a>
                    @endif
                    
                    <a href="tel:{{ $client->phone }}" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-phone"></i> Call Client
                    </a>
                    
                    @if($client->status == 'active')
                    <button type="button" class="btn btn-warning btn-block mb-2" data-toggle="modal" data-target="#deactivateModal">
                        <i class="fas fa-pause-circle"></i> Deactivate Client
                    </button>
                    @else
                    <form action="{{ route('admin.clients.activate', $client) }}" method="POST" class="d-inline-block w-100 mb-2">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-play-circle"></i> Activate Client
                        </button>
                    </form>
                    @endif
                    
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#deleteModal">
                        <i class="fas fa-trash"></i> Delete Client
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
                <h5 class="modal-title">Deactivate Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.clients.deactivate', $client) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <p>Are you sure you want to deactivate <strong>{{ $client->name }}</strong>?</p>
                    <p class="text-warning">
                        <i class="fas fa-exclamation-triangle"></i> 
                        This will prevent them from booking new appointments.
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
                <h5 class="modal-title text-danger">Delete Client</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.clients.destroy', $client) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Warning:</strong> This action is permanent and cannot be undone!
                    </div>
                    
                    <p>Are you absolutely sure you want to delete <strong>{{ $client->name }}</strong>?</p>
                    <p class="text-muted small">This will also delete all appointment history for this client.</p>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="confirm_delete" required>
                        <label class="form-check-label" for="confirm_delete">
                            I understand that all client data, including appointment history, will be permanently deleted.
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

@push('styles')
<style>
    .badge-bronze {
        background-color: #cd7f32;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        // Enable delete button only when checkbox is checked
        $('#confirm_delete').change(function() {
            $('#confirmDeleteBtn').prop('disabled', !$(this).is(':checked'));
        });
        
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush
@endsection