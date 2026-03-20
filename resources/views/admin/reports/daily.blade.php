{{-- resources/views/admin/reports/daily.blade.php --}}
@extends('layouts.admin')

@section('title', 'Daily Report')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daily Report</h1>
        <div>
            <button onclick="window.print()" class="btn btn-success me-2">
                <i class="fas fa-print"></i> Print Report
            </button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Date Filter -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reports.daily') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Select Date</label>
                    <input type="date" name="date" class="form-control" value="{{ $date->format('Y-m-d') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Generate Report
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Appointments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAppointments }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed Appointments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedAppointments }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($totalRevenue, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Performance -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employee Performance - {{ $date->format('d M Y') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Appointments</th>
                            <th>Services Done</th>
                            <th>Revenue Generated</th>
                            <th>Commission Earned</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employeeStats as $stat)
                        <tr>
                            <td>{{ $stat->user->name }}</td>
                            <td>{{ $stat->total_appointments }}</td>
                            <td>{{ $stat->appointments->sum(function($apt) { return $apt->services->count(); }) }}</td>
                            <td>₹{{ number_format($stat->total_revenue, 2) }}</td>
                            <td>₹{{ number_format($stat->total_revenue * ($stat->commission_percentage ?? 0) / 100, 2) }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No data available for this date</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Appointments List -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Appointments on {{ $date->format('d M Y') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Appointment #</th>
                            <th>Client</th>
                            <th>Employee</th>
                            <th>Services</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->start_time->format('H:i') }}</td>
                            <td>{{ $appointment->appointment_number }}</td>
                            <td>{{ $appointment->client->name }}</td>
                            <td>{{ $appointment->employee->user->name }}</td>
                            <td>
                                @foreach($appointment->services as $service)
                                    <span class="badge bg-info">{{ $service->name }}</span>
                                @endforeach
                            </td>
                            <td>₹{{ number_format($appointment->final_amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->appointment_status == 'completed' ? 'success' : ($appointment->appointment_status == 'scheduled' ? 'primary' : 'danger') }}">
                                    {{ ucfirst($appointment->appointment_status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No appointments on this date</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    @media print {
        .navbar, .sidebar, .btn, form, .footer {
            display: none !important;
        }
        .card {
            border: 1px solid #000 !important;
        }
    }
</style>
@endpush
@endsection