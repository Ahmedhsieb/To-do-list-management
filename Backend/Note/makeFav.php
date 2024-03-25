<?php

include_once "../../Lib/registry.php";
include_once "../../Lib/db.php";
include_once "../../Models/user_db.php";

use Todo_list\Lib\db;
use Todo_list\Lib\registry;

registry::set("note", new user_db);

registry::set("user_db", new db($_COOKIE['user_name']));

$is_fav = (registry::get("note")->getDataById("note", $_GET['id']))['is_fav'];

registry::get("note")->changeDataState("note", $_GET['id'], 'is_fav', $is_fav ? 0 : 1 );

header("location: ../../Frontend/note.php");




