<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'file_number',
        'case_manager_name',
        'case_manager_phone',
        'center_name',
        'supervisor_name',
        'addiction_type',
        'psychiatric_diagnosis',
        'admission_date',
        'discharge_date',
        'status',
        'gender',
        'age',
        'phone',
        'emergency_contact_name',
        'emergency_contact_phone',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'admission_date' => 'date',
            'discharge_date' => 'date',
            'age' => 'integer',
        ];
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by');
    }
}
