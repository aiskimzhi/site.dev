<?php

$rows = 10; // количество строк, tr
$cols = 10; // количество столбцов, td

$table = '<table border="3" rules="all">';

for ($tr=1; $tr<=$rows; $tr++){
    $table .= '<tr style="height: 50px;">';
    for ($td=1; $td<=$cols; $td++){
        if ($tr===1 or $td===1){
            $table .= '<th style="color: white; background-color: green; width: 50px;">'. $tr*$td .'</th>'; // вычислили первую строку или столбец
        }else{
            $table .= '<td align="center">'. $tr*$td .'</td>'; // все ячейки, кроме ячеек из первого столбца и первой строки
        }
    }
    $table .= '</tr>';
}

$table .= '</table>';

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Table</title>
</head>
<body>
<?php
echo $table;
?>
</body>
</html>
