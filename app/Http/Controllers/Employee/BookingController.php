<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Service;
use App\Models\Commission;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function index()
    {
        $employee = Employee::where('user_id', auth()->id())->first();

        $appointments = Appointment::with(['client', 'employee', 'services'])
            ->where('employee_id', $employee->id)
            ->latest()
            ->paginate(10);

        return view('employee.bookings.index', compact('appointments'));
    }

    public function create()
    {
        $clients = Client::active()->get();
        $employees = Employee::with('user')->active()->get();
        $services = Service::active()->get();
        
        return view('employee.bookings.create', compact('clients', 'employees', 'services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'nullable',
            // 'employee_id' => 'required|exists:employees,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id',
            'discount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string'
        ]);

        if ($request->client_id == 'new') {

            $client = Client::create([
                'name'  => $request->new_client_name,
                'phone' => $request->new_client_phone,
            ]);

            $clientId = $client->id;

        } else {
            $clientId = $request->client_id;
        }

        DB::transaction(function () use ($request, $clientId) {
            // Calculate total amount from selected services
            $services = Service::whereIn('id', $request->services)->get();
            $totalAmount = $services->sum('price');
            $discount = $request->discount ?? 0;
            $finalAmount = $totalAmount - $discount;

            // Calculate end time based on total duration
            $totalDuration = $services->sum('duration');
            $startTime = \Carbon\Carbon::parse($request->start_time);
            $endTime = $startTime->copy()->addMinutes($totalDuration);

            $employee = Employee::where('user_id', auth()->id())->first();

            // Create appointment
            $appointment = Appointment::create([
                'appointment_number' => 'APT-' . time(),
                'client_id' => $clientId,
                'employee_id' => $employee->id,
                'appointment_date' => $request->appointment_date,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_amount' => $totalAmount,
                'discount' => $discount,
                'final_amount' => $finalAmount,
                'payment_status' => 'pending',
                'appointment_status' => 'scheduled',
                'notes' => $request->notes
            ]);

            // Attach services
            foreach ($services as $service) {
                $appointment->services()->attach($service->id, ['price' => $service->price]);
            }

            // Update client total visits
            $client = Client::find($clientId);
            $client->increment('total_visits');
        });

        return redirect()->route('employee.booking.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['client', 'employee.user', 'services', 'payments']);
        return view('employee.bookings.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $clients = Client::active()->get();
        $employees = Employee::with('user')->active()->get();
        $services = Service::active()->get();
        $selectedServices = $appointment->services->pluck('id')->toArray();
        
        return view('employee.bookings.edit', compact('appointment', 'clients', 'employees', 'services', 'selectedServices'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'employee_id' => 'required|exists:employees,id',
            'appointment_date' => 'required|date',
            'start_time' => 'required',
            'services' => 'required|array|min:1',
            'services.*' => 'exists:services,id',
            'discount' => 'nullable|numeric|min:0',
            'appointment_status' => 'required',
            'notes' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $appointment) {
            // Calculate total amount from selected services
            $services = Service::whereIn('id', $request->services)->get();
            $totalAmount = $services->sum('price');
            $discount = $request->discount ?? 0;
            $finalAmount = $totalAmount - $discount;

            // Calculate end time based on total duration
            $totalDuration = $services->sum('duration');
            $startTime = \Carbon\Carbon::parse($request->start_time);
            $endTime = $startTime->copy()->addMinutes($totalDuration);

            // Update appointment
            $appointment->update([
                'client_id' => $request->client_id,
                'employee_id' => $request->employee_id,
                'appointment_date' => $request->appointment_date,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_amount' => $totalAmount,
                'discount' => $discount,
                'final_amount' => $finalAmount,
                'appointment_status' => $request->appointment_status,
                'notes' => $request->notes
            ]);

            // Sync services
            $appointment->services()->sync([]);
            foreach ($services as $service) {
                $appointment->services()->attach($service->id, ['price' => $service->price]);
            }

            // If appointment is completed, process commission
            if ($request->appointment_status === 'completed' && $appointment->payment_status === 'paid') {
                $this->processCommission($appointment);
            }
        });

        return redirect()->route('employee.booking.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function processPayment(Request $request, Appointment $appointment)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0|max:' . $appointment->final_amount,
            'payment_method' => 'required|in:cash,card,upi,other',
            'notes' => 'nullable|string'
        ]);

        DB::transaction(function () use ($request, $appointment) {
            // Create payment
            Payment::create([
                'payment_number' => 'PAY-' . time(),
                'appointment_id' => $appointment->id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'payment_date' => now(),
                'notes' => $request->notes
            ]);

            // Update appointment payment status
            $totalPaid = $appointment->payments()->sum('amount');
            $paymentStatus = $totalPaid >= $appointment->final_amount ? 'paid' : 'partial';
            
            $appointment->update([
                'payment_status' => $paymentStatus
            ]);

            // If payment is complete and appointment is completed, process commission
            if ($paymentStatus === 'paid' && $appointment->appointment_status === 'completed') {
                $this->processCommission($appointment);
            }

            // Update client total spent
            $client = $appointment->client;
            $client->increment('total_spent', $request->amount);
        });

        return redirect()->route('employee.booking.show', $appointment)
            ->with('success', 'Payment processed successfully.');
    }

    private function processCommission(Appointment $appointment)
    {
        $employee = $appointment->employee;
        
        // Check if employee is eligible for commission
        if (in_array($employee->employment_type, ['commission', 'both']) && $employee->commission_percentage > 0) {
            $commissionAmount = ($appointment->final_amount * $employee->commission_percentage) / 100;
            
            Commission::create([
                'employee_id' => $employee->id,
                'appointment_id' => $appointment->id,
                'service_amount' => $appointment->final_amount,
                'commission_percentage' => $employee->commission_percentage,
                'commission_amount' => $commissionAmount,
                'commission_date' => now(),
                'status' => 'pending'
            ]);
        }
    }

    public function updatePaymentStatus(Request $request, Appointment $appointment)
{
    $request->validate([
        'payment_status' => 'required|in:pending,partial,paid,refunded',
        'payment_amount' => 'required_if:payment_status,partial|numeric|min:0.01|max:' . $appointment->final_amount,
        'payment_method' => 'required_if:payment_status,partial|in:cash,card,upi,other'
    ]);

    DB::transaction(function () use ($request, $appointment) {
        // If partial payment, create a payment record
        if ($request->payment_status === 'partial' && $request->payment_amount > 0) {
            Payment::create([
                'payment_number' => 'PAY-' . time(),
                'appointment_id' => $appointment->id,
                'amount' => $request->payment_amount,
                'payment_method' => $request->payment_method,
                'payment_date' => now(),
                'notes' => 'Partial payment via edit form'
            ]);
        }

        // Update appointment payment status
        $appointment->update([
            'payment_status' => $request->payment_status
        ]);

        // If appointment is completed and payment is paid, process commission
        if ($appointment->appointment_status === 'completed' && $request->payment_status === 'paid') {
            $this->processCommission($appointment);
        }
    });

    return redirect()->route('employee.booking.edit', $appointment)
        ->with('success', 'Payment status updated successfully.');
}

public function fullPayment(Request $request, Appointment $appointment)
{
    $request->validate([
        'payment_method' => 'required|in:cash,card,upi,other',
        'notes' => 'nullable|string'
    ]);

    DB::transaction(function () use ($request, $appointment) {
        $totalPaid = $appointment->payments()->sum('amount');
        $remainingAmount = $appointment->final_amount - $totalPaid;

        if ($remainingAmount > 0) {
            // Create payment record for remaining amount
            Payment::create([
                'payment_number' => 'PAY-' . time(),
                'appointment_id' => $appointment->id,
                'amount' => $remainingAmount,
                'payment_method' => $request->payment_method,
                'payment_date' => now(),
                'notes' => $request->notes ?? 'Full payment completion'
            ]);
        }

        // Update appointment payment status
        $appointment->update([
            'payment_status' => 'paid'
        ]);

        // If appointment is completed, process commission
        if ($appointment->appointment_status === 'completed') {
            $this->processCommission($appointment);
        }
    });

    return redirect()->route('employee.booking.edit', $appointment)
        ->with('success', 'Appointment marked as fully paid.');
}
}