<?php


namespace App\Http\Controllers;


class TestController extends Controller
{
    public function dev2() {
        $a = 2;
        $b = 3;
        if ($a == $b) {
            return 2;
        } else {
            return 3;
        }
    }
}
