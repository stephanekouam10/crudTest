<?php

class contacts
{
    // table fields
    public $id;
    public $surname;
    public $name;
    // message string
    public $id_msg;
    public $surname_msg;
    public $name_msg;
    // constructor set default value
    function __construct()
    {
        $id=0;$surname=$name="";
        $id_msg=$surname_msg=$name_msg="";
    }
}

?>