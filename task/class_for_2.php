<?php

class MyClass
{
    public function zeroMod ($inf, $sup, $mod)
    {
        $i = $inf;
        while ($inf <= $sup) {
            if (fmod($inf, $mod) == 0) {
                $zeroMod[] = $inf;
            }
            $inf++;
        }
        if (isset($zeroMod)) {
            return $zeroMod;
        } else {
            return 'ERROR! There are no numbers between ' . $i . ' and ' . $sup . ' divisible by ' . $mod;
        }
    }
}