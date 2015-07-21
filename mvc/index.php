<?php

if (isset($_POST['search'])) {
    header ('Location: http://site.dev/mvc/controller/controller.php');
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MAIN</title>
</head>
<body>
    <form action="" method="post">
        <input type="submit" name="search" value="SEARCH">
    </form>
</body>
</html>
