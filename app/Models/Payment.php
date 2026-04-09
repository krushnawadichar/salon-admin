<?php
// app/Models/Payment.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_number', 'appointment_id', 'amount',
        'payment_method', 'payment_mode', 'payment_date', 'notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    // Scope for cash payments
    public function scopeCash($query)
    {
        return $query->where('payment_mode', 'cash');
    }

    // Scope for online payments
    public function scopeOnline($query)
    {
        return $query->where('payment_mode', 'online');
    }
}