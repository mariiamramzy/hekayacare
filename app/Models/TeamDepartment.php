<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class TeamDepartment extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'sort_order',
    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(TeamMember::class, 'team_department_member');
    }
}
