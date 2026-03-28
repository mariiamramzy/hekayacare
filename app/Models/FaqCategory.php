<?php

namespace App\Models;

use App\Models\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'sort_order',
    ];

    public function faqs(): BelongsToMany
    {
        return $this->belongsToMany(Faq::class, 'faq_category_faq');
    }
}
