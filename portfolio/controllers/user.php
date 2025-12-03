<?php

function GET_default($params){
    $menu = include 'menu/main.php';
    $user = getUserByLogin($params['login']);
    
    if($user === null)
        redirect('/users');

    view('users/simple', [
        'caption' => 'Профиль: '.($user['fio'] ?: $user['login']),
        'menu' => $menu,
        'user' => $user
    ]);
}