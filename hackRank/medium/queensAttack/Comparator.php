<?php

namespace queensAttack;
class Comparator
{

    public function __construct()
    {
    }

    function isEqual($x, $y) {
        if ($x === $y){
            return true;
        }
        return false;
    }
}