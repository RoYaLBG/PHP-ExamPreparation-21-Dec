<?php
$ar1 = array("Gosho", "Pesho", "Pesho", "Osman");
$ar2 = array(1, 2, 3, 4);

array_multisort($ar1, SORT_DESC, $ar2);


$a = ["A", 'a', "B", "C"];
function myf($e) {
    return $e . "__";
}
$a = array_map('myf', $a);
var_dump($a);