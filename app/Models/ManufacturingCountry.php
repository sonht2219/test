<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ManufacturingCountry
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ManufacturingCountry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManufacturingCountry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ManufacturingCountry query()
 * @mixin \Eloquent
 */
class ManufacturingCountry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'status'
    ];
}
