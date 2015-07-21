<?php
//$age;
	if (isset($_POST['age'])) {
		$age = $_POST['age'];
	} else {
		$age = "";
	}
	
//check
		switch ($age) {
			case ($age >= 18 and $age <= 59):
				$message = "��� ��� �������� � ��������";
				break;
			case ($age > 0 and $age < 18):
				$message =  "��� ��� ���� ��������";
				break;
			case ($age > 59):
				$message = "��� ���� �� ������";
				break;
			case ($age < 1):
				$message = "����������� �������";
				break;
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
