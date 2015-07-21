<?php

function camelCaseToSpaces ($string) {
    $string = preg_replace('/(?<=\\w)(?=[A-Z])/'," $1", $string);
    $string = strtolower(trim($string));
    return $string;
}

if (isset($_POST['clear'])) {
    session_unset($person);
    header("Location: http://site.dev/tasks/php/form.php");
}

$data[] = "name";
$data[] = "surname";
$data[] = "middleName";

$i = 2;

?>

<!DOCTYPE html>
<html>
<head>
    <title>One more try</title>
    <meta charset="UTF-8">
</head>
<body>
<?php if (isset($_POST[$data[$i]]) and empty($_POST[$data[$i]])) : ?>
    <h4>Error: Enter your <?php echo camelCaseToSpaces($data[$i]) ?></h4>
<?php endif; ?>

<?php if ($i < count($data)) : ?>
    <form action="" method="post">
        <p>Enter your <?php echo camelCaseToSpaces($data[$i]) ?>: <input type="text" name="<?php echo $data[$i] ?>"></p>
        <p><input type="submit" name="next" value="NEXT"></p>
    </form>
<?php endif ?>

    <form method="post">
        <input type="submit" name="clear" value="Clear All">
    </form>
</body>
</html>

<?php

echo "<pre>";

echo "<br> post <br>";
print_r($_POST);
echo "<br> get <br>";
print_r($_GET);
echo "<br> data <br>";
print_r($data);
echo "</pre>";
