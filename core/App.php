<?php

class App {
    protected static $registry = [];

    public static function bind(string $key, $value)
    {
        static::$registry[$key] = $value;
    }

    public static function resolve(string $key)
    {
        if (!array_key_exists($key, static::$registry)) {
            throw new Exception("No matching binding found for {$key}");
        }
        return static::$registry[$key];
    }
}
#respect LO // ARPANET