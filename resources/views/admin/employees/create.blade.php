{{-- resources/views/admin/employees/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Add Employee')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add New Employee</h1>
        <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.employees.store') }}" method="POST">
                @csrf

                <h5 class="border-bottom pb-2 mb-3">Login Information</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror"
                            id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror"
                            id="address" name="address" rows="2">{{ old('address') }}</textarea>
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h5 class="border-bottom pb-2 mb-3">Employee Details</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="employee_id" class="form-label">Employee ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('employee_id') is-invalid @enderror"
                            id="employee_id" name="employee_id" value="{{ old('employee_id') }}" required>
                        @error('employee_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="employment_type" class="form-label">Employment Type <span class="text-danger">*</span></label>
                        <select class="form-control @error('employment_type') is-invalid @enderror"
                            id="employment_type" name="employment_type" required>
                            <option value="">Select Type</option>
                            <option value="salary" {{ old('employment_type') == 'salary' ? 'selected' : '' }}>Salary Based</option>
                            <option value="commission" {{ old('employment_type') == 'commission' ? 'selected' : '' }}>Commission Based</option>
                            <option value="both" {{ old('employment_type') == 'both' ? 'selected' : '' }}>Both (Salary + Commission)</option>
                        </select>
                        @error('employment_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="joining_date" class="form-label">Joining Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('joining_date') is-invalid @enderror"
                            id="joining_date" name="joining_date" value="{{ old('joining_date') }}" required>
                        @error('joining_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row" id="salaryFields" style="display: {{ in_array(old('employment_type'), ['salary', 'both']) ? 'block' : 'none' }};">
                    <div class="col-md-6 mb-3">
                        <label for="salary_amount" class="form-label">Salary Amount ($)</label>
                        <input type="number" step="0.01" class="form-control @error('salary_amount') is-invalid @enderror"
                            id="salary_amount" name="salary_amount" value="{{ old('salary_amount') }}">
                        @error('salary_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row" id="commissionFields" style="display: {{ in_array(old('employment_type'), ['commission', 'both']) ? 'block' : 'none' }};">
                    <div class="col-md-6 mb-3">
                        <label for="commission_percentage" class="form-label">Commission Percentage (%)</label>
                        <input type="number" step="0.01" min="0" max="100" class="form-control @error('commission_percentage') is-invalid @enderror"
                            id="commission_percentage" name="commission_percentage" value="{{ old('commission_percentage') }}">
                        @error('commission_percentage')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="qualification" class="form-label">Qualification</label>
                        <input type="text" class="form-control @error('qualification') is-invalid @enderror"
                            id="qualification" name="qualification" value="{{ old('qualification') }}">
                        @error('qualification')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="experience_years" class="form-label">Experience (Years)</label>
                        <input type="number" class="form-control @error('experience_years') is-invalid @enderror"
                            id="experience_years" name="experience_years" value="{{ old('experience_years') }}">
                        @error('experience_years')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <h5 class="border-bottom pb-2 mb-3">Services</h5>
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Select Services this employee can perform</label>

                        <!-- Select All Option -->
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" id="selectAllServices">
                            <label class="form-check-label fw-bold" for="selectAllServices">
                                Select All
                            </label>
                        </div>

                        <div class="row">
                            @foreach($services as $service)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input service-checkbox"
                                        type="checkbox"
                                        name="services[]"
                                        value="{{ $service->id }}"
                                        id="service{{ $service->id }}"
                                        {{ is_array(old('services')) && in_array($service->id, old('services')) ? 'checked' : '' }}>

                                    <label class="form-check-label" for="service{{ $service->id }}">
                                        {{ $service->name }} (₹{{ $service->price }})
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @error('services')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Employee
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#employment_type').change(function() {
            var type = $(this).val();

            if (type == 'salary' || type == 'both') {
                $('#salaryFields').show();
            } else {
                $('#salaryFields').hide();
                $('#salary_amount').val('');
            }

            if (type == 'commission' || type == 'both') {
                $('#commissionFields').show();
            } else {
                $('#commissionFields').hide();
                $('#commission_percentage').val('');
            }
        });
    });
</script>
<script>
    document.getElementById('selectAllServices').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.service-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.checked = document.getElementById('selectAllServices').checked;
        });
    });
</script>
@endpush
@endsection