<?php

include_once "../../Lib/registry.php";
include_once "../../Lib/db.php";
include_once "../../Models/user_db.php";

use Todo_list\Lib\db;
use Todo_list\Lib\registry;

registry::set("task", new user_db);

registry::set("user_db", new db($_COOKIE['user_name']));

registry::get("task")->deleteData("task", $_GET['id']);

header("location: ../../Frontend/todoList.php");

