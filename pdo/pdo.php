<?php

$user = 'root';
$pass = '';

//создаю подсключение к ДБ через PDO
$dsn = "mysql:host=localhost;dbname=task_db;charset=utf8";
$opt = array(
	PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
);
$pdo = new PDO ($dsn, $user, $pass, $opt);

//value для полей формы
$valSurname = '';
$valName = '';
$valFname = '';

//удаляем данные по ссылке
if (isset($_GET['action']) and $_GET['action'] == 'delete') {
	$delete = $pdo->prepare("DELETE FROM users WHERE id = :id");
	$delete->execute(array('id' => $_GET['id']));
}

//Выбираем данные для апдейта
if (isset ($_GET['action']) and $_GET['action'] == 'update') {
	$select = $pdo->prepare("SELECT surname, nam, fname FROM users WHERE id = :id");
	$select->execute(array('id' => $_GET['id']));
	while ($data = $select->fetch()) {
		$valSurname = $data['surname'];
		$valName = $data['nam'];
		$valFname = $data['fname'];
	}
}

//Заменяю выбранные данные
if (isset($_GET['action'])
    && $_GET['action'] == 'update'
    && isset($_POST['send'])
    && !empty($_POST['surname'])
    && !empty($_POST['nam'])
    && !empty($_POST['fname'])
) {
    $update = $pdo->prepare("UPDATE users SET surname = :surname, nam = :nam, fname = :fname WHERE id = :id");
    $update->execute([
        'id' => $_GET['id'],
        'surname' => $_POST['surname'],
        'nam' => $_POST['nam'],
        'fname' => $_POST['fname']
    ]);
    $valSurname = '';
    $valName = '';
    $valFname = '';
}

//заношу данные в БД
if (isset($_POST['send'])
    && !empty($_POST['surname'])
    && !empty($_POST['nam'])
    && !empty($_POST['fname'])
    && !isset($_GET['id'])
) {
    $insert = $pdo->prepare("INSERT INTO users ('surname', 'nam', 'fname') VALUES (:surname, :nam, :fname)");
    $insert->execute(
        [
            'surname' => $_POST['surname'],
            'nam' => $_POST['nam'],
            'fname' => $_POST['fname']
        ]
    );
    $valSurname = '';
    $valName = '';
    $valFname = '';
}
//Создаюмассив для таблицы
$selectAll = $pdo->prepare("SELECT * FROM users");
$selectAll->execute();
$all = $selectAll->fetchAll();

//Создаю заголовки таблицы и добавляю их в массив таблицы
$head = ['id' => 'ID',
    'surname' => 'SURNAME',
    'nam' => 'NAME',
    'fname' => "FATHER'S NAME",
    'del' => 'DELETE',
    'up' => 'UPDATE'
];
array_unshift ($all, $head);

//создаю ссылки для апдейта и делита и добавляю их в массив таблицы
for ($d = 1; $d < count($all); $d++) {
	$del[$d] = '<a href="http://site.dev/pdo/pdo.php?action=delete&id=' . $all[$d]['id'] . '">DELETE</a>';
	$up[$d] = '<a href="http://site.dev/pdo/pdo.php?action=update&id=' . $all[$d]['id'] . '">UPDATE</a>';
}
for ($i = 1; $i < count($all); $i++) {
	$all[$i]['del'] = $del[$i];
	$all[$i]['up'] = $up[$i];
}

//создаю сообщения обошибках
$label['surname'] = '';
$label['nam'] = '';
$label['fname'] = '';
if (isset($_POST['send']) and empty($_POST['surname'])) {
    $label['surname'] = 'ERROR! You did not enter your surname. Do it!';
	$valSurname = '';
}
if (isset($_POST['send']) and empty($_POST['nam'])) {
    $label['nam'] = 'ERROR! You did not enter your name. Do it!';
	$valName = '';
}
if (isset($_POST['send']) and empty($_POST['fname'])) {
    $label['fname'] = "ERROR! You did not enter your father's name. Do it!";
	$valFname = '';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>PDO</title>
    <meta charset="utf-8">
	<link rel="stylesheet" href="bootstrap.css">
    <script type="text/javascript" scr="bootstrap.js"></script>
</head>
<body>

<h3>Please, enter your data into the form below</h3>
<br>
<div>
    <form action="" method="post">
        <div class="form-group <?php echo !empty($label['surname']) ? 'has-error' : ''; ?>">
            <label class="control-label" for="sur">Enter your surname: </label>
            <input type="text" name="surname" class="form-control" id="sur" value="<?php echo $valSurname; ?>">
            <label class="control-label" for="sur"><?php echo $label['surname']; ?></label>
        </div>
        <div  class="form-group <?php echo !empty($label['nam']) ? 'has-error' : ''; ?>">
            <label class="control-label" for="nam">Enter your name: </label>
            <input type="text" name="nam" class="form-control" id="nam" value="<?php echo $valName; ?>">
            <label class="control-label" for="nam"><?php echo $label['nam']; ?></label>
        </div>
        <div class="form-group <?php echo !empty($label['fname']) ? 'has-error' : ''; ?>">
            <label class="control-label" for="fat">Enter your father's name: </label>
            <input type="text" name="fname" class="form-control" id="fat" value="<?php echo $valFname; ?>">
            <label class="control-label" for="fat"><?php echo $label['fname']; ?></label>
        </div>
        <input type="submit" name="send" value="SEND" class="btn btn-success">
    </form>
</div>
<br>


<?php $table = '<table class="table table-striped table-bordered table-hover">'; ?>
		<?php $table .= '<tr class="success">'; ?>
			<?php $table .= '<th>' . $all[0]['id'] . '</th>'; ?>
			<?php $table .= '<th>' . $all[0]['surname'] . '</th>'; ?>
			<?php $table .= '<th>' . $all[0]['nam'] . '</th>'; ?>
			<?php $table .= '<th>' . $all[0]['fname'] . '</th>'; ?>
			<?php $table .= '<th>' . $all[0]['del'] . '</th>'; ?>
			<?php $table .= '<th>' . $all[0]['up'] . '</th>'; ?>
		<?php $table .= '</tr>'; ?>
	<?php for ($tr = 1; $tr < count($all); $tr++) : ?>
		<?php $table .= '<tr>'; ?>
			<?php $table .= '<td>' . $all[$tr]['id'] . '</td>'; ?>
			<?php $table .= '<td>' . $all[$tr]['surname'] . '</td>'; ?>
			<?php $table .= '<td>' . $all[$tr]['nam'] . '</td>'; ?>
			<?php $table .= '<td>' . $all[$tr]['fname'] . '</td>'; ?>
			<?php $table .= '<td>' . $all[$tr]['del'] . '</td>'; ?>
			<?php $table .= '<td>' . $all[$tr]['up'] . '</td>'; ?>
		<?php $table .= '</tr>'; ?>
	<?php endfor;?>
<?php $table .= '</table>'; ?>
<?php echo $table; ?>

</body>
</html>
