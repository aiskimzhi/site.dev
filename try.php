<?php
$rows = 9; // объявляем количество строк.
$cols = 9; // объявляем количество столбцов.

print "<table border='1'>";
for ($tr=1; $tr <= $rows; $tr++):
    print "<tr>";
    for($td=1; $td<=$cols; $td++):
        print "<td>row: {$tr} col: {$td}</td>";
    endfor;
    print "</tr>";
endfor;
print "</table>";
?>
