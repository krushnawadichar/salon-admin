{{-- resources/views/layouts/employee.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Salon Management System') - Employee Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <style>
        .wrapper {
            display: flex;
            width: 100%;
            align-items: stretch;
        }
        
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #2c3e50;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        #sidebar.active {
            margin-left: -250px;
        }
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: #243342;
        }
        
        #sidebar ul.components {
            padding: 20px 0;
        }
        
        #sidebar ul li a {
            padding: 10px 20px;
            font-size: 1.1em;
            display: block;
            color: #fff;
            text-decoration: none;
        }
        
        #sidebar ul li a:hover {
            background: #243342;
        }
        
        #sidebar ul li.active > a {
            background: #3498db;
        }
        
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
            background-color: #f8f9fa;
        }
        
        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .footer {
            margin-top: auto;
            background: #fff;
            padding: 15px 0;
            text-align: center;
            border-top: 1px solid #dee2e6;
            border-radius: 10px;
            margin-top: 20px;
        }
        
        .content-wrapper {
            min-height: calc(100vh - 180px);
        }
        
        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .bg-soft-primary {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }
        
        .bg-soft-success {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
        }
        
        .bg-soft-warning {
            background: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
        }
        
        .bg-soft-info {
            background: rgba(52, 152, 219, 0.1);
            color: #3498db;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4 class="text-center">Employee Panel</h4>
                <p class="text-center text-light mb-0">
                    <small>{{ Auth::user()->employee->employee_id ?? 'Employee' }}</small>
                </p>
            </div>
            
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('employee.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('employee.appointments*') ? 'active' : '' }}">
                    <a href="{{ route('employee.appointments') }}">
                        <i class="fas fa-calendar-check me-2"></i> My Appointments
                    </a>
                </li>
                <li class="{{ request()->routeIs('employee.booking.*') ? 'active' : '' }}">
                    <a href="#appointmentSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('employee.booking.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-calendar-alt me-2"></i> Appointments
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('employee.booking.*') ? 'show' : '' }}" id="appointmentSubmenu">
                        <li><a href="{{ route('employee.booking.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Appointments</a></li>
                        <li><a href="{{ route('employee.booking.create') }}"><i class="fas fa-plus ms-4 me-2"></i> New Appointment</a></li>
                    </ul>
                </li>
                
                <li class="{{ request()->routeIs('employee.commissions*') ? 'active' : '' }}">
                    <a href="{{ route('employee.commissions') }}">
                        <i class="fas fa-dollar-sign me-2"></i> My Commissions
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('employee.profile*') ? 'active' : '' }}">
                    <a href="{{ route('employee.profile') }}">
                        <i class="fas fa-user-cog me-2"></i> Profile
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt me-2"></i> Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
            
            <div class="p-3">
                <div class="text-center text-light">
                    <small>Welcome,</small><br>
                    <strong>{{ Auth::user()->name }}</strong>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown me-3">
                            <button class="btn btn-light position-relative" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                @php
                                    $pendingAppointments = App\Models\Appointment::where('employee_id', Auth::user()->employee->id ?? 0)
                                        ->whereDate('appointment_date', today())
                                        ->where('appointment_status', 'scheduled')
                                        ->count();
                                @endphp
                                @if($pendingAppointments > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        {{ $pendingAppointments }}
                                    </span>
                                @endif
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#">You have {{ $pendingAppointments }} appointments today</a></li>
                            </ul>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('employee.profile') }}">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="content-wrapper">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <span class="text-muted">© {{ date('Y') }} Salon Management System - Employee Panel. All rights reserved.</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
            
            // Initialize DataTables
            $('.datatable').DataTable({
                "pageLength": 10,
                "ordering": true,
                "responsive": true
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>