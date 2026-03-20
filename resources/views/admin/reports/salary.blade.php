{{-- resources/views/admin/reports/salary.blade.php --}}
@extends('layouts.admin')

@section('title', 'Salary Report')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Salary Report</h1>
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
            <form method="GET" action="{{ route('admin.reports.salary') }}" class="row g-3">
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

    <!-- Summary -->
    <div class="row mb-4">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Salary Processed</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($totalSalary, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Salary to Process</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($pendingSalaries) }} Employees</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Processed Salaries -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Processed Salaries - {{ date('F', mktime(0, 0, 0, $month, 1)) }} {{ $year }}</h6>
        </div>
        <div class="card-body">
            @if($salaries->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Basic Salary</th>
                                <th>Commission Earned</th>
                                <th>Total Salary</th>
                                <th>Payment Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($salaries as $salary)
                            <tr>
                                <td>{{ $salary->employee->user->name }}</td>
                                <td>₹{{ number_format($salary->basic_salary, 2) }}</td>
                                <td>₹{{ number_format($salary->commission_earned, 2) }}</td>
                                <td>₹{{ number_format($salary->total_salary, 2) }}</td>
                                <td>{{ $salary->payment_date ? $salary->payment_date->format('d M Y') : 'N/A' }}</td>
                                <td>
                                    <span class="badge bg-success">Paid</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center text-muted my-3">No salaries processed for this month yet.</p>
            @endif
        </div>
    </div>

    <!-- Pending Salaries -->
    @if(count($pendingSalaries) > 0)
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-warning">Pending Salaries</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Basic Salary</th>
                            <th>Commission Earned</th>
                            <th>Total Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingSalaries as $pending)
                        <tr>
                            <td>{{ $pending['employee']->user->name }}</td>
                            <td>₹{{ number_format($pending['basic_salary'], 2) }}</td>
                            <td>₹{{ number_format($pending['commission'], 2) }}</td>
                            <td>₹{{ number_format($pending['total'], 2) }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-success" 
                                        onclick="processSalary({{ $pending['employee']->id }}, {{ $pending['basic_salary'] }}, {{ $pending['commission'] }}, {{ $pending['total'] }})">
                                    <i class="fas fa-check"></i> Process Salary
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Process Salary Modal -->
<div class="modal fade" id="processSalaryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.reports.process-salary') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Process Salary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="employee_id" id="modal_employee_id">
                    <input type="hidden" name="month" value="{{ $month }}">
                    <input type="hidden" name="year" value="{{ $year }}">
                    <input type="hidden" name="basic_salary" id="modal_basic_salary">
                    <input type="hidden" name="commission_earned" id="modal_commission">
                    <input type="hidden" name="total_salary" id="modal_total">
                    
                    <p>Are you sure you want to process salary for this employee?</p>
                    <p><strong>Total Amount: $<span id="modal_total_display"></span></strong></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Confirm Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function processSalary(employeeId, basicSalary, commission, total) {
        document.getElementById('modal_employee_id').value = employeeId;
        document.getElementById('modal_basic_salary').value = basicSalary;
        document.getElementById('modal_commission').value = commission;
        document.getElementById('modal_total').value = total;
        document.getElementById('modal_total_display').innerText = total.toFixed(2);
        
        new bootstrap.Modal(document.getElementById('processSalaryModal')).show();
    }
</script>
@endpush
@endsection