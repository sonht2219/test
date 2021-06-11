<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Manufacturer
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Manufacturer query()
 * @mixin \Eloquent
 */
class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'status'
    ];
}
