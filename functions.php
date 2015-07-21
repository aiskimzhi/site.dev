<?php

function camelCaseToSpaces ($string) {
    $string = preg_replace('/(?<=\\w)(?=[A-Z])/'," $1", $string);
    $string = strtolower(trim($string));
    return $string;
}


