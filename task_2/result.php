<?php


$sname = session_name('sname');
session_start($sname);

if (isset($_POST['fname']) and !empty($_POST['fname'])) {
    $_SESSION['fname'] = $_POST['fname'];
} elseif (isset($_SESSION['fname'])) {
    header("Location: http://site.dev/task_2/result.php");
} else {
    header("Location: http://site.dev/task_2/form3.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Result</title>
</head>
<body>
    <h3><?php
    echo "You are " . $_SESSION['surname'] . " " . $_SESSION['name'] . " " . $_SESSION['fname'];
        ?></h3>
    <form action="/task_2/form1.php" method="post">
        <input type="submit" value="CLEAR">
    </form>
</body>
</html>
