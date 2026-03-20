@extends('layouts.admin')

@section('title', 'Edit Employee')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Employee: {{ $employee->user->name }}</h1>
        <div>
            <a href="{{ route('admin.employees.show', $employee) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> View Details
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

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employee Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.employees.update', $employee) }}" method="POST" id="employeeForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- User Account Information -->
                        <h5 class="border-bottom pb-2 mb-3">Account Information</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $employee->user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $employee->user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                       id="password" name="password" placeholder="Leave blank to keep current password">
                                <small class="text-muted">Only fill if you want to change password</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                <input type="password" class="form-control" 
                                       id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                        
                        <!-- Employee Details -->
                        <h5 class="border-bottom pb-2 mb-3 mt-4">Employee Details</h5>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="employee_id" class="form-label">Employee ID</label>
                                <input type="text" class="form-control" 
                                       value="{{ $employee->employee_id }}" readonly>
                                <small class="text-muted">Auto-generated and cannot be changed</small>
                            </div>
                            
                            <div class="col-md-4 mb-3">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone', $employee->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="specialization" class="form-label">Specialization</label>
                                <input type="text" class="form-control @error('specialization') is-invalid @enderror" 
                                       id="specialization" name="specialization" 
                                       value="{{ old('specialization', $employee->specialization) }}"
                                       placeholder="e.g., Hair Stylist, Barber, Nail Artist">
                                @error('specialization')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="experience_years" class="form-label">Experience (Years)</label>
                                <input type="number" step="0.5" min="0" class="form-control @error('experience_years') is-invalid @enderror" 
                                       id="experience_years" name="experience_years" 
                                       value="{{ old('experience_years', $employee->experience_years) }}">
                                @error('experience_years')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Salary & Commission Section -->
                        <div class="card bg-light mb-4" id="salarySection">
                            <div class="card-body">
                                <h6 class="font-weight-bold">Compensation Details</h6>
                                
                                <div class="row">
                                    <div class="col-md-4 mb-3" id="salary_field">
                                        <label for="monthly_salary" class="form-label">Monthly Salary ($)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" step="0.01" min="0" 
                                                   class="form-control @error('monthly_salary') is-invalid @enderror" 
                                                   id="monthly_salary" name="monthly_salary" 
                                                   value="{{ old('monthly_salary', $employee->monthly_salary) }}">
                                        </div>
                                        @error('monthly_salary')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 mb-3" id="commission_field">
                                        <label for="commission_percentage" class="form-label">Commission Percentage (%)</label>
                                        <div class="input-group">
                                            <input type="number" step="0.1" min="0" max="100" 
                                                   class="form-control @error('commission_percentage') is-invalid @enderror" 
                                                   id="commission_percentage" name="commission_percentage" 
                                                   value="{{ old('commission_percentage', $employee->commission_percentage) }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                        @error('commission_percentage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="payment_frequency" class="form-label">Payment Frequency</label>
                                        <select class="form-control" id="payment_frequency" name="payment_frequency">
                                            <option value="monthly" {{ old('payment_frequency', $employee->payment_frequency) == 'monthly' ? 'selected' : '' }}>
                                                Monthly
                                            </option>
                                            <option value="bi-weekly" {{ old('payment_frequency', $employee->payment_frequency) == 'bi-weekly' ? 'selected' : '' }}>
                                                Bi-Weekly
                                            </option>
                                            <option value="weekly" {{ old('payment_frequency', $employee->payment_frequency) == 'weekly' ? 'selected' : '' }}>
                                                Weekly
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Employment Details -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="joining_date" class="form-label">Joining Date <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('joining_date') is-invalid @enderror" 
                                       id="joining_date" name="joining_date" 
                                       value="{{ old('joining_date', $employee->joining_date->format('Y-m-d')) }}" 
                                       max="{{ now()->format('Y-m-d') }}" required>
                                @error('joining_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" 
                                        id="status" name="status" required>
                                    <option value="active" {{ old('status', $employee->status) == 'active' ? 'selected' : '' }}>
                                        ✅ Active
                                    </option>
                                    <option value="inactive" {{ old('status', $employee->status) == 'inactive' ? 'selected' : '' }}>
                                        ⭕ Inactive
                                    </option>
                                    <option value="on_leave" {{ old('status', $employee->status) == 'on_leave' ? 'selected' : '' }}>
                                        🏖️ On Leave
                                    </option>
                                    <option value="terminated" {{ old('status', $employee->status) == 'terminated' ? 'selected' : '' }}>
                                        ❌ Terminated
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact_name" class="form-label">Emergency Contact Name</label>
                                <input type="text" class="form-control @error('emergency_contact_name') is-invalid @enderror" 
                                       id="emergency_contact_name" name="emergency_contact_name" 
                                       value="{{ old('emergency_contact_name', $employee->emergency_contact_name) }}">
                                @error('emergency_contact_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="emergency_contact_phone" class="form-label">Emergency Contact Phone</label>
                                <input type="text" class="form-control @error('emergency_contact_phone') is-invalid @enderror" 
                                       id="emergency_contact_phone" name="emergency_contact_phone" 
                                       value="{{ old('emergency_contact_phone', $employee->emergency_contact_phone) }}">
                                @error('emergency_contact_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Address -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="2">{{ old('address', $employee->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Documents & Photo -->
                        <h5 class="border-bottom pb-2 mb-3 mt-4">Documents & Photo</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="profile_photo" class="form-label">Profile Photo</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('profile_photo') is-invalid @enderror" 
                                           id="profile_photo" name="profile_photo" accept="image/*">
                                    <label class="custom-file-label" for="profile_photo">Choose file</label>
                                </div>
                                @error('profile_photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($employee->profile_photo)
                                    <small class="text-muted d-block mt-2">
                                        Current: <a href="{{ Storage::url($employee->profile_photo) }}" target="_blank">View Photo</a>
                                    </small>
                                @endif
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="id_proof" class="form-label">ID Proof Document</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('id_proof') is-invalid @enderror" 
                                           id="id_proof" name="id_proof" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="custom-file-label" for="id_proof">Choose file</label>
                                </div>
                                @error('id_proof')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if($employee->id_proof)
                                    <small class="text-muted d-block mt-2">
                                        Current: <a href="{{ Storage::url($employee->id_proof) }}" target="_blank">View Document</a>
                                    </small>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Notes -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="notes" class="form-label">Additional Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" 
                                          id="notes" name="notes" rows="3">{{ old('notes', $employee->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Employee
                            </button>
                            
                            @if($employee->status == 'active')
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deactivateModal">
                                    <i class="fas fa-pause-circle"></i> Deactivate Employee
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Statistics & Actions -->
        <div class="col-lg-4">
            <!-- Quick Stats Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Employee Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            @if($employee->profile_photo)
                                <img src="{{ Storage::url($employee->profile_photo) }}" 
                                     alt="{{ $employee->user->name }}" 
                                     class="img-fluid rounded-circle" style="max-width: 120px;">
                            @else
                                <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                                     style="width: 120px; height: 120px; font-size: 3rem;">
                                    {{ strtoupper(substr($employee->user->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        
                        <h5>{{ $employee->user->name }}</h5>
                        <p class="text-muted">{{ $employee->specialization ?? 'No specialization' }}</p>
                        
                        <span class="badge badge-{{ $employee->status == 'active' ? 'success' : ($employee->status == 'on_leave' ? 'warning' : 'secondary') }} p-2">
                            {{ ucfirst(str_replace('_', ' ', $employee->status)) }}
                        </span>
                    </div>
                    
                    <div class="row text-center mb-4">
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $employee->appointments()->whereMonth('appointment_date', now()->month)->count() }}
                            </div>
                            <div class="small text-gray-600">This Month</div>
                        </div>
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $employee->appointments()->count() }}
                            </div>
                            <div class="small text-gray-600">Total Appointments</div>
                        </div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($employee->commissions()->whereMonth('commission_date', now()->month)->sum('commission_amount'), 2) }}
                            </div>
                            <div class="small text-gray-600">Commission This Month</div>
                        </div>
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $employee->total_leaves ?? 0 }}
                            </div>
                            <div class="small text-gray-600">Leaves Taken</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Working Hours Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Working Schedule</h6>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        @method('PATCH')
                        
                        @php
                            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            $workingHours = $employee->working_hours ?? [];
                        @endphp
                        
                        @foreach($days as $day)
                            <div class="row mb-2 align-items-center">
                                <div class="col-4">
                                    <label class="mb-0">{{ $day }}</label>
                                </div>
                                <div class="col-4">
                                    <input type="time" class="form-control form-control-sm" 
                                           name="working_hours[{{ strtolower($day) }}][start]" 
                                           value="{{ $workingHours[strtolower($day)]['start'] ?? '09:00' }}">
                                </div>
                                <div class="col-4">
                                    <input type="time" class="form-control form-control-sm" 
                                           name="working_hours[{{ strtolower($day) }}][end]" 
                                           value="{{ $workingHours[strtolower($day)]['end'] ?? '18:00' }}">
                                </div>
                            </div>
                        @endforeach
                        
                        <button type="submit" class="btn btn-info btn-block mt-3">
                            <i class="fas fa-clock"></i> Update Schedule
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Danger Zone -->
            <div class="card shadow mb-4 border-left-danger">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Danger Zone</h6>
                </div>
                <div class="card-body">
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
            <form action="" method="POST">
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
        // Handle employment type changes
        function updateCompensationFields() {
            const type = $('#employment_type').val();
            
            if (type === 'salary') {
                $('#salary_field').show();
                $('#commission_field').hide();
                $('#commission_percentage').val(0);
            } else if (type === 'commission') {
                $('#salary_field').hide();
                $('#commission_field').show();
                $('#monthly_salary').val(0);
            } else if (type === 'both') {
                $('#salary_field').show();
                $('#commission_field').show();
            } else {
                $('#salary_field').hide();
                $('#commission_field').hide();
            }
        }
        
        $('#employment_type').change(updateCompensationFields);
        updateCompensationFields(); // Initial call
        
        // File input label update
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        
        // Password strength indicator
        $('#password').on('keyup', function() {
            const password = $(this).val();
            let strength = 0;
            
            if (password.length >= 8) strength += 1;
            if (password.match(/[a-z]+/)) strength += 1;
            if (password.match(/[A-Z]+/)) strength += 1;
            if (password.match(/[0-9]+/)) strength += 1;
            if (password.match(/[$@#&!]+/)) strength += 1;
            
            // You can add visual indicator here
        });
        
        // Enable delete button only when checkbox is checked
        $('#confirm_delete').change(function() {
            $('#confirmDeleteBtn').prop('disabled', !$(this).is(':checked'));
        });
        
        // Phone number formatting
        $('#phone').on('input', function() {
            let phone = $(this).val().replace(/\D/g, '');
            if (phone.length > 10) {
                phone = phone.substr(0, 10);
            }
            $(this).val(phone);
        });
        
        // Form validation
        $('#employeeForm').submit(function(e) {
            const employmentType = $('#employment_type').val();
            const monthlySalary = parseFloat($('#monthly_salary').val()) || 0;
            const commissionPercentage = parseFloat($('#commission_percentage').val()) || 0;
            
            if (employmentType === 'salary' && monthlySalary <= 0) {
                e.preventDefault();
                toastr.error('Please enter a valid monthly salary for salary-based employee');
                return false;
            }
            
            if (employmentType === 'commission' && commissionPercentage <= 0) {
                e.preventDefault();
                toastr.error('Please enter a valid commission percentage for commission-based employee');
                return false;
            }
            
            if (employmentType === 'both') {
                if (monthlySalary <= 0) {
                    e.preventDefault();
                    toastr.error('Please enter a valid monthly salary');
                    return false;
                }
                if (commissionPercentage <= 0) {
                    e.preventDefault();
                    toastr.error('Please enter a valid commission percentage');
                    return false;
                }
            }
        });
        
        // Check for existing email (AJAX)
        $('#email').on('blur', function() {
            const email = $(this).val();
            const currentEmail = '{{ $employee->user->email }}';
            
            if (email && email !== currentEmail) {
                $.ajax({
                    url: '',
                    method: 'POST',
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (!response.available) {
                            toastr.error('This email is already taken. Please use another email.');
                            $('#email').addClass('is-invalid');
                        } else {
                            $('#email').removeClass('is-invalid');
                        }
                    }
                });
            }
        });
    });
</script>
@endpush
@endsection