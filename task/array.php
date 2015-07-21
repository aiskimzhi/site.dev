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
$arr = [$subaru, $peugeot, $renault];
echo "<p>", $arr[0]['brand'], " : ", $arr[0]['speed'], "</p>";
