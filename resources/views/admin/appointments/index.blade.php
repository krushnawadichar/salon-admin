@extends('layouts.admin')

@section('title', 'Appointments')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Appointments</h1>
        <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> New Appointment
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Appointment #</th>
                            <th>Client</th>
                            <th>Employee</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Services</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Appointment Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->appointment_number }}</td>
                            <td>{{ $appointment->client->name }}</td>
                            <td>{{ $appointment->employee->user->name }}</td>
                            <td>{{ $appointment->appointment_date->format('d M Y') }}</td>
                            <td>{{ $appointment->start_time->format('H:i') }}</td>
                            <td>
                                @foreach($appointment->services as $service)
                                    <span class="badge bg-info">{{ $service->name }}</span>
                                @endforeach
                            </td>
                            <td>₹{{ number_format($appointment->final_amount, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $appointment->payment_status == 'paid' ? 'success' : ($appointment->payment_status == 'partial' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($appointment->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $appointment->appointment_status == 'completed' ? 'success' : ($appointment->appointment_status == 'scheduled' ? 'primary' : 'danger') }}">
                                    {{ ucfirst($appointment->appointment_status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
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
        </div>
    </div>
</div>
@endsection