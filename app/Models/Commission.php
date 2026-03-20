<?php
// app/Models/Commission.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'appointment_id', 'service_amount',
        'commission_percentage', 'commission_amount', 'status', 'commission_date'
    ];

    protected $casts = [
        'service_amount' => 'decimal:2',
        'commission_percentage' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'commission_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}