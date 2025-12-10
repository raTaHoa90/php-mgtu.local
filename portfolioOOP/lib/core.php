<?php
namespace lib;

class SYS {
    static $isAuth = false;
    static $authUser = null;
    static $configs = [];
    static $models = [];

    static ?SysSession $session = null;
    static ?View $view = null;
    static $shared = [];

    static function Init(){
        static::$session = new SysSession;
        static::$view = new View;
    }

    static function AutoAuth(){
        global $isAuth, $authUser;
        if($authUser === null){
            $isAuth = isset($_SESSION['hasAuth']);
            $authUser = $isAuth ? getUserByID($_SESSION['UID']) : null;
        }
        return $authUser;
    }

    static function view(string $page, array $args = []){
        static::$view->render($page, array_merge(static::$shared, $args));
    }

    static function loadModel($name){
        if(!isset(static::$models[$name]) ){
            include_once config('app.paths.models', 'models')."/$name.php";
            $file = file_get_contents(config('app.paths.models')."/$name.json");
            static::$models[$name] = json_decode($file, true);
        }
        return static::$models[$name];
    }

    static function redirect($url){
        static::$view->redirect($url);
    }

    static function back(){
        static::$view->back();
    }
}

spl_autoload_register(function($className){
    $loadPath = strtr($className, ['\\'=>'/']).'.php';
    if(is_file($loadPath)){
        include_once $loadPath;
        if( !class_exists($className) &&
            !trait_exists($className) &&
            !interface_exists($className) &&
            !enum_exists($className)
        ) throw "Class $className not found";
        
        return;
    }

    throw "Class $className not found";
    //include 'lib/'.$className.'.php';
});

include_once "utilits.php";

//include_once 'session.php';
include_once 'Routes.php';
//include_once 'View.php';

//loadModel('users');