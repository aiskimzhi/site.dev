<?php
/*
 * Разработайте программу, которая из чисел 20..45 находила те, которые делятся на 5 и найдите сумму этих чисел.
 */

include 'class_for_2.php';

$a = 20;
$b = 26;
$c = 7;

$obj = new myClass();

$n = $obj->zeroMod($a, $b, $c);

if (is_array($n)) {
    $p = array_sum($n);
    echo '<br>' . $p . '<br>';
}
