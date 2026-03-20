{{-- resources/views/employee/dashboard.blade.php --}}
@extends('layouts.employee')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome, {{ Auth::user()->name ?? 'Guest' }}!</h1>
        <div>
            <span class="badge bg-info p-2">
                <i class="fas fa-id-card me-1"></i> 
                Employee ID: {{ $employee->employee_id ?? 'NA' }}
            </span>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon bg-soft-primary me-3">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                    <div class="text-xs text-muted text-uppercase mb-1">Today's Appointments</div>
                    <div class="h5 mb-0 font-weight-bold">{{ $todayAppointments->count() ?? 0 }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon bg-soft-success me-3">
                    <i class="fa fa-inr"></i>
                </div>
                <div>
                    <div class="text-xs text-muted text-uppercase mb-1">Today's Commission</div>
                    <div class="h5 mb-0 font-weight-bold">
                        ₹{{ isset($todayCommissions) ? number_format($todayCommissions, 2) : '0.00' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon bg-soft-warning me-3">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div>
                    <div class="text-xs text-muted text-uppercase mb-1">Monthly Commission</div>
                    <div class="h5 mb-0 font-weight-bold">
                        ₹{{ isset($monthlyCommissions) ? number_format($monthlyCommissions, 2) : '0.00' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card d-flex align-items-center">
                <div class="stat-icon bg-soft-info me-3">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="text-xs text-muted text-uppercase mb-1">Total Clients Served</div>
                    <div class="h5 mb-0 font-weight-bold">{{ $totalAppointments ?? 0 }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Today's Appointments -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Today's Appointments</h6>
                    <a href="{{ route('employee.appointments') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @if(isset($todayAppointments) && $todayAppointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Client</th>
                                        <th>Services</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($todayAppointments as $appointment)
                                    <tr>
                                        <td>
                                            {{ isset($appointment->start_time) ? $appointment->start_time->format('H:i') : 'NA' }}
                                        </td>
                                        <td>
                                            {{ isset($appointment->client) && isset($appointment->client->name) ? $appointment->client->name : 'NA' }}
                                        </td>
                                        <td>
                                            @if(isset($appointment->services) && $appointment->services->count() > 0)
                                                @foreach($appointment->services as $service)
                                                    <span class="badge bg-info">{{ $service->name ?? 'NA' }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-secondary">No Services</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($appointment->appointment_status))
                                                <span class="badge bg-{{ $appointment->appointment_status == 'completed' ? 'success' : ($appointment->appointment_status == 'scheduled' ? 'primary' : 'danger') }}">
                                                    {{ ucfirst($appointment->appointment_status) }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">NA</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted my-3">No appointments scheduled for today.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upcoming Appointments -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upcoming Appointments</h6>
                </div>
                <div class="card-body">
                    @if(isset($upcomingAppointments) && $upcomingAppointments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Client</th>
                                        <th>Services</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcomingAppointments as $appointment)
                                    <tr>
                                        <td>
                                            {{ isset($appointment->appointment_date) ? $appointment->appointment_date->format('d M Y') : 'NA' }}
                                        </td>
                                        <td>
                                            {{ isset($appointment->start_time) ? $appointment->start_time->format('H:i') : 'NA' }}
                                        </td>
                                        <td>
                                            {{ isset($appointment->client) && isset($appointment->client->name) ? $appointment->client->name : 'NA' }}
                                        </td>
                                        <td>
                                            @if(isset($appointment->services) && $appointment->services->count() > 0)
                                                @foreach($appointment->services as $service)
                                                    <span class="badge bg-info">{{ $service->name ?? 'NA' }}</span>
                                                @endforeach
                                            @else
                                                <span class="badge bg-secondary">No Services</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted my-3">No upcoming appointments.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Commissions -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Commissions</h6>
                    <a href="{{ route('employee.commissions') }}" class="btn btn-sm btn-primary">View All</a>
                </div>
                <div class="card-body">
                    @if(isset($recentCommissions) && $recentCommissions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered datatable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Appointment #</th>
                                        <th>Client</th>
                                        <th>Service Amount</th>
                                        <th>Commission %</th>
                                        <th>Commission Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentCommissions as $commission)
                                    <tr>
                                        <td>
                                            {{ isset($commission->commission_date) ? $commission->commission_date->format('d M Y') : 'NA' }}
                                        </td>
                                        <td>
                                            {{ isset($commission->appointment) && isset($commission->appointment->appointment_number) ? $commission->appointment->appointment_number : 'NA' }}
                                        </td>
                                        <td>
                                            @php
                                                $clientName = 'NA';
                                                if(isset($commission->appointment) && isset($commission->appointment->client)) {
                                                    $clientName = $commission->appointment->client->name ?? 'NA';
                                                }
                                            @endphp
                                            {{ $clientName }}
                                        </td>
                                        <td>
                                            ₹{{ isset($commission->service_amount) ? number_format($commission->service_amount, 2) : '0.00' }}
                                        </td>
                                        <td>
                                            {{ isset($commission->commission_percentage) ? $commission->commission_percentage . '%' : 'NA' }}
                                        </td>
                                        <td>
                                            ₹{{ isset($commission->commission_amount) ? number_format($commission->commission_amount, 2) : '0.00' }}
                                        </td>
                                        <td>
                                            @if(isset($commission->status))
                                                <span class="badge bg-{{ $commission->status == 'paid' ? 'success' : 'warning' }}">
                                                    {{ ucfirst($commission->status) }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">NA</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center text-muted my-3">No commissions yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: transform 0.2s;
    }
    
    .stat-card:hover {
        transform: translateY(-2px);
    }
    
    .stat-icon {
        width: 3rem;
        height: 3rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    
    .bg-soft-primary {
        background-color: rgba(78, 115, 223, 0.1);
        color: #4e73df;
    }
    
    .bg-soft-success {
        background-color: rgba(28, 200, 138, 0.1);
        color: #1cc88a;
    }
    
    .bg-soft-warning {
        background-color: rgba(246, 194, 62, 0.1);
        color: #f6c23e;
    }
    
    .bg-soft-info {
        background-color: rgba(54, 185, 204, 0.1);
        color: #36b9cc;
    }
    
    .badge {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 0.35rem 0.65rem;
    }
    
    .table thead th {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05rem;
    }
    
    .table tbody td {
        font-size: 0.8rem;
        vertical-align: middle;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('.datatable').DataTable({
            pageLength: 10,
            order: [[0, 'desc']],
            language: {
                emptyTable: "No data available"
            }
        });
    });
</script>
@endpush
@endsection