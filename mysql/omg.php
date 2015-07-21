<?php
//Устанавливаю соединение
$connection = mysql_connect('localhost', 'root') or die ('Connection Impossible' . mysql_error());

//Переключаю кодировку
mysql_query('SET NAMES utf8') or exit ('Impossible to change charset');

//выбираю БД и таблицу
mysql_select_db('task_db') or die ('Impossible to choose DataBase');
$db_table = 'table_1';

//фиксируем ИД для редактирования записей по ГЕТ
if (isset ($_GET['id'])) {
	$id = $_GET['id'];
}

//присваиваю значения ПОСТА
if (isset ($_POST['surname']) and !empty ($_POST['surname'])) {
	$surname = $_POST['surname'];
}
if (isset ($_POST['name']) and !empty ($_POST['name'])) {
	$name = $_POST['name'];
}
if (isset ($_POST['fname']) and !empty ($_POST['fname'])) {
	$fname = $_POST['fname'];
}


//создаю значения для формы
$valSurname = '';
$valName = '';
$valFname = '';


//объединяю делит и апдейт в один цикл
if (isset($_GET['action'])) {
	if ($_GET['action'] == 'delete') {
	$queryDel = "DELETE FROM $db_table WHERE id = '$id'";
	mysql_query($queryDel);
	}
	if ($_GET['action'] == 'update') {
	$choose = "SELECT surname, name, fname FROM $db_table WHERE id = '$id'";
	$forUpdate = mysql_query($choose) or die ('Impossible to get data');
	while ($dataUpdate = mysql_fetch_array($forUpdate, MYSQL_ASSOC)) {
		$valSurname = $dataUpdate['surname'];
		$valName = $dataUpdate['name'];
		$valFname = $dataUpdate['fname'];
		}
	}
	if ($_GET['action'] == 'update' and isset($_POST['send']) and isset($surname) and isset($name) and isset($fname)) {
	$queryUpdate = "UPDATE $db_table SET surname = '$surname', name = '$name', fname = '$fname' WHERE id = '$id'";
	$doUpdate = mysql_query($queryUpdate) or die ('Impossible to UPDATE');
	$valSurname = '';
	$valName = '';
	$valFname = '';
	}	
}

//заношу данные в БД
if (isset($_POST['send']) and isset($surname) and isset($name) and isset($fname) and !isset($id)) {
	$queryInsert = "INSERT INTO $db_table (surname, name, fname) VALUES ('$surname', '$name', '$fname')";
	$insert = mysql_query($queryInsert) or die ('Impossible to insert data');
}

//выбираю все данные из БД
$querySelectAll = "SELECT * FROM $db_table";
$selectALL = mysql_query($querySelectAll) or die ('Impossible to select all the data');

//создаю массив с данными таблицы
$result = array();
while ($allData = mysql_fetch_assoc($selectALL/*, MYSQL_ASSOC*/)) {

	$allData['delete'] = '<a href="http://site.dev/mysql/corrected_file.php?action=delete&id=' 
	. $allData['id'] . '">DELETE</a>';
	$allData['update'] = '<a href="http://site.dev/mysql/corrected_file.php?action=update&id='
	. $allData['id'] . '">update</a>';
	
	$data[] = $allData;
}
$keys = array_keys($data[0]);

//перед вставкой в массив ключей ты можешь перевести их строки в верхний регистр или хз
array_unshift($data, $keys);

?>

<!DOCTYPE html>
<html>
<head>
    <title>OMG</title>
    <meta charset="utf-8">
</head>
<body>

<br><br><br>
    <form action="" method="post">
        Enter your surname: <input type="text" name="surname" value="<?php echo $valSurname; ?>"><br>
        Enter your name: <input type="text" name="name" value="<?php echo $valName; ?>"><br>
        Enter your father's name: <input type="text" name="fname" value="<?php echo $valFname; ?>"><br>
        <h1><input type="submit" name="send" value="SEND"></h1>
    </form>
</body>
</html>
