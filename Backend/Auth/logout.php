<?php
include_once "../../Lib/registry.php";
include_once "../../Models/user.php";

use Todo_list\Lib\registry;
use Todo_list\Models\user;

registry::set("user", new user);


registry::get("user")->state($_COOKIE['user_id'], 0);
setcookie("user_id", "", time() - (3600*24) , "/");
setcookie("user_name", "", time() - (3600*24) , "/");
setcookie("user_state", 0, time() - (3600*24) , "/");

header("location: ../../Frontend/login.php");