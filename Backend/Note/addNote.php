<?php

include_once "../../Lib/registry.php";
include_once "../../Lib/db.php";
include_once "../../Models/user_db.php";

use Todo_list\Lib\db;
use Todo_list\Lib\registry;

registry::set("note", new user_db);

registry::set("user_db", new db($_COOKIE['user_name']));


if(isset($_POST['title'])){
    $title = $_POST['title'];
    $details = addslashes($_POST['details']);
    $currentDateTime = date('Y-m-d H:i:s');


    registry::get("note")->addData("note", [
        'title' => $title,
        'details' => addslashes($details),
        'date' => $currentDateTime,
    ]);

    // echo "lml";die;
    header("location: ../../Frontend/note.php");

}