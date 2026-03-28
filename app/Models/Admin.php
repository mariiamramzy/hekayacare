<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Admin extends Authenticatable implements CanResetPasswordContract
{
    use LogsActivity;
    use CanResetPassword;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'admin_role');
    }

    public function hasRole(string $roleName): bool
    {
        if ($this->relationLoaded('roles')) {
            return $this->roles->contains(fn (Role $role) => $role->name === $roleName);
        }

        return $this->roles()->where('name', $roleName)->exists();
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super_admin');
    }

    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
