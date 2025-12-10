<?php
chdir('..');

include 'lib/core.php';
use lib\SYS;
SYS::Init();
//core_start_session();
//routeGetScript();

/*
// REQUEST_URI 
// REQUEST_METHOD 
$pathes = explode('/', $_SERVER['REQUEST_URI']);

include 'page/'.$pathes[1].'.php';

$func = $_SERVER['REQUEST_METHOD'].'_'.$pathes[2];
if(function_exists($func))
    $func();
else
    echo '404';
*/