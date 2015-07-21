<?php

define('DEBUG', true);


if (DEBUG){
    echo 'debug';
}
class myClass
{
    public $prop1 = "I am class property";

    public function setProperty ($newVal)
    {
        $this -> prop1 = $newVal;
    }

    public function getProperty ()
    {
        return $this -> prop1 . '<br />';
    }

    public function __construct()
    {
        echo 'Object in class "' . __CLASS__ . '" is created! <br />';
    }

    public function __destruct()
    {
        echo 'Object in class "' . __CLASS__ . '" is deleted <br />';
    }

    public function __toString()
    {
        return $this -> getProperty();
    }
}

class myOtherClass extends myClass
{
    public function __construct()
    {
        parent::__construct();
        echo 'A New Construct in class "' . __CLASS__ . '".<br />';
    }
}


