<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
       $employees = Employee::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        $services = Service::active()->get();
        return view('admin.employees.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'employee_id' => 'required|string|unique:employees',
            'employment_type' => 'required|in:salary,commission,both',
            'salary_amount' => 'required_if:employment_type,salary,both|nullable|numeric|min:0',
            'commission_percentage' => 'required_if:employment_type,commission,both|nullable|numeric|min:0|max:100',
            'joining_date' => 'required|date',
            'qualification' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'services' => 'array',
            'services.*' => 'exists:services,id'
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'), // Default password
            'role' => 'employee',
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        // Create employee
        $employee = Employee::create([
            'user_id' => $user->id,
            'employee_id' => $request->employee_id,
            'employment_type' => $request->employment_type,
            'salary_amount' => $request->salary_amount,
            'commission_percentage' => $request->commission_percentage,
            'joining_date' => $request->joining_date,
            'qualification' => $request->qualification,
            'experience_years' => $request->experience_years,
            'status' => 'active'
        ]);

        // Attach services
        if ($request->has('services')) {
            $employee->services()->attach($request->services);
        }

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function edit(Employee $employee)
    {
        $services = Service::active()->get();
        $employeeServices = $employee->services->pluck('id')->toArray();
        return view('admin.employees.edit', compact('employee', 'services', 'employeeServices'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $employee->user_id,
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
            'employee_id' => 'required|string|unique:employees,employee_id,' . $employee->id,
            'employment_type' => 'required|in:salary,commission,both',
            'salary_amount' => 'required_if:employment_type,salary,both|nullable|numeric|min:0',
            'commission_percentage' => 'required_if:employment_type,commission,both|nullable|numeric|min:0|max:100',
            'joining_date' => 'required|date',
            'qualification' => 'nullable|string',
            'experience_years' => 'nullable|integer|min:0',
            'status' => 'required|in:active,inactive',
            'services' => 'array',
            'services.*' => 'exists:services,id'
        ]);

        // Update user
        $employee->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        // Update employee
        $employee->update([
            'employee_id' => $request->employee_id,
            'employment_type' => $request->employment_type,
            'salary_amount' => $request->salary_amount,
            'commission_percentage' => $request->commission_percentage,
            'joining_date' => $request->joining_date,
            'qualification' => $request->qualification,
            'experience_years' => $request->experience_years,
            'status' => $request->status
        ]);

        // Sync services
        $employee->services()->sync($request->services ?? []);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->user->delete(); // This will cascade delete employee
        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
public function show(Employee $employee)
{
    $employee->load(['user', 'services', 'appointments.client' => function($q) {
        $q->latest()->limit(10);
    }]);
    
    return view('admin.employees.show', compact('employee'));
}

public function deactivate(Request $request, Employee $employee)
{
    $request->validate([
        'deactivation_reason' => 'required|string'
    ]);

    $employee->update([
        'status' => 'inactive',
        'deactivation_reason' => $request->deactivation_reason,
        'deactivated_at' => now()
    ]);

    // Optionally revoke user access
    $employee->user->update(['is_active' => false]);

    return redirect()->route('admin.employees.show', $employee)
        ->with('success', 'Employee deactivated successfully.');
}

public function activate(Employee $employee)
{
    $employee->update([
        'status' => 'active',
        'deactivation_reason' => null,
        'deactivated_at' => null
    ]);

    $employee->user->update(['is_active' => true]);

    return redirect()->route('admin.employees.show', $employee)
        ->with('success', 'Employee activated successfully.');
}

public function updateSchedule(Request $request, Employee $employee)
{
    $request->validate([
        'working_hours' => 'required|array',
        'working_hours.*.start' => 'required|date_format:H:i',
        'working_hours.*.end' => 'required|date_format:H:i|after:working_hours.*.start',
    ]);

    $employee->update([
        'working_hours' => $request->working_hours
    ]);

    return redirect()->route('admin.employees.show', $employee)
        ->with('success', 'Working schedule updated successfully.');
}

public function checkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    
    $exists = User::where('email', $request->email)
        ->where('id', '!=', $request->user_id ?? 0)
        ->exists(); 
    
    return response()->json(['available' => !$exists]);
}
}