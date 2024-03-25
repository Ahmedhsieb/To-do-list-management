<?php

include_once "../../Lib/registry.php";
include_once "../../Lib/db.php";
include_once "../../Models/user_db.php";

use Todo_list\Lib\db;
use Todo_list\Lib\registry;

registry::set("task", new user_db);

registry::set("user_db", new db($_COOKIE['user_name']));


if(isset($_POST['title'])){
    $title = $_POST['title'];
    $details = addslashes($_POST['details']);
    $currentDateTime = date('Y-m-d H:i');
    $start = $_POST['start'];
    $end = $_POST['end'];


    registry::get("task")->updateData("task", [
        'title' => $title,
        'details' => $details,
        'createdAt' => $currentDateTime,
        'start' => $start,
        'end' => $end,
    ], $_POST['id']);

    header("location: ../../Frontend/todoList.php");

}