<?php

namespace Todo_list\Lib;

class registry
{
    private static $object = []; //obj array

    public static function set($key,$value){
        static::$object[$key] = $value; //make object with key
    }

    public static function get($key){
        return static::$object[$key]; //call object with key
    }

    public static function has($key){
        return (array_key_exists($key,static::$object)); //check if there is an object for this key or not
    }
}