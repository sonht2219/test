<?php

namespace App\Models;

use App\Enums\CommonStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'parent_id',
        'status'
    ];

    public function parent(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function children(): HasMany {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('status', CommonStatus::ACTIVE);
    }
}
