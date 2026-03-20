{{-- resources/views/admin/employees/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Employees')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Employees</h1>
        <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add New Employee
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Employee ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Employment Type</th>
                            <th>Salary/Commission</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->employee_id }}</td>
                            <td>{{ $employee->user->name }}</td>
                            <td>{{ $employee->user->email }}</td>
                            <td>{{ $employee->user->phone }}</td>
                            <td>{{ ucfirst($employee->employment_type) }}</td>
                            <td>
                                @if($employee->employment_type == 'salary' || $employee->employment_type == 'both')
                                    Salary: ₹{{ number_format($employee->salary_amount, 2) }}<br>
                                @endif
                                @if($employee->employment_type == 'commission' || $employee->employment_type == 'both')
                                    Commission: {{ $employee->commission_percentage }}%
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $employee->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($employee->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>
@endsection