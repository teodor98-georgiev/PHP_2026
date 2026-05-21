<?php
// given an array of n numbers sort them from lowest to highest and delete eventual duplicating elements
$arr = array(4,9,8,5,2,9,9,3,2);
$min = 0;
// deleting duplicated elements

for ($i = 0; $i < count($arr); $i++){
    for ($j = $i + 1; $j < count($arr); $j++){
        if ($arr[$i] == $arr[$j]){
            array_splice($arr, $j , 1);
            $j--;
        }
    }
}

for ($i = 0; $i < count($arr); $i++){
    for ($j = $i + 1; $j < count($arr); $j++){
        if ($arr[$j] < $arr[$i]){
            $swipe = $arr[$i];
            $arr[$i] = $arr[$j];
            $arr[$j] = $swipe;
        }
    }
}

for ($i = 0; $i < count($arr); $i++){
    echo ($arr[$i]);
}

