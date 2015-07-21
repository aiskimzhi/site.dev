<?php

$sname = session_name('sname');
session_start($sname);

include "class_for_log_in.php";
$new = new User();
//session_unset();
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {
    header('Location: http://site.dev/LogIn/index.html');
}

echo '<pre>';
print_r($_SESSION);
echo '</pre>';

if (isset($_POST['logout'])) {
    $new->logOut();
}

?>


<!DOCTYPE HTML>
<head>
    <title>Entered site</title>
    <meta charset="UTF-8">
</head>
<body>
<br>

<form action="" method="post">
    Enter: <input type="text" name="email"><br>

    <input type="submit" name="send" value="OK">

    <p><input type="submit" name="logout" value="LOG OUT"></p>
</form>
</body>
