<?php
$subaru = array(
    "brand" => "subaru",
    "model" => "impreza",
    "year" => "2000",
    "speed" => "220"
);
$peugeot = array(
    "brand" => "peugeot",
    "model" => "580",
    "year" => "2014",
    "speed" => "200"
);
$renault = array(
    "brand" => "renault",
    "model" => "sandero",
    "year" => "2013",
    "speed" => "180"
);

foreach($subaru as $key => $value)
{
    echo "$key: $value <br>";
}

//$cars = array($subaru, $peugeot, $renault);
$cars[] = $subaru;
$cars[] = $peugeot;
$cars[] = $renault;


echo "<pre>";
print_r($cars);
echo "</pre>";


//echo $subaru['brand'] . ' ' . $subaru['model'] . ' - отака фигня малята' ;
echo "<br>";

echo "<pre>";
print_r($cars[0]['brand']);
echo "</pre>";

for ($n = 0; $n < 3; $n++) {
    echo "<pre>";
    print_r($cars[$n]['brand'] . "," . " " . $cars[$n]['model'] . "," . " " . $cars[$n]['year'] . "," . " " . $cars[$n]['speed']);
    echo "</pre>";
}

$p = array_reverse($cars, true);
echo "<pre>";
print_r($p);
echo "</pre>";


?>
