<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients',
            'phone' => 'required|string|max:20|unique:clients',
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'notes' => 'nullable|string'
        ]);

        Client::create($request->all());

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client created successfully.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email,' . $client->id,
            'phone' => 'required|string|max:20|unique:clients,phone,' . $client->id,
            'address' => 'nullable|string',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'notes' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $client->update($request->all());

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client deleted successfully.');
    }

    public function show(Client $client)
{
    $appointments = $client->appointments()
        ->with(['employee.user', 'services'])
        ->latest()
        ->paginate(10);
    
    return view('admin.clients.show', compact('client', 'appointments'));
}


public function deactivate(Request $request, Client $client)
{
    $request->validate([
        'deactivation_reason' => 'required|string'
    ]);

    $client->update([
        'status' => 'inactive',
        'deactivation_reason' => $request->deactivation_reason,
        'deactivated_at' => now()
    ]);

    return redirect()->route('admin.clients.edit', $client)
        ->with('success', 'Client deactivated successfully.');
}

public function activate(Client $client)
{
    $client->update([
        'status' => 'active',
        'deactivation_reason' => null,
        'deactivated_at' => null
    ]);

    return redirect()->route('admin.clients.edit', $client)
        ->with('success', 'Client activated successfully.');
}

public function checkDuplicate(Request $request)
{
    $query = Client::query();
    
    if ($request->email) {
        $query->orWhere('email', $request->email);
    }
    
    if ($request->phone) {
        $query->orWhere('phone', $request->phone);
    }
    
    if ($request->client_id) {
        $query->where('id', '!=', $request->client_id);
    }
    
    $exists = $query->exists();
    
    $response = [
        'email_exists' => false,
        'phone_exists' => false
    ];
    
    if ($request->email) {
        $response['email_exists'] = Client::where('email', $request->email)
            ->where('id', '!=', $request->client_id)
            ->exists();
    }
    
    if ($request->phone) {
        $response['phone_exists'] = Client::where('phone', $request->phone)
            ->where('id', '!=', $request->client_id)
            ->exists();
    }
    
    return response()->json($response);
}
}