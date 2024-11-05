<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'appointment_date',
        'time_slot',
    ];

    // Relationship with Doctor (assuming User model represents doctors)
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Relationship with Patient (assuming User model represents patients)
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

}