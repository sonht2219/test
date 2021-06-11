<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Test
 *
 * @property int $id
 * @property string $expired
 * @property int $user_id
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Test2[] $test2s
 * @property-read int|null $test2s_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Test newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test query()
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereExpired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test whereUserId($value)
 * @mixin \Eloquent
 */
class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'expired', 'user_id', 'status'
    ];

    public function toArray()
    {
        $result = parent::toArray();
        $result['test2s'] = $result['test2s'] ?? null;
        return $result;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function test2s() {
        return $this->hasMany(Test2::class);
    }
}
