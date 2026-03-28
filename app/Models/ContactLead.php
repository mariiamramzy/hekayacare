<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactLead extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'mobile',
        'message',
    ];
}
