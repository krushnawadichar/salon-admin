@extends('layouts.admin')

@section('title', 'Edit Client')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Client: {{ $client->name }}</h1>
        <div>
            <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-info">
                <i class="fas fa-eye"></i> View Details
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

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Client Information</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.clients.update', $client) }}" method="POST" id="clientForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $client->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $client->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Used for sending notifications and offers</small>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone', $client->phone) }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Used for SMS notifications</small>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="date_of_birth" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" 
                                       id="date_of_birth" name="date_of_birth" 
                                       value="{{ old('date_of_birth', $client->date_of_birth ? $client->date_of_birth->format('Y-m-d') : '') }}">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ old('gender', $client->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $client->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $client->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="active" {{ old('status', $client->status) == 'active' ? 'selected' : '' }}>
                                        ✅ Active
                                    </option>
                                    <option value="inactive" {{ old('status', $client->status) == 'inactive' ? 'selected' : '' }}>
                                        ⭕ Inactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" 
                                          id="address" name="address" rows="2">{{ old('address', $client->address) }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mb-3">
                                <label for="notes" class="form-label">Additional Notes</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror" 
                                          id="notes" name="notes" rows="3">{{ old('notes', $client->notes) }}</textarea>
                                @error('notes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Client
                            </button>
                            
                            @if($client->status == 'active')
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#deactivateModal">
                                    <i class="fas fa-pause-circle"></i> Deactivate Client
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <!-- Client Statistics Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Client Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" 
                             style="width: 100px; height: 100px; font-size: 2.5rem;">
                            {{ strtoupper(substr($client->name, 0, 1)) }}
                        </div>
                        <h5 class="mt-3">{{ $client->name }}</h5>
                        <p class="text-muted">Client since {{ $client->created_at->format('M Y') }}</p>
                    </div>
                    
                    <div class="row text-center mb-3">
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $client->total_visits }}</div>
                            <div class="small text-gray-600">Total Visits</div>
                        </div>
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($client->total_spent, 0) }}</div>
                            <div class="small text-gray-600">Total Spent</div>
                        </div>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="h6 mb-0 font-weight-bold text-success">{{ $client->appointments()->where('appointment_status', 'completed')->count() }}</div>
                            <div class="small text-gray-600">Completed</div>
                        </div>
                        <div class="col-6">
                            <div class="h6 mb-0 font-weight-bold text-warning">{{ $client->appointments()->where('appointment_status', 'scheduled')->count() }}</div>
                            <div class="small text-gray-600">Upcoming</div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="small">
                        <strong>Last Visit:</strong> 
                        @if($client->appointments()->latest()->first())
                            {{ $client->appointments()->latest()->first()->appointment_date->format('d M Y') }}
                        @else
                            No visits yet
                        @endif
                    </div>
                    
                    @if($client->email)
                    <div class="small mt-2">
                        <i class="fas fa-envelope text-muted"></i> {{ $client->email }}
                    </div>
                    @endif
                    
                    <div class="small mt-2">
                        <i class="fas fa-phone text-muted"></i> {{ $client->phone }}
                    </div>
                </div>
            </div>
            
            <!-- Recent Appointments Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Appointments</h6>
                </div>
                <div class="card-body p-0">
                    @php
                        $recentAppointments = $client->appointments()
                            ->with('employee.user')
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
                                        <strong>{{ $appointment->appointment_date->format('d M Y') }}</strong>
                                        <small class="d-block text-muted">
                                            {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} 
                                            with {{ $appointment->employee->user->name }}
                                        </small>
                                    </div>
                                    <span class="badge badge-{{ $appointment->appointment_status == 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($appointment->appointment_status) }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('admin.appointments.create', ['client_id' => $client->id]) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> New Appointment
                            </a>
                        </div>
                    @else
                        <p class="text-muted p-3 mb-0">No appointments yet.</p>
                        <div class="card-footer text-center">
                            <a href="{{ route('admin.appointments.create', ['client_id' => $client->id]) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Create First Appointment
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Loyalty Info Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Loyalty Information</h6>
                </div>
                <div class="card-body">
                    @php
                        $totalVisits = $client->total_visits;
                        $loyaltyLevel = 'Bronze';
                        $nextLevel = 'Silver';
                        $visitsNeeded = 10 - ($totalVisits % 10);
                        
                        if ($totalVisits >= 50) {
                            $loyaltyLevel = 'Platinum';
                            $nextLevel = null;
                        } elseif ($totalVisits >= 30) {
                            $loyaltyLevel = 'Gold';
                            $nextLevel = 'Platinum';
                        } elseif ($totalVisits >= 10) {
                            $loyaltyLevel = 'Silver';
                            $nextLevel = 'Gold';
                        }
                    @endphp
                    
                    <div class="text-center">
                        <span class="badge badge-{{ $loyaltyLevel == 'Platinum' ? 'dark' : ($loyaltyLevel == 'Gold' ? 'warning' : ($loyaltyLevel == 'Silver' ? 'secondary' : 'bronze')) }} p-2 mb-3" style="font-size: 1.1rem;">
                            {{ $loyaltyLevel }} Member
                        </span>
                    </div>
                    
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalVisits }}</div>
                            <div class="small text-gray-600">Total Visits</div>
                        </div>
                        <div class="col-6">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹{{ number_format($client->total_spent, 0) }}</div>
                            <div class="small text-gray-600">Lifetime Spend</div>
                        </div>
                    </div>
                    
                    @if($nextLevel)
                    <div class="mt-3">
                        <small class="text-muted">{{ $visitsNeeded }} more visits to reach {{ $nextLevel }}</small>
                        <div class="progress mt-1" style="height: 5px;">
                            <div class="progress-bar bg-success" role="progressbar" 
                                 style="width: {{ ($totalVisits % 10) * 10 }}%"></div>
                        </div>
                    </div>
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
                    
                    <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-info btn-block mb-2">
                        <i class="fas fa-eye"></i> View Full Details
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
        
        // Phone number formatting (Indian format)
        $('#phone').on('input', function() {
            let phone = $(this).val().replace(/\D/g, '');
            if (phone.length > 10) {
                phone = phone.substr(0, 10);
            }
            $(this).val(phone);
        });
        
        // Email validation
        $('#email').on('blur', function() {
            let email = $(this).val();
            if (email && !isValidEmail(email)) {
                $(this).addClass('is-invalid');
                $(this).after('<div class="invalid-feedback">Please enter a valid email address</div>');
            } else {
                $(this).removeClass('is-invalid');
            }
        });
        
        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
        
        // Form validation
        $('#clientForm').submit(function(e) {
            let phone = $('#phone').val().replace(/\D/g, '');
            
            if (phone.length !== 10) {
                e.preventDefault();
                $('#phone').addClass('is-invalid');
                $('#phone').after('<div class="invalid-feedback">Please enter a valid 10-digit phone number</div>');
                toastr.error('Please enter a valid 10-digit phone number');
                return false;
            }
        });
        
        // Check for existing email/phone (AJAX)
        let timeout;
        $('#email, #phone').on('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(checkDuplicate, 1000);
        });
        
        function checkDuplicate() {
            let email = $('#email').val();
            let phone = $('#phone').val();
            let clientId = {{ $client->id }};
            
            if (email || phone) {
                $.ajax({
                    url: '{{ route("admin.clients.check-duplicate") }}',
                    method: 'POST',
                    data: {
                        email: email,
                        phone: phone,
                        client_id: clientId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.email_exists) {
                            $('#email').addClass('is-invalid');
                            $('#email').after('<div class="invalid-feedback">Email already exists</div>');
                        } else {
                            $('#email').removeClass('is-invalid');
                        }
                        
                        if (response.phone_exists) {
                            $('#phone').addClass('is-invalid');
                            $('#phone').after('<div class="invalid-feedback">Phone number already exists</div>');
                        } else {
                            $('#phone').removeClass('is-invalid');
                        }
                    }
                });
            }
        }
    });
</script>
@endpush
@endsection