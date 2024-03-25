<?php

namespace Todo_list\Lib;


class generate_db
{
    public static function generate_db($username)
    {
        //create db with username
        $create_db_query = "CREATE DATABASE `$username`";
        $db_connection = mysqli_connect("localhost", "root", "1234", "");
        mysqli_query($db_connection, $create_db_query);
        static::generate_user_db($username);
    }

    public static function delete_db($dbname)
    {
        $delete_db_query = "DROP DATABASE `$dbname`";
        $db_connection = mysqli_connect("localhost", "root", "1234", "");
        mysqli_query($db_connection, $delete_db_query);
    }

    public static function generate_user_db($username)
    {
        //execute the sql file query in user db
        $db_file_content =  file_get_contents(dirname(__FILE__)."\database\\to-do-list.sql");
        $db_connection =  mysqli_connect("localhost","root","1234",$username);
        mysqli_multi_query($db_connection, $db_file_content);
        registry::set($username, new db($username));
    }


}