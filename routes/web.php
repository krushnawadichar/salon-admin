<?php
// routes/web.php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Employee\DashboardController as EmployeeDashboardController;
use App\Http\Controllers\Employee\AppointmentController as EmployeeAppointmentController;
use App\Http\Controllers\Employee\CommissionController as EmployeeCommissionController;
use App\Http\Controllers\Employee\ProfileController as EmployeeProfileController;
use App\Http\Controllers\Employee\BookingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {   
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    // Redirect based on role
    Route::get('/dashboard', function () {
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('employee.dashboard');
        }
    })->name('dashboard');
    
    // Admin Routes - Fix: Use middleware as array with string
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(['auth', 'admin']) // Add 'auth' middleware explicitly
        ->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
            
            // Services
            Route::resource('services', ServiceController::class);
            
            // Employees
            Route::resource('employees', EmployeeController::class);
            // Add these routes inside the admin group after the existing employee routes
            Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
            Route::patch('/employees/{employee}/deactivate', [EmployeeController::class, 'deactivate'])->name('employees.deactivate');
            Route::patch('/employees/{employee}/activate', [EmployeeController::class, 'activate'])->name('employees.activate');
            Route::patch('/employees/{employee}/update-schedule', [EmployeeController::class, 'updateSchedule'])->name('employees.update-schedule');
            Route::post('/employees/check-email', [EmployeeController::class, 'checkEmail'])->name('employees.check-email');
            
            // Clients
            Route::resource('clients', ClientController::class);
            // Add these routes inside the admin group after the existing client routes
            Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');
            Route::patch('/clients/{client}/deactivate', [ClientController::class, 'deactivate'])->name('clients.deactivate');
            Route::patch('/clients/{client}/activate', [ClientController::class, 'activate'])->name('clients.activate');
            Route::post('/clients/check-duplicate', [ClientController::class, 'checkDuplicate'])->name('clients.check-duplicate');
            
            // Appointments
            Route::resource('appointments', AppointmentController::class);
            Route::post('/appointments/{appointment}/payment', [AppointmentController::class, 'processPayment'])->name('appointments.payment');

            Route::patch('/appointments/{appointment}/update-payment-status', [AppointmentController::class, 'updatePaymentStatus'])->name('appointments.update-payment-status');
            Route::patch('/appointments/{appointment}/full-payment', [AppointmentController::class, 'fullPayment'])->name('appointments.full-payment');
            
            // Reports
            Route::get('/reports/daily', [ReportController::class, 'dailyReport'])->name('reports.daily');
            Route::get('/reports/monthly', [ReportController::class, 'monthlyReport'])->name('reports.monthly');
            Route::get('/reports/commission', [ReportController::class, 'commissionReport'])->name('reports.commission');
            Route::get('/reports/salary', [ReportController::class, 'salaryReport'])->name('reports.salary');
            Route::post('/reports/process-salary', [ReportController::class, 'processSalary'])->name('reports.process-salary');
        });
    
    // Employee Routes - Fix: Use middleware as array with string
    Route::prefix('employee')
        ->name('employee.')
        ->middleware(['auth', 'employee']) // Add 'auth' middleware explicitly
        ->group(function () {
            Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');
            Route::get('/appointments', [EmployeeAppointmentController::class, 'index'])->name('appointments');
            Route::get('/commissions', [EmployeeCommissionController::class, 'index'])->name('commissions');
            Route::get('/profile', [EmployeeProfileController::class, 'edit'])->name('profile');
            Route::put('/profile', [EmployeeProfileController::class, 'update'])->name('profile.update');
            Route::put('/profile/password', [EmployeeProfileController::class, 'updatePassword'])->name('profile.password');
            Route::post('/appointments/{appointment}/status', [EmployeeAppointmentController::class, 'updateStatus'])->name('appointments.update-status');
            Route::get('/appointments/{appointment}', [EmployeeAppointmentController::class, 'show'])->name('appointments.show');

                        // Appointments
            // Route::resource('appointments', AppointmentController::class);
            Route::post('/booking/{appointment}/payment', [AppointmentController::class, 'processPayment'])->name('booking.payment');

            Route::patch('/booking/{appointment}/update-payment-status', [AppointmentController::class, 'updatePaymentStatus'])->name('booking.update-payment-status');
            Route::patch('/booking/{appointment}/full-payment', [AppointmentController::class, 'fullPayment'])->name('booking.full-payment');
                    Route::get('/booking', [BookingController::class, 'index'])
            ->name('booking.index');

        Route::get('/booking/create', [BookingController::class, 'create'])
            ->name('booking.create');

        Route::post('/booking', [BookingController::class, 'store'])
            ->name('booking.store');

        Route::get('/booking/{appointment}', [BookingController::class, 'show'])
            ->name('booking.show');

        Route::get('/booking/{appointment}/edit', [BookingController::class, 'edit'])
            ->name('booking.edit');

        Route::put('/booking/{appointment}', [BookingController::class, 'update'])
            ->name('booking.update');

        Route::delete('/booking/{appointment}', [BookingController::class, 'destroy'])
            ->name('booking.destroy');

        });
}); 

require __DIR__.'/auth.php';