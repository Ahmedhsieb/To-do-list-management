<?php 

include_once "../../Lib/registry.php";
include_once "../../Lib/db.php";
include_once "../../Models/user.php";
include_once "../../Lib/validation.php";
include_once "../../Lib/generate_db.php";

use Todo_list\Lib\db;
use Todo_list\Lib\generate_db;
use Todo_list\Lib\registry;
use Todo_list\Lib\validation;
use Todo_list\Models\user;

registry::set("validation", new validation);
registry::set("user", new user);
registry::set("to-do-list", new db("to-do-list"));


if (isset($_POST['username'])) {

    $user_name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    //check the validation of user input
    registry::get("validation")->input("username")->string()->min(3)->required();
    registry::get("validation")->input("email")->email()->required();
    registry::get("validation")->input("password")->min(3)->required();

    //check if there is db with this name or not
    $data = registry::get("to-do-list")
                    ->select("user", "*")
                    ->where("name", "=", $user_name)
                    ->andWhere("password", "=", $password)
                    ->andWhere("email", "=", $email)
                    ->getRow();

    if($data)
        $check_exists = false ;
    else
        $check_exists = true ;

    if (registry::get("validation")->success() && $check_exists){
        try{
            //generate db for the user
            generate_db::generate_db($user_name);
            
            //insert user data
            $user_data = [
                "name" => $user_name,
                "email" => $email,
                "db_name" => $user_name,
                "password" => $password,
            ];
            
            registry::get("user")->addUser($user_data);

            sleep(1);
            
        header("Refresh: 1; url=../../Frontend/login.php");
        }catch(Exception $ex){
            try{
        //insert user data
        $user_data = [
            "name" => $user_name,
            "email" => $email,
            "db_name" => $user_name,
            "password" => $password,
        ];
        
        registry::get("user")->addUser($user_data);

        sleep(1);

        header("Refresh: 1; url=../../Frontend/login.php");
            }catch(Exception $ex){

        header("Refresh: 1; url=../../Frontend/register.php");

            }

        }
        


    }else{
        header("Refresh: 1; url=../../Frontend/register.php");

    }

    



}
