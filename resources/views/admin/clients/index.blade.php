@extends('layouts.admin')

@section('title', 'Clients')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Clients</h1>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Add New Client
        </a>
    </div>
   <!-- ✅ FILTER CARD (Separate & Clean) -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.clients.index') }}">
                <div class="row align-items-end">

                    <!-- Search -->
                    <div class="col-md-4 mb-2">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="Name / Email / Phone"
                               value="{{ request('search') }}">
                    </div>

                         <!-- Gender -->
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">All</option>
                            <option value="male" {{ request('gender')=='male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ request('gender')=='female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ request('gender')=='other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="col-md-3 mb-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="">All</option>
                            <option value="active" {{ request('status')=='active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status')=='inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="col-md-2 mb-2 d-flex">
                        <button class="btn btn-primary w-50 me-2">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary w-50">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered datatable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Total Visits</th>
                            <th>Total Spent</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->id }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email ?? 'N/A' }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->total_visits }}</td>
                            <td>₹{{ number_format($client->total_spent, 2) }}</td>
                            <td>
                                <span class="badge bg-{{ $client->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($client->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                   <!-- 📅 Direct Appointment (NEW) -->
                                    <a href="{{ route('admin.appointments.create', ['client_id' => $client->id]) }}" 
                                    class="btn btn-sm btn-success" title="Book Appointment">
                                        <i class="fas fa-calendar-plus"></i>
                                    </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
            </div>
        </div>
    </div>
</div>
@endsection