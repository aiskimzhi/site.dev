<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/functions.php';

$person = session_name('person');
session_start($person);

if (isset($_POST['button'])) {
    session_unset($person);
    header("Location: http://site.dev/tasks/php/new.php");
}

$data[] = "name";
$data[] = "surname";
$data[] = "middleName";


if (count($_SESSION) !== count($data)) {
    $n = 0;
}

if (isset($_POST['name']) and !empty($_POST['name'])) {
    $_SESSION['name'] = $_POST['name'];
    $n = 1;
}

if (isset($_POST['surname']) and !empty($_POST['surname'])) {
    $_SESSION['surname'] = $_POST['surname'];
    $n = 2;
}
if (isset($_POST['middleName']) and !empty($_POST['middleName'])) {
    $_SESSION['middleName'] = $_POST['middleName'];
    $n = 3;
}



if (isset($_POST['name']) and empty($_POST['name'])) {
    $error = "Enter your name";
    $n = 0;
} elseif (isset($_POST['surname']) and empty($_POST['surname'])) {
    $error = "Enter your surname";
    $n = 1;
} elseif (isset($_POST['middleName']) and empty($_POST['middleName'])) {
    $error = "Enter your father's name";
    $n = 2;
}


?>

<!DOCTYPE html>
    <html>
    <head>
        <title>one form</title>
        <meta charset="UTF-8">
    </head>
    <body>
    <?php if (isset($error)) : ?>
        <h4>Error: <?php echo $error ?></h4>
    <?php endif; ?>


    <?php if ($n < count($data)) : ?>
        <form action="" method="post">
            <p>Enter your <?php echo camelCaseToSpaces($data[$n]) ?>: &nbsp;
                <input type="text" name="<?php echo $data[$n]  ?>"></p>
            <p><input type="submit" value="Далее"></p>
            </form>
    <?php endif ?>

    <?php if (isset($_SESSION['middleName'])) : ?>
        <h5><?php echo "You are " . $_SESSION['surname'] . " " . $_SESSION['name'] . " " . $_SESSION['middleName'] ?></h5>
    <?php endif; ?>


    <form method="post">
        <input type="submit" name="button" value="Очистить все">
    </form>

    </body>
    </html>

<?php

echo "<pre>";
echo "session <br>";
print_r($_SESSION);
echo "<br> post <br>";
print_r($_POST);
echo "<br> get <br>";
print_r($_GET);
echo "<br> data <br>";
print_r($data);
echo "</pre>";
