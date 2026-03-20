<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'employee_id', 'employment_type', 'salary_amount',
        'commission_percentage', 'joining_date', 'qualification',
        'experience_years', 'status'
    ];

    protected $casts = [
        'salary_amount' => 'decimal:2',
        'commission_percentage' => 'decimal:2',
        'joining_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'employee_services');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function commissions()
    {
        return $this->hasMany(Commission::class);
    }

    public function salaries()
    {
        return $this->hasMany(Salary::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}