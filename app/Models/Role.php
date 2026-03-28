<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'name',
        'label',
    ];

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(Admin::class, 'admin_role');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
