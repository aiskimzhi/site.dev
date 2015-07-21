<?php

class User extends PDO
{
    public $email;
    public $pass;
    public $repeatPass;
    public $errors = array();
    public $salt = '$1$rasmusle$';

    public function asign($email, $pass, $repeatPass = '')
    {
        $this->email = trim($email);
        $this->pass = trim($pass);
        $this->repeatPass = trim($repeatPass);
    }

    public static function tableName ()
    {
        return 'users';
    }

    public function __construct()
    {
        $user = 'root';
        $password = '';
        $dsn = "mysql:host=localhost;dbname=log_in;charset=utf8";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];
        parent::__construct($dsn, $user, $password, $opt);
    }

    public function selectAll()
    {
        $selectALL = $this->prepare("SELECT * FROM " . self::tableName());
        $selectALL->execute();
        return $selectALL->fetchAll();
    }

    public function emailValid()
    {
        if ($this->email == filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            $this->errors[] = 'Your e-mail is incorrect! <br>';
        }
        return false;
    }

    public function passValid()
    {
        $pattern = '/[a-zA-Z0-9-]/';
        if ($this->pass == $this->repeatPass
            && strlen($this->pass) > 5
            && preg_match($pattern, $this->pass) == 1
        ) {
            return true;
        }
        if (strlen($this->pass) < 6) {
            $this->errors[] = 'Your password is too short! <br>';
        }
        if ($this->pass !== $this->repeatPass) {
            $this->errors[] = 'Your passwords are not simillar! <br>';
        }
        if (preg_match($pattern, $this->pass) == 0) {
            $this->errors[] = 'Password should countain just numbers and latin letters<br>';
        }
        return false;
    }

    public function checkEmailUnique()
    {
        $select = $this->prepare("SELECT id FROM " . self::tableName() . " WHERE email = :email");
        $select->execute(array('email' => $this->email));
        if ($select->fetch()) {
            $this->errors[] = 'There is user with such email';
            return false;
        }
        return true;
    }

    public function insert()
    {
        self::emailValid();
        self::passValid();
        self::checkEmailUnique();
        if (self::emailValid()
            && self::passValid()
            && self::checkEmailUnique()
        ) {
            $i = $this->prepare("INSERT INTO " . self::tableName() . " (email, password) VALUES (:email, :pass)");
            echo 'Registration Successed! <br>';

            return $i->execute(
                [
                    'email' => $this->email,
                    'pass' => crypt($this->pass, $this->salt)
                ]
            );
        }
        return false;
    }

    public function login()
    {
        $query = $this->prepare("SELECT * FROM " . self::tableName() . " WHERE email = :email");
        $query->execute(array('email' => $this->email));
        $select = $query->fetch();

        if ($select['email'] == $this->email
            && $select['password'] == crypt($this->pass, $this->salt)
        ) {
            $_SESSION['email'] = $this->email;
            $_SESSION['pass'] = crypt($this->pass, $this->salt);
            header("Location: http://site.dev/LogIn/enter.php");

        }

        if (!$select) {
            $this->errors[] = 'There is no user with such e-mail<br>';
            //return $error;
        }

        if ($select['password'] !== crypt($this->pass, $this->salt)
        ) {
            $this->errors[] = 'Wrong e-mail or password <br>';
        }
        return $this->errors;
    }

    public function logOut()
    {
        session_unset();
        header('Location: http://site.dev/LogIn/index.html');
    }

    public function __destruct()
    {
        $this->errors = array_unique($this->errors);
        foreach ($this->errors as $key => $value) {
            echo 'ERROR' . ($key + 1) . ': ' . $value;
        }

    }





}
