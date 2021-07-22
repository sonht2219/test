<?php


namespace App\Models;


class Test3 extends Model
{
    public function test() {
        $a = 1;
        $b = 2;
        if ($a == $b) {
            return 3;
        }
        return 4;
    }
}
