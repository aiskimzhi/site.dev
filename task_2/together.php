<?php



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form SNF</title>
</head>
<body>
<form action="" method="post">
    <p><h3>Enter your name</h3></p>
    <p><input type="text" name="name">
    <p><input type="submit" name="submit" value="NEXT">
</form>
<form action="" method="post">

    <p><h3>Enter your surname</h3></p>
    <p><input type="text" name="surname">
    <p><input type="submit" name="submit" value="NEXT">

</form>
<form action="" method="post">
    <p><h3>Enter your father's name</h3></p>
    <p><input type="text" name="fname">
    <p><input type="submit" name="submit" value="NEXT">

</form>
<h3><?php echo "You are " . $_SESSION['surname'] . " " . $_SESSION['name'] . " " . $_SESSION['fname']; ?></h3>
<form action="" method="post">
    <input type="submit" value="CLEAR">
</form>
</body>
</html>
