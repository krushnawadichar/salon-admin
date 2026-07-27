<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class WebsiteBookingController extends Controller
{

    public function index()
    {
        return view('home');
    }
public function store(Request $request)
{
    Log::info('Website booking started', $request->all());

    $request->validate([
        'name' => 'required|max:255',
        'phone' => 'required|max:20',
        'description' => 'nullable|string'
    ]);

    DB::beginTransaction();

    try {

        Log::info('Checking existing client');

        $client = Client::where('phone', $request->phone)->first();

        if (!$client) {

            Log::info('Creating new client');

            $client = Client::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'notes' => $request->description,
                'status' => 'active',
            ]);

            Log::info('Client created', ['client_id' => $client->id]);

        } else {

            Log::info('Existing client found', ['client_id' => $client->id]);

            $client->update([
                'name' => $request->name,
                'notes' => $request->description,
            ]);
        }

        Log::info('Creating appointment');

        $appointment = Appointment::create([
            'appointment_number' => 'APT-' . date('YmdHis'),
            'client_id' => $client->id,
            'employee_id' => null,
            'appointment_date' => null,
            'start_time' => null,
            'end_time' => null,
            'total_amount' => 0,
            'discount' => 0,
            'final_amount' => 0,
            'payment_status' => 'pending',
            'appointment_status' => 'scheduled',
            'notes' => $request->description,
        ]);

        Log::info('Appointment created', [
            'appointment_id' => $appointment->id
        ]);

        $client->increment('total_visits');

        DB::commit();

        Log::info('Booking completed successfully');

       return back()->with(
    'success',
    'Thank you! Your booking has been submitted successfully. Our team will contact you shortly.'
);

    } catch (\Exception $e) {

        DB::rollBack();

        Log::error('Website booking failed', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);

        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}
}