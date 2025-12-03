<?php
$isAuth = false;
$authUser = null;
$globalConfigs = [];
$models = [];

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

function AutoAuth(){
    global $isAuth, $authUser;
    if($authUser === null){
        $isAuth = isset($_SESSION['hasAuth']);
        $authUser = $isAuth ? getUserByID($_SESSION['UID']) : null;
    }
    return $authUser;
}

function loadModel($name){
    global $models;
    if(!isset($models[$name]) ){
        include_once config('app.paths.models', 'models')."/$name.php";
        $file = file_get_contents(config('app.paths.models')."/$name.json");
        /*
            id:
            login:
            password:
            avatar: 
            fio:
            city:
            job:
            tel:
            age:
        */
        $models[$name] = json_decode($file, true);
    }
    return $models[$name];
}

include_once 'session.php';
include_once 'Routes.php';
include_once 'View.php';

loadModel('users');