<?php
// HTTP_REFERER
// SCRIPT_NAME
// REQUEST_METHOD
/*
foreach($_SERVER as $key => $value)
    if(is_array($value)){
        echo $key.'=';
        print_r($value);
        echo '<br>';
    } else
        echo "$key = $value<br>";
*/
chdir('..');
include_once "lib/utils.php";
include_once "lib/session.php";
include 'DATA/users.php';

if(isset($_SESSION['error']))
    unset($_SESSION['error']);

$user = getUserByLogin($_POST['login']);

if($user === null){
    $_SESSION['error'] = 'Пользователь несуществует';
    redirect();
    //redirect(addUrlParam($_SERVER['HTTP_REFERER'], 'error', 'Пользователь несуществует'));
}

if($user['password'] != $_POST['pass']){
    $_SESSION['error'] = 'Не верно указан логин или пароль';
    redirect();
    //redirect(addUrlParam($_SERVER['HTTP_REFERER'], 'error', 'Не верно указан логин или пароль'));
}
    
    
/*$datetime = time() + 60 * 60;
$date = date('r', $datetime);
header('Set-Cookie: hasAuth=1; Experies='.$date,false);*/

//$time = time()+60*60;
//setcookie('hasAuth', '1', $time);
//setcookie('hasAuth', '1', 0); //- для хранении куки-переменной, пока пользователь не закроет браузер
//setcookie('hasAuth', '1', 1); //- для удаления куки-переменной
//setcookie('UID', $users[$userNum]['id'], $time);

$_SESSION['hasAuth'] = true;
$_SESSION['UID'] = $user['id'];
redirect();
//redirect(delUrlParam($_SERVER['HTTP_REFERER'], 'error'));

