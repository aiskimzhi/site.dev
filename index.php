<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Исторический турнир</title>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div id="container">

    <div>

        <h3>Результат отправки формы</h3>

        <?php
        // echo "строка 1" . "строка 2 или какая-то хрень";
        // переменные в php называются вот так $variable

        $name = "";
        $message = "";

        if (isset($_POST['name'])) {
            $name = $_POST['name'];
        }

        if (isset($_POST['message'])) {
            $message = $_POST['message'];
        }

        echo "ИМЯ: " . $name;
        echo "<br>";
        echo "СООБЩЕНИЕ: " . $message;


        ?>

    </div>


    <form action="" method="post">
        <p>Name <input type="text" name="name"></p>

        <p>Message <input type="text" name="message"></p>

        <p><input type="submit" name="send"></p>
    </form>


</div>
</body>
</html>
