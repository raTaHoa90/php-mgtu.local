<?php
$globalConfigs = [];

function config($name, $defaultValue = null){
    global $globalConfigs;
    $keys = explode('.', $name);
    $fileName = array_shift($keys);
    $path = "./configs/$fileName.php";
    if(!file_exists($path))
        return $defaultValue;

    if(isset($globalConfigs[$fileName]))
        $configs = $globalConfigs[$fileName];
    else {
        $configs = include_once($path);
        $globalConfigs[$fileName] = $configs;
    }

    while($configs !== null && count($keys) > 0){
        $key = array_shift($keys);
        $configs = $configs[$key] ?? null;
    };

    return $configs ?? $defaultValue;
}


include_once 'session.php';
include_once 'Routes.php';
include_once 'View.php';