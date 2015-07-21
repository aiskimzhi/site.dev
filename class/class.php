<?php

define('DEBUG', true);
class users extends PDO
{
    protected $errors = array();
    protected  $queries = array();

    public static function tableName ()
    {
        return 'users';
    }

    public function __construct()
    {
        $user = 'root';
        $pass = '';
        $dsn = "mysql:host=localhost;dbname=task_db;charset=utf8";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        parent::__construct($dsn, $user, $pass, $opt);
        echo 'CONNECTION DONE! <br>';
    }

    public function selectAll ()
    {
        $selectALL = self::prepare("SELECT * FROM " . self::tableName());
        $selectALL->query();
        return $selectALL->fetchAll();
    }

    public function query ($query)
    {
        if (DEBUG) {
            $this->queries[] = $query;
        }
        if (DEBUG and ($error = mysql_error())) {
            $this->errors[] = $error;
        }
        $result = PDOStatement::execute($query);
        var_dump('bla bla bla');
        return $result;
    }

    public function delete($id)
    {
        if (isset($_GET['action'])
            && $_GET['action'] == 'delete'
        ) {
            $d = $this->prepare("DELETE FROM " . self::tableName() . " WHERE id = :id");
            $d->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $d->hujnia();
            //header('Location: http://site.dev/class/class.php');
            //return $d->rowCount();
        }
        return false;
    }

    public function selectForUpdate($id)
    {
        if (isset($_GET['action'])
            && $_GET['action'] == 'update'
        ) {
            $s = $this->prepare("SELECT surname, nam, fname FROM " . self::tableName() . " WHERE id = :id");
            $s->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $s->execute();
            while ($data = $s->fetch()) {
                $valSurname = $data['surname'];
                $valName = $data['nam'];
                $valFname = $data['fname'];
                $q = [$valSurname, $valName, $valFname];
            }
            return $q;
        }
        return false;
    }

    public function updateById ($id)
    {
        if (isset($_GET['action'])
            && $_GET['action'] == 'update'
            && isset($_POST['send'])
            && !empty($_POST['nam'])
            && !empty($_POST['surname'])
            && !empty($_POST['fname'])
        ) {
            $u = $this->prepare("UPDATE users SET surname = :surname, nam = :nam, fname = :fname WHERE id = :id");
            return $u->execute(
                [
                    'surname' => $_POST['surname'],
                    'nam' => $_POST['nam'],
                    'fname' => $_POST['fname'],
                    'id' => $_GET['id']
                ]
            );

        }
        return false;
    }

    public function insert ()
    {
        if (isset($_POST['send'])
            && !empty($_POST['surname'])
            && !empty($_POST['nam'])
            && !empty($_POST['fname'])
            && !isset($_GET['id'])
        ) {
            $i = $this->prepare("INSERT INTO " . self::tableName() . "(surname, nam, fname) VALUES (:surname, :nam, :fname)");
            return $i->execute(
                [
                    'surname' => $_POST['surname'],
                    'nam' => $_POST['nam'],
                    'fname' => $_POST['fname']
                ]
            );
        }
        return false;
    }



}

//значения для формы
$valSurname = '';
$valName = '';
$valFname = '';

echo '<pre> GET: ';
print_r($_GET);
echo '</pre>';
echo '<pre> POST: ';
print_r($_POST);
echo '</pre>';
$new = new users;
echo $new->tableName() . '<br>';

//выбираю ID, с которым буду работать
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}

//выбираю данне для апдейта и меняю значения формы
$a = $new->selectForUpdate($id);
if (!empty($a)) {
    echo '$a is !empty';
    $valSurname = $a[0];
    $valName = $a[1];
    $valFname = $a[2];
}

//делаю апдейт
$b = $new->updateById($id);
if ($b == 1) {
    header("Location: http://site.dev/class/class.php");
    $valSurname = '';
    $valName = '';
    $valFname = '';
}

//вношу данные
$c = $new->insert();

//удаляю данные
$d = $new->delete($id);

//вытаскиваю всю базу
$all = $new->selectAll();

//Создаю заголовки таблицы и добавляю их в массив таблицы
$head = ['id' => 'ID',
    'surname' => 'SURNAME',
    'nam' => 'NAME',
    'fname' => "FATHER'S NAME",
    'bdel' => 'DELETE',
    'up' => 'UPDATE'
];
array_unshift ($all, $head);

//создаю ссылки для апдейта и делита и добавляю их в массив таблицы
for ($t = 1; $t < count($all); $t++) {
    $del[$t] = '<a href="http://site.dev/class/class.php?action=delete&id=' . $all[$t]['id'] . '">DELETE</a>';
    $up[$t] = '<a href="http://site.dev/class/class.php?action=update&id=' . $all[$t]['id'] . '">UPDATE</a>';
}
for ($m = 1; $m < count($all); $m++) {
    $all[$m]['del'] = $del[$m];
    $all[$m]['up'] = $up[$m];
}
/*
echo '<pre>';
echo 'Unshift: ';
print_r($all);
echo '</pre>';
*/

//создаю сообщения об ощибках
$label['surname'] = '';
$label['nam'] = '';
$label['fname'] = '';

if (isset($_POST['send'])
    and empty($_POST['surname'])
) {
    $label['surname'] = 'ERROR! ENTER YOUR SURNAME!';
}
if (isset($_POST['send'])
    and empty($_POST['nam'])
) {
    $label['nam'] = 'ERROR! ENTER YOUR NAME!';
}
if (isset($_POST['send'])
    and empty($_POST['fname'])
) {
    $label['fname'] = 'ERROR! ENTER YOUR FATHERS NAME!';
}


?>

<DOCTYPE HTML>
<html>
<head>
    <title>Class work</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap.css">
    <script type="text/javascript" scr="bootstrap.js"></script>
</head>
<body>
    <form action="" method="post">
        <div class="form-group <?php echo !empty($label['surname']) ? 'has-error' : ''; ?>">
            <label class="control-label" for="sur">Enter your surname: </label>
            <input type="text" name="surname" class="form-control" id="sur"value="<?php echo $valSurname; ?>">
            <label class="control-label" for="sur"><?php echo $label['surname']; ?></label>
        </div>
        <div class="form-group <?php echo !empty($label['nam']) ? 'has-error' : ''; ?>">
            <label class="control-label" for="nam">Enter your name: </label>
            <input type="text" name="nam" class="form-control" id="nam"value="<?php echo $valName; ?>">
            <label class="control-label" for="nam"><?php echo $label['nam']; ?></label>
        </div>
        <div class="form-group <?php echo !empty($label['fname']) ? 'has-error' : ''; ?>">
            <label class="control-label" for="fat">Enter your father's name: </label>
            <input type="text" name="fname" class="form-control" id="fat"value="<?php echo $valFname; ?>">
            <label class="control-label" for="fat"><?php echo $label['fname']; ?></label>
        </div>
        <input type="submit" name="send" value="SEND" class="btn btn-success">
    </form>

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
