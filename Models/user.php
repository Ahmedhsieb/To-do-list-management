<?php

namespace Todo_list\Models;

include_once "../../Lib/registry.php";
include_once "../../Lib/db.php";

use Todo_list\Lib\registry;
use Todo_list\Lib\db;

class user{

    public function __construct(){
        registry::set("to-do-list", new db("to-do-list"));
    }
    
        public function getUserData($id) {
            return registry::get("to-do-list")->select("user", "*")->where("id", "=", $id)->getRow();
        }

    public function addUser($data) {
        return registry::get("to-do-list")->insert("user",$data)->excu();
    }

    public function updateUser($id, $data){
        return registry::get("to-do-list")->update("user", $data)->where("id", "=", $id)->excu();
    }

    public function state($id, $state){
        if($state){
            return registry::get("to-do-list")->update("user", ["state" => 1])->where("id", "=", $id)->excu();
        }
        return registry::get("to-do-list")->update("user", ["state" => 0])->where("id", "=", $id)->excu();
    }

    public function getState($id) {
        return registry::get("to-do-list")->select("user", "state")->where("id", "=", $id)->getRow();
    }

}