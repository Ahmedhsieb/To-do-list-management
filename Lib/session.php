<?php

namespace Todo_list\Lib;

class   session
{
    private function __construct() {
    }

    public static function start()
    {
        ini_set('session.use_only_cookies', 1);
        session_start();
    }

    public static function set(string $key, $value)
    {
        $_SESSION[$key] = $value;
        return $value;
    }

    public static function has(string $key)
    {
        return isset($_SESSION[$key]);
    }

    public static function get(string $key)
    {
        return static::has($key) ? $_SESSION[$key]:null;
    }

    public static function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

    public static function all()
    {
        return $_SESSION;
    }

    public static function destroy()
    {
        foreach (static::all() as $key => $value) {
            static::remove($key);
        }
    }

    public static function flash(string $key)
    {
        $value = null;
        if(static::has($key)) {
            $value = static::get($key);
            static::remove($key);
        }
        return $value;
    }

}
