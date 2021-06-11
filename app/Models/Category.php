<?php

namespace App\Models;

use App\Enums\CommonStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $slug
 * @property string $title
 * @property int|null $parent_id
 * @property string|null $path
 * @property int $status 1: Active. -1: Inactive.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Category[] $children
 * @property-read int|null $children_count
 * @property-read Category|null $parent
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category wherePath($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'parent_id',
        'path',
        'status'
    ];

    public function parent(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function children(): HasMany {
        return $this->hasMany(Category::class, 'parent_id')
            ->where('status', CommonStatus::ACTIVE);
    }

    public function level(): int {
        return count(explode('.', $this->path));
    }
}
