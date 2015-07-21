<?php
/*
$ar1 = array('color' => array('favorite' => 'red'), 5);
$ar2 = array(10, 'color' => array('favorite' => 'green', 'blue'));
echo '<pre>';
print_r ($ar1);
echo '</pre>';

echo '<pre>';
print_r ($ar2);
echo '</pre>';

$result = array_merge_recursive($ar1, $ar2);
echo '<pre>';
print_r($result);
echo '</pre>';
*/

$n = array ('id' => 'id1', 'surname' => 'surname1', 'name' => 'name1', 'fname' => 'fname1', 'del' => 'del1', 'up' => 'up1');
$m = array ('id' => 'id2', 'surname' => 'surname2', 'name' => 'name2', 'fname' => 'fname2', 'del' => 'del2', 'up' => 'up2');
$all = array($n, $m);
echo '<pre>';
print_r($all);
echo '</pre>';

$a = 'A';
$b = 'B';
$c = 'C';
$d = 'D';
?>
<!DOCTYPE HTML>
<head>
	<title>WTF?!</title>
	<meta charset="utf-8">
</head>
<body>

<?php $table = '<table>'; ?>
	<?php for ($t = 0; $t < count($all); $t++) : ?>
		<?php $table .= '<tr>'; ?>
			<?php $table .= '<td>' . $all[$t]['id'] . '</td>'; ?>
			<?php $table .= '<td>' . $all[$t]['up'] . '</td>'; ?>
		<?php $table .= '</tr>'; ?>
	<?php endfor; ?>
<?php $table .= '</table>'; ?>
<?php echo $table; ?>

</body>
</html>






