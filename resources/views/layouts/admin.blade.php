<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Salon Management System') - Admin Panel</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
            background: #343a40;
            color: #fff;
            transition: all 0.3s;
            min-height: 100vh;
        }
        
        #sidebar.active {
            margin-left: -250px;
        }
        
        #sidebar .sidebar-header {
            padding: 20px;
            background: #2c3136;
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
            background: #2c3136;
        }
        
        #sidebar ul li.active > a {
            background: #007bff;
        }
        
        #content {
            width: 100%;
            padding: 20px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        .navbar {
            padding: 15px 10px;
            background: #fff;
            border: none;
            border-radius: 0;
            margin-bottom: 20px;
            box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .footer {
            margin-top: auto;
            background: #f8f9fa;
            padding: 10px 0;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        
        .content-wrapper {
            min-height: calc(100vh - 130px);
        }
        .select2-container .select2-selection--single {
            height: 38px;
            padding: 5px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h4 class="text-center">Salon Admin</h4>
            </div>
            
            <ul class="list-unstyled components">
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#serviceSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.services.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-cut me-2"></i> Services
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.services.*') ? 'show' : '' }}" id="serviceSubmenu">
                        <li><a href="{{ route('admin.services.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Services</a></li>
                        <li><a href="{{ route('admin.services.create') }}"><i class="fas fa-plus ms-4 me-2"></i> Add Service</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#employeeSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.employees.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-users me-2"></i> Employees
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.employees.*') ? 'show' : '' }}" id="employeeSubmenu">
                        <li><a href="{{ route('admin.employees.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Employees</a></li>
                        <li><a href="{{ route('admin.employees.create') }}"><i class="fas fa-user-plus ms-4 me-2"></i> Add Employee</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#clientSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.clients.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-user me-2"></i> Clients
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.clients.*') ? 'show' : '' }}" id="clientSubmenu">
                        <li><a href="{{ route('admin.clients.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Clients</a></li>
                        <li><a href="{{ route('admin.clients.create') }}"><i class="fas fa-user-plus ms-4 me-2"></i> Add Client</a></li>
                    </ul>
                </li>
                
                <li class="{{ request()->routeIs('admin.appointments.*') ? 'active' : '' }}">
                    <a href="#appointmentSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.appointments.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-calendar-alt me-2"></i> Appointments
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.appointments.*') ? 'show' : '' }}" id="appointmentSubmenu">
                        <li><a href="{{ route('admin.appointments.index') }}"><i class="fas fa-list ms-4 me-2"></i> All Appointments</a></li>
                        <li><a href="{{ route('admin.appointments.create') }}"><i class="fas fa-plus ms-4 me-2"></i> New Appointment</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#reportSubmenu" data-bs-toggle="collapse" aria-expanded="{{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }}" class="dropdown-toggle">
                        <i class="fas fa-chart-bar me-2"></i> Reports
                    </a>
                    <ul class="collapse list-unstyled {{ request()->routeIs('admin.reports.*') ? 'show' : '' }}" id="reportSubmenu">
                        <li><a href="{{ route('admin.reports.daily') }}"><i class="fas fa-calendar-day ms-4 me-2"></i> Daily Report</a></li>
                        <li><a href="{{ route('admin.reports.monthly') }}"><i class="fas fa-calendar-alt ms-4 me-2"></i> Monthly Report</a></li>
                        <li><a href="{{ route('admin.reports.commission') }}"><i class="fas fa-percent ms-4 me-2"></i> Commission Report</a></li>
                        <li><a href="{{ route('admin.reports.salary') }}"><i class="fas fa-money-bill ms-4 me-2"></i> Salary Report</a></li>
                    </ul>
                </li>
                
                <li>
                    <a href="">
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
        </nav>

        <!-- Page Content -->
        <div id="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown me-3">
                            <button class="btn btn-light dropdown-toggle" type="button" id="notificationDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="badge bg-danger">3</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#">New appointment</a></li>
                                <li><a class="dropdown-item" href="#">Payment received</a></li>
                                <li><a class="dropdown-item" href="#">Employee added</a></li>
                            </ul>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="">Profile</a></li>
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
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <span class="text-muted">© {{ date('Y') }} Salon Management System. All rights reserved.</span>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    
    <script>
        $(document).ready(function() {
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });
            
            // Initialize DataTables
            $('.datatable').DataTable();

            $('.select2').each(function() {
                $(this).select2({
                    placeholder: $(this).data('placeholder') || "Select",
                    allowClear: true,
                    width: '100%'
                });
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>