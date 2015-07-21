<?php
/*
 * Вам нужно разработать программу, которая считала бы сумму цифр числа введенного пользователем.
 * Например: есть число 123, то программа должна вычислить сумму цифр 1, 2, 3, т. е. 6.
 * По желанию можете сделать проверку на корректность введения данных пользователем.
 */

include 'class_for_1.php';

if (isset($_POST['num'])) {
    $num = $_POST['num'];
}

if (!strrpos($num, '.')
    && !strrpos($num, ',')
    && is_numeric($num)
) {
    $nu = (int)$num;
} else {
    echo 'ERROR! You have to enter an integer!';
}

if (isset($nu)) {
    $new = new MyClass();
    $n = $new->numSum($nu);
    echo 'The sum is: ' . $n;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Number sum</title>
</head>
<body>

<form action="" method="post">
    Enter a number: <input type="text" name="num"><br>
    <input type="submit" name="send" value="SEND">
</form>

</body>
</html>
