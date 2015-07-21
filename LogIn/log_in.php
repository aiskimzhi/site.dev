<?php

$sname = session_name('sname');
session_start($sname);

include 'class_for_log_in.php';

$new = new User();

if (isset($_POST['send'])) {
    if (empty($_POST['email']) || empty($_POST['pass'])) {
        echo "You didn't enter e-mail or password <br>";
    }
}

if (isset($_POST['send'])
    && !empty($_POST['email'])
    && !empty($_POST['pass'])
) {
    //$_POST['repeatedPass'] = '';

    $new->asign($_POST['email'], $_POST['pass']);
    //echo $new->email;
    $new->login();

    var_dump($new->errors);

}
?>

<!DOCTYPE HTML>
<head>
    <title>LOG IN</title>
    <meta charset="UTF-8">
</head>
<body>
<br>
LOG IN
    <form action="" method="post">
        Enter your e-mail: <input type="email" name="email"><br>
        Enter password: <input type="password" name="pass"><br>

        <input type="submit" name="send" value="LOG IN">
    </form>
</body>
