<?php

$sname = session_name('sname');
session_start($sname);

if (isset($_POST['name']) and !empty($_POST['name'])) {
    $_SESSION['name'] = $_POST['name'];
} elseif (isset($_SESSION['name']) && !empty($_SESSION['name']) && isset($_GET['error'])) {
    $displayError = $_GET['error'];
} else {
    header("Location: http://site.dev/task_2/form1.php");
}

//session_unset();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Surname</title>
</head>
<body>

<?php if (isset($displayError)) : ?>
    <h3>Error: <?php echo $displayError ?></h3>
<?php endif; ?>

<form action="/task_2/form3.php" method="post">

    <p><h3>Enter your surname</h3></p>
    <p><input type="text" name="surname">
    <p><input type="submit" name="submit" value="NEXT">

</form>
</body>
</html>




<?php

echo "<pre>";
print_r($_SESSION);
print_r($_POST);
echo "</pre>";
