<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
