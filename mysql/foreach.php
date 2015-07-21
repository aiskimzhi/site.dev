<?php
$a[] = 0;
$a[] = 1;
$a[] = 2;
$a[] = 3;
$a[] = 4;

$b = array ('zero', 'one', 'two', 'three', 'four');

$c['1']['1'] = 11;
$c['1']['2'] = 12;
$c['2']['1'] = 21;
$c['2']['2'] = 22;

echo '<h3>' . "$" . "a array" . '</h3>';
foreach ($a as $key => $value) {
echo "Key: " . $key . "; Value: " . $value . '<br>';
}
echo '<br>';

echo '<h3>' . "$" . "b array" . '</h3>';
foreach ($b as $key => $value) {
echo "Key: " . $key . "; Value: " . $value . '<br>';
}

echo '<br>' . "$" . "c ARRAY" . '<br>';
foreach ($c as $v) {
	foreach ($v as $i) {
	echo $i . '<br>';
	}
}

echo '<pre>';
print_r($c);
echo '</pre>';

?>