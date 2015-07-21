<?php 
//$age;
	if (isset($_POST['age'])) {
		$age=$_POST['age'];
	} else {
		$age="";
	}

	if ($age >= 18 and $age <= 59) {
		$message = "Вам еще работать и работать";
	} elseif ($age >= 1 and $age < 18) {
		$message =  "Вам еще рано работать";
	} elseif ($age > 59) {
		$message = "Вам пора на пенсию";
	} else {
		$message = "Неизвестный возраст";
	}
	
	
	
	
?>

<!DOCTYPE html>
<html>
<head>
        <title>Exercise 1</title>
</head>
<body>
	<form action="" method="post">
		<p>Enter your age <input type="text" name="age"></p>
		<p><input type="submit" name="send"></p>
	</form>
	
	<h3><?php echo $message ?></h3>

</body>
</html>