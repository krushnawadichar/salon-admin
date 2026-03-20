<?php
// app/Models/Salary.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id', 'basic_salary', 'commission_earned',
        'total_salary', 'month', 'year', 'status', 'payment_date'
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',
        'commission_earned' => 'decimal:2',
        'total_salary' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}