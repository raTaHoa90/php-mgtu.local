<?php
use lib\SYS;

function config($name, $defaultValue = null){
    $keys = explode('.', $name);
    $fileName = array_shift($keys);
    $path = "./configs/$fileName.php";
    if(!file_exists($path))
        return $defaultValue;

    if(isset(SYS::$configs[$fileName]))
        $configs = SYS::$configs[$fileName];
    else {
        $configs = include_once($path);
        SYS::$configs[$fileName] = $configs;
    }

    while($configs !== null && count($keys) > 0){
        $key = array_shift($keys);
        $configs = $configs[$key] ?? null;
    };

    return $configs ?? $defaultValue;
}