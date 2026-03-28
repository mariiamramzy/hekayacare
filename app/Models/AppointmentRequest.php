<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentRequest extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'phone',
        'governorate',
        'gender',
        'age',
        'patient_relation',
        'problem_type',
        'problem_specialty',
        'notes',
        'status',
    ];
}
