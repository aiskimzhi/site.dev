<?php

$table = "<table>";
for ($rows = 1; $rows < 11; $rows++) {
    $table .= "<tr>";
    for ($cols = 1; $cols < 11; $cols++) {
        if ($cols == 1 || $rows == 1) {
            $t = "th";
        } else {
            $t = "td";
        }
        $table .= "<" . $t . ">";
        $table .= $rows * $cols;
        $table .= "</" . $t .">";
    }
    $table .= "</tr>";
}
$table .= "</table>";
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Multiply table</title>
    <meta charset="UTF-8">
    <link href="table.css" rel="stylesheet">
</head>
<body>

<?php echo $table; ?>
</body>
</html>