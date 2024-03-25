<?php

if (
    (file_exists("../../Lib/registry.php") && is_readable("../../Lib/registry.php") && include_once("../../Lib/registry.php")) &&
    (file_exists("../../Lib/db.php") && is_readable("../../Lib/db.php") && include_once("../../Lib/db.php"))
    ){
        include_once "../../Lib/registry.php";
        include_once "../../Lib/db.php";
    }else {
        include_once "../Lib/registry.php";
        include_once "../Lib/db.php";
    }


use Todo_list\Lib\registry;
use Todo_list\Lib\db;


class user_db {
    public function __construct(){
        try{
            registry::set("user_db", new db($_COOKIE['user_name']));
        }catch(Exception $ex){}
    }

    public function addData($table, $data){
        return registry::get("user_db")->insert($table, $data)->excu();
    }

    public function updateData($table, $data, $id){
        return registry::get("user_db")->update($table, $data)->where("id", "=", $id)->excu();
    }

    public function deleteData($table, $id){
        return registry::get("user_db")->delete($table)->where("id", "=", $id)->excu();
    }

    public function getAllData($table){
        return registry::get("user_db")->select($table, "*")->getAll();
    }

    public function getDataById($table, $id){
        return registry::get("user_db")->select($table, "*")->where("id", "=", $id)->getRow();   
    }

    public function changeDataState($table, $id, $state, $stateValue){
        $this->updateData($table, [$state => $stateValue], $id);
    }

}