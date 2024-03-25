<?php
session_start();

include_once "../../Lib/registry.php";
include_once "../../Lib/db.php";
include_once "../../Lib/validation.php";
include_once "../../Models/user.php";


use Todo_list\Lib\db;
use Todo_list\Lib\registry;
use Todo_list\Lib\validation;
use Todo_list\Models\user;

registry::set("validation", new validation);
registry::set("user", new user);
registry::set("to-do-list", new db("to-do-list"));

if (isset($_POST['username'])) {
    $user_name = $_POST['username'];
    $password = $_POST['password'];

    //check the validation of user input
    registry::get("validation")->input("username")->string()->min(3)->required();
    registry::get("validation")->input("password")->min(3)->required();

    //check if there is db with this name or not
    $data = registry::get("to-do-list")
                    ->select("user", "*")
                    ->where("name", "=", $user_name)
                    ->orWhere("email", "=", $user_name)
                    ->andWhere("password", "=", $password)
                    ->getRow();

    if($data)
        $check_exists = false ;
    else
        $check_exists = true ;

    if (registry::get("validation")->success() && !$check_exists){

        if (registry::get("user")->getState($data['id'])){
            setcookie("user_id", $data['id'], time() + (3600*24) , "/");
            setcookie("user_name", $data['name'], time() + (3600*24) , "/");
            setcookie("user_state", $data['state'], time() + (3600*24) , "/");
            header("Refresh: 1; url=../../Frontend/note.php");
        }
        registry::get("user")->state($data['id'], 1);
        setcookie("user_id", $data['id'], time() + (3600*24) , "/");
        setcookie("user_name", $data['name'], time() + (3600*24) , "/");
        setcookie("user_state", $data['state'], time() + (3600*24) , "/");
        header("Refresh: 1; url=../../Frontend/note.php");

    }else{
        header("Refresh: 1; url=../../Frontend/login.php");

    }
    


    



}
