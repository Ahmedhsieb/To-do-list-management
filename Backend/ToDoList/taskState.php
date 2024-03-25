<?php

include_once "../../Lib/registry.php";
include_once "../../Lib/db.php";
include_once "../../Models/user_db.php";

use Todo_list\Lib\db;
use Todo_list\Lib\registry;

registry::set("task", new user_db);

registry::set("user_db", new db($_COOKIE['user_name']));

$is_state = (registry::get("task")->getDataById("task", $_GET['id']))[$_GET['state']];

registry::get("task")->changeDataState("task", $_GET['id'], $_GET['state'], $is_state ? 0 : 1);
