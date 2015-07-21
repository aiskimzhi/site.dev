<?php

$sname = session_name('sname');
session_start($sname);

// значит и здесь тебе нужно вывести ошибку через гет по переадресации


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Name</title>
</head>
<body>
    <form action="/task_2/form2.php" method="post">
        <p><h3>Enter your name</h3></p>
        <p><input type="text" name="name">
        <p><input type="submit" name="submit" value="NEXT">
    </form>

</body>
</html>


<?php

echo "<pre>";
print_r($_SESSION);
print_r($_POST);
echo "</pre>";

