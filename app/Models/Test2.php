<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
