<?php
//Устанавливаю соединение
$connection = mysql_connect('localhost', 'root') or die ('Connection Impossible' . mysql_error());

//Переключаю кодировку
mysql_query('SET NAMES utf8') or exit ('Impossible to change charset');

//выбираю БД и таблицу
mysql_select_db('task_db') or die ('Impossible to choose DataBase');
$db_table = 'users';

//фиксируем ИД для редактирования записей по ГЕТ
if (isset($_GET['id'])) {
	$id = $_GET['id'];
}

//присваиваю значения ПОСТА
if (isset($_POST['surname'])) {
	$surname = $_POST['surname'];
}
if (isset($_POST['nam'])) {
	$name = $_POST['nam'];
}
if (isset($_POST['fname'])) {
	$fname = $_POST['fname'];
}

//создаю значения для формы
$valSurname = '';
$valName = '';
$valFname = '';

//удаляем данные по ссылке
if (isset($_GET['action'])
    and $_GET['action'] == 'delete'
) {
	$queryDel = "DELETE FROM " . $db_table . " WHERE id = " . $id;
	mysql_query($queryDel);
}

//выбираю данные для определенного ИД и передаю в форму для апдейта
if (isset($_GET['action'])
    and $_GET['action'] == 'update'
) {
	$choose = "SELECT surname, nam, fname FROM " . $db_table . " WHERE id = " . $id;
	$forUpdate = mysql_query($choose) or die ('Impossible to get data');
	while ($dataUpdate = mysql_fetch_array($forUpdate, MYSQL_ASSOC)) {
		$valSurname = $dataUpdate['surname'];
		$valName = $dataUpdate['nam'];
		$valFname = $dataUpdate['fname'];
	}
}

//заменяю выбранные данные
if (isset($_GET['action'])
    and $_GET['action'] == 'update'
    and isset($_POST['send'])
) {
	$queryUpdate = "UPDATE $db_table SET surname = '$surname', nam = '$name', fname = '$fname' WHERE id = '$id'";
	$doUpdate = mysql_query($queryUpdate) or die ('Impossible to UPDATE');
	$valSurname = '';
	$valName = '';
	$valFname = '';
}

//заношу данные в БД
if (isset($_POST['send'])
    and !empty($_POST['surname'])
    and !empty($_POST['name'])
    and !empty($_POST['fname'])
    and !isset($id)
) {
	$queryInsert = "INSERT INTO $db_table (surname, name, fname) VALUES ('$surname', '$name', '$fname')";
	$insert = mysql_query($queryInsert) or die ('Impossible to insert data');
}

//выбираю все данные из БД
$querySelectAll = "SELECT * FROM " . $db_table;
$selectALL = mysql_query($querySelectAll) or die ('Impossible to select all the data');

//создаю массив с данными таблицы
$i = 0;
while ($allData = mysql_fetch_array($selectALL, MYSQL_ASSOC)) {
	$data[$i] = array('0' => $allData['id'], '1' => $allData['surname'], '2' => $allData['nam'], '3' => $allData['fname']);
	$i++;
}

//считаю количество записей в таблице
$n = count($data);

//Создаю ссылку для удаления и редактирования
for ($d = 0; $d < $n; $d++) {
	$del[$d] = '<a href="http://site.dev/bootstrap/bootstrap.php?action=delete&id=' . $data[$d]['0'] . '">DELETE</a>';
	$up[$d] = '<a href="http://site.dev/bootstrap/bootstrap.php?action=update&id=' . $data[$d]['0'] . '">UPDATE</a>';
}
$href[4] = $up;
$href[5] = $del;

//массив для заголовков таблицы
$head[] = 'ID';
$head[] = 'SURNAME';
$head[] = 'NAME';
$head[] = "FATHER'S NAME";
$head[] = '';
$head[] = '';

$class['surname'] = '';
$class['name'] = '';
$class['fname'] = '';
$label['surname'] = '';
$label['name'] = '';
$label['fname'] = '';

//Создаю сообщения об ошибках
if (isset($_POST['send'])
    and empty($_POST['surname'])
) {
    $label['surname'] = 'ERROR! You did not enter your surname. Do it!';
}
if (isset($_POST['send'])
    and empty($_POST['name'])
) {
   $label['name'] = 'ERROR! You did not enter your name. Do it!';
}
if (isset($_POST['send'])
    and empty($_POST['fname'])
) {
    $label['fname'] = "ERROR! You did not enter your father's name. Do it!";
}

//Оставляю значения для апдейта в полях, заполненных корректно, если есть пустые или некорректно заполеные другие поля
if (isset($_POST['send'])
    and empty($label['name'])
) {
    $valName = $_POST['nam'];
}
if (isset($_POST['send'])
    and empty($label['surname'])
) {
    $valSurname = $_POST['surname'];
}

if (isset($_POST['send'])
    and empty($label['fname'])
) {
    $valFname = $_POST['fname'];
}

//оставляю пустые значения если нет ошибок в заполнении
//можно это всунуть в уже существующие конструкции???
if (isset($_POST['send'])
    and empty($label['name'])
    and empty($label['surname'])
    and empty($label['fname'])
) {
    $valSurname = '';
    $valName = '';
    $valFname = '';
}
echo '<pre>';
print_r($_POST);
echo '</pre>';

?>

<!DOCTYPE html>
<html>
<head>
    <title>I've done it</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap.css">
    <script type="text/javascript" scr="bootstrap.js"></script>
</head>
<body>

<h3>Please, enter your data into the form below</h3>
<br>
<div>
    <form action="" method="post" novalidate="">
        <div class="form-group <?php echo !empty($label['surname']) ? 'has-error' : ''; ?>">
            <label class="control-label" for="sur">Enter your surname: </label>
            <input type="text" name="surname" class="form-control" id="sur" value="<?php echo $valSurname; ?>">
            <label class="control-label" for="sur"><?php echo $label['surname']; ?></label>
        </div>
        <div  class="form-group <?php echo !empty($label['name']) ? 'has-error' : ''; ?>">
            <label class="control-label" for="nam">Enter your name: </label>
            <input type="text" name="nam" class="form-control" id="nam" value="<?php echo $valName; ?>">
            <label class="control-label" for="nam"><?php echo $label['name']; ?></label>
        </div>
        <div class="form-group <?php echo !empty($label['fname']) ? 'has-error' : ''; ?>">
            <label class="control-label" for="fat">Enter your father's name: </label>
            <input type="text" name="fname" class="form-control" id="fat" value="<?php echo $valFname; ?>">
            <label class="control-label" for="fat"><?php echo $label['fname']; ?></label>
        </div>
        <input type="submit" name="send" value="SEND" class="btn btn-success" formnovalidate="">
    </form>
</div>
<br>

<!-- создаю таблицу -->
<div class="table-responsive">
<?php $table = '<table class="table table-striped table-bordered table-hover">'; ?>
<?php $table .= '<tr>'; ?>
    <?php for ($th = 0; $th < 6; $th++) : ?>
        <?php $table .= '<th>' . $head[$th] . '</th>'; ?>
    <?php endfor; ?>
<?php $table .= '</tr>'; ?>
<?php $table .= '<tbody class="table-striped table-bordered table-hover">'; ?>
<?php $table .= '<tr>'; ?>
    <?php for ($tr =  0; $tr < $n; $tr++) : ?>
        <?php for ($td = 0; $td < 4; $td++) : ?>
            <?php $table .= '<td>' . $data[$tr][$td] . '</td>'; ?>
        <?php endfor; ?>
        <?php for ($td = 4; $td < 6; $td++) : ?>
            <?php $table .= '<td>' . $href[$td][$tr] . '</td>'; ?>
        <?php endfor; ?>
        <?php $table .= '</tr>'; ?>
    <?php endfor; ?>
<?php $table .= '</tbody>'; ?>
<?php $table .= '</table>'; ?>
<?php echo $table; ?>
</div>

</body>
</html>
