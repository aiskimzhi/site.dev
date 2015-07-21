<?php

$sname = session_name('sname');
session_start($sname);

include 'class_for_log_in.php';

echo '<pre> POST: ';
print_r($_POST);
echo '</pre>';

$new = new User();

if (isset($_POST['send'])
    && isset($_POST['email'])
    && empty($_POST['email'])
) {
    echo 'ERROR! Enter your email! <br>';
}

if (isset($_POST['send'])
    && isset($_POST['pass'])
    && empty($_POST['pass'])
) {
    echo 'ERROR! Enter a password! <br>';
}

if (isset($_POST['send'])
    && isset($_POST['repeatedPass'])
    && empty($_POST['repeatedPass'])
) {
    echo 'ERROR! Repeate your password! <br>';
}

if (isset($_POST['send'])
    && isset($_POST['email']) && !empty($_POST['email'])
    && isset($_POST['pass']) && !empty($_POST['pass'])
    && isset($_POST['repeatedPass']) && !empty($_POST['repeatedPass'])
) {
    $new->asign($_POST['email'], $_POST['pass'], $_POST['repeatedPass']);
//    echo 'E-mail: ' . $new->email . '<br>';
//    echo 'Pass: ' . $new->pass . '<br>';
//    echo 'repeated Pass: ' . $new->repeatPass . '<br>';

    $a = $new->insert();

    if ($a) {
        $new->login();
    }


}


$selectAll = $new->selectAll();



?>

<!DOCTYPE HTML>
<head>
    <title>SIGN UP</title>
    <meta charset="UTF-8">
</head>
<body>
    <form action="" method="post">
        <br><br>
        <b>SIGN UP</b><br>
        Enter your e-mail: <input type="text" name="email"><br>
        Enter password: <input type="text" name="pass"><br>
        Confirm your password: <input type="text" name="repeatedPass"><br>
        <input type="submit" name="send" value="SIGN UP">
    </form>
</body>
