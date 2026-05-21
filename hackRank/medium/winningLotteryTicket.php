<?php
$n = 5;
$str1 = "129300455";
$str2 = "5559948277";
$str3 = "012334556";
$str4 = "56789";
$str5 = "123456789";

$arrContaineer = [];

// split each str into single string and transform it in a number
$strSplit1 = str_split($str1);
$strSplit2 = str_split($str2);
$strSplit3 = str_split($str3);
$strSplit4 = str_split($str4);
$strSplit5 = str_split($str5);

$subArr = [];
for ($i = 0; $i < count($strSplit1); $i++) {
    $subArr[] = (int)$strSplit1[$i];

}
$arrContaineer[] = $subArr;

$subArr = [];
for ($i = 0; $i < count($strSplit2); $i++) {
    $subArr[] = (int)$strSplit2[$i];

}
$arrContaineer[] = $subArr;

$subArr = [];
for ($i = 0; $i < count($strSplit3); $i++) {
    $subArr[] = (int)$strSplit3[$i];

}
$arrContaineer[] = $subArr;

$subArr = [];
for ($i = 0; $i < count($strSplit4); $i++) {
    $subArr[] = (int)$strSplit4[$i];

}
$arrContaineer[] = $subArr;


$subArr = [];
for ($i = 0; $i < count($strSplit5); $i++) {
    $subArr[] = (int)$strSplit5[$i];

}
$arrContaineer[] = $subArr;


// bitmask operation
$bitArrContainer = [];

for ($i = 0; $i < count($arrContaineer); $i++) {
    $currArr = $arrContaineer[$i];
    $innerBits = [];
    for ($j = 0; $j <= 9; $j++) {
        if (in_array($j,$currArr,true)){
            $innerBits[] = 1;
        }
        else {
            $innerBits[] = 0;
        }
    }
    $bitArrContainer[] = $innerBits;
}

// oring operation to check if each couple of bit sequence in birArrContaineer gives as result 1111111111, if yes is a winning pair
$winningPairs = 0;
for ($i = 0; $i < count($bitArrContainer); $i++) {
    for ($j = $i + 1; $j < count($bitArrContainer); $j++) {
        $bitAsInt1 = bindec(implode("",$bitArrContainer[$i]));
        $bitAsInt2 = bindec(implode("",$bitArrContainer[$j]));
        $result = $bitAsInt1 | $bitAsInt2;
        if ($result == 1023){
            $winningPairs++;
        }

    }
}
echo $winningPairs;






