<?php

namespace todo\lib;

class helper{

    static function __callStatic($method, $arg){
        if($method == 'redirect'){
            if (sizeof($arg)>=1) {
                header("Refresh: {$arg[1]}; url={$arg[0]}.php");
            }else {
                header("location:{$arg[0]}.php");
            }
        }
    }
}