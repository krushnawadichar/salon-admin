{{-- resources/views/admin/reports/commission.blade.php --}}
@extends('layouts.admin')

@section('title', 'Commission Report')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Commission Report</h1>
        <div>
            <button onclick="window.print()" class="btn btn-success me-2">
                <i class="fas fa-print"></i> Print Report
            </button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </div>

    <!-- Filter -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reports.commission') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Month</label>
                    <select name="month" class="form-control">
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ $month == $m ? 'selected' : '' }}>
                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Year</label>
                    <select name="year" class="form-control">
                        @foreach(range(now()->year - 2, now()->year) as $y)
                            <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Generate
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
                                Total Commission</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($totalCommission, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Commission</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($pendingCommission, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
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
                                Paid Commission</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($paidCommission, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Commission Summary -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Employee Commission Summary</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Total Commission</th>
                            <th>Pending</th>
                            <th>Paid</th>
                            <th>Number of Transactions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employeeCommissions as $empComm)
                        <tr>
                            <td>{{ $empComm['employee']->user->name }}</td>
                            <td>₹{{ number_format($empComm['total'], 2) }}</td>
                            <td class="text-warning">₹{{ number_format($empComm['pending'], 2) }}</td>
                            <td class="text-success">₹{{ number_format($empComm['paid'], 2) }}</td>
                            <td>{{ $empComm['count'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Detailed Commission List -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detailed Commission Transactions</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Appointment #</th>
                            <th>Client</th>
                            <th>Service Amount</th>
                            <th>Commission %</th>
                            <th>Commission Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($commissions as $commission)
                        <tr>
                            <td>{{ $commission->commission_date->format('d M Y') }}</td>
                            <td>{{ $commission->employee->user->name }}</td>
                            <td>{{ $commission->appointment->appointment_number }}</td>
                            <td>{{ $commission->appointment->client->name }}</td>
                            <td>₹{{ number_format($commission->service_amount, 2) }}</td>
                            <td>{{ $commission->commission_percentage }}%</td>
                            <td>₹{{ number_format($commission->commission_amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $commission->status == 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($commission->status) }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection