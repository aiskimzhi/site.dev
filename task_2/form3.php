<?php

$sname = session_name('sname');
session_start($sname);

if (isset($_POST['surname']) and !empty($_POST['surname'])) {
    $_SESSION['surname'] = $_POST['surname'];
} elseif (isset($_SESSION['surname'])) {
    // проверяем существование сюрнейма и значение ошибки из result.php и если есть - выводим ошибку
    // запихнув ее в переменную $displayError
} else {
    $error = urlencode('fill out form 2');
    header("Location: http://site.dev/task_2/form2.php?error=" . $error);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Father's name</title>
</head>
<body>

<?php if (isset($displayError)) : ?>
    <h3>Error: <?php echo $displayError ?></h3>
<?php endif; ?>

<form action="/task_2/result.php" method="post">
    <p><h3>Enter your father's name</h3></p>
    <p><input type="text" name="fname">
    <p><input type="submit" name="submit" value="NEXT">

</form>
</body>
</html>




<?php

echo "<pre>";
print_r($_SESSION);
print_r($_POST);
echo "</pre>";
