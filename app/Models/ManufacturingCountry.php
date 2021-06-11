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
 * @property int $id
 * @property string $name
 * @property int $status 1: Active. -1: Inactive.
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ManufacturingCountry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManufacturingCountry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManufacturingCountry whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManufacturingCountry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ManufacturingCountry whereUpdatedAt($value)
 */
class ManufacturingCountry extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'status'
    ];
}
