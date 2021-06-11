<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Test2
 *
 * @property int $id
 * @property int $test_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Test2 newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test2 newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Test2 query()
 * @method static \Illuminate\Database\Eloquent\Builder|Test2 whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test2 whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test2 whereTestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Test2 whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Test2 extends Model
{
    use HasFactory;

    public function toArray()
    {
        $result = parent::toArray();
        $result['ssss'] = 's';
        return $result;
    }
}
