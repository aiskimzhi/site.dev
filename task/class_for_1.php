<?php

class MyClass
{
    public static $i = 0;

    public function degree ($a, $b)
    {
        $n[0] = 1;
        for ($i = 1; $i <= $b; $i++) {
            $n[$i] = $a * $n[$i - 1];
        }
        return $n[$b];
    }

    public function numSum ($a)
    {
        $i = 0;
        while ($a > self::degree(10, $i)) {
            $b = self::degree(10, $i);
            $k[$i] = $b;
            $i++;
        }
        $q = count($k) - 1;
        $y = $q - 1;
        for ($r = $q; $r >= 0; $r--) {
            $ar[$r] = floor($a / self::degree(10, $r));
        }
        for ($z = $y; $z >=0; $z--) {
            $x[$q] = $ar[$q];
            $x[$z] = $ar[$z] - (10 * $ar[$z + 1]);
        }
        $sum = array_sum($x);
        return $sum;
    }
}