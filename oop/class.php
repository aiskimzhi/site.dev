<?php

$sname = session_name('sname');
session_start($sname);

define('DEBUG', false);

//session_unset();

class users extends PDO
{
    protected $queries = array();
    protected $errors = array();

    public static function tableName ()
    {
        return 'users';
    }

    public function __construct()
    {
        if (DEBUG && isset($_SESSION['queries'])) {
            $this->queries = $_SESSION['queries'];
            unset($_SESSION['queries']);
        }
        if (DEBUG && isset($_SESSION['errors'])) {
            $this->errors = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }

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
        $p = "SELECT * FROM " . self::tableName();
        $selectALL = $this->prepare($p);
        $selectALL->execute();
        $k =  $selectALL->fetchAll();
        $m = [$k, $p];
        return $m;
    }

    public function delete($id)
    {
        if (isset($_GET['action'])
            && $_GET['action'] == 'delete'
        ) {
            $d = $this->prepare("DELETE FROM " . self::tableName() . " WHERE id = :id");
            $d->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $d->execute();
            return $d->rowCount();
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
                $valName = $data['name'];
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
            && !empty($_POST['name'])
            && !empty($_POST['surname'])
            && !empty($_POST['fname'])
        ) {
            $u = $this->prepare("UPDATE " . self::tableName() . " SET surname = :surname, name = :name, fname = :fname WHERE id = :id");
        }
    }

    public function insert ()
    {
        if (isset($_POST['send'])
            && !empty($_POST['surname'])
            && !empty($_POST['nam'])
            && !empty($_POST['fname'])
            && !isset($_GET['id'])
        ) {
            $p = "INSERT INTO " . self::tableName() . "(surname, nam, fname) VALUES (:surname, :nam, :fname)";
            $insert = $this->prepare($p);
            $k =  $insert->execute([
                'surname' => $_POST['surname'],
                'nam' => $_POST['nam'],
                'fname' => $_POST['fname']
            ]);
            $m = [$k, $p];
            return $m;
        }
        return false;
    }

    public function __destruct()
    {

        if (DEBUG){
            echo '<br/>';
            foreach ($this->queries as $query) {
                echo $query . '<br/>';
            }
            foreach ($this->errors as $error) {
                echo $error . '<br/>';
            }
        }
    }
}

echo '<pre>';
print_r($_GET);
echo '</pre>';
echo '<pre>';
print_r($_POST);
echo '</pre>';
$new = new users;
echo 'table name is ' . $new->tableName() . '<br>';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = 0;
}
echo 'id = ' . $id . '<br>';


$sellect = $new->selectForUpdate($id);

$update = $new->updateById($id);

$delete = $new->delete($id);

$insert = $new->insert();

$sellectAll = $new->selectAll();

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Class work</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bootstrap.css">
    <script type="text/javascript" scr="bootstrap.js"></script>
</head>
<body>
<h4>Please, enter your data into the form below</h4>
    <form action="class.php" method="POST">
        Enter your surname: <input type="text" name="surname"><br>
        Enter your name: <input type="text" name="nam"><br>
        Enter your fathr's name: <input type="text" name="fname"><br>
        <input type="submit" name="send" value="SEND" class="btn btn-success">
    </form>


</body>
</html>
