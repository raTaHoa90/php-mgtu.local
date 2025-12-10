<?php

function GET_registration(){
    $menu = include 'menu/auth.php';
    $data = [
        'caption' => 'Регистрация',
        'menu' => $menu
    ];
    if(isset($_SESSION['error']))
        $data['error'] = $_SESSION['error'];

    view('admin/registration', $data);
}

function POST_registration(){
    if(isset($_POST['pass']) && $_POST['pass'] &&
        $_POST['pass'] != ($_POST['pass_two'] ?? '')
    ) {
        $_SESSION['error'] = 'Несовпадают введеные пароли';
        redirect();
    }

    if(isset($_POST['login']) && !$_POST['login']){
        $_SESSION['error'] = 'Недопустимо вводить пустой логин';
        redirect();
    }

    $user = [
        'password' => $_POST['pass'],
        'login' => $_POST['login']
    ];

    if(!createUserData($user))
        $_SESSION['error'] = 'Неудалось сохранить пользователя';

    redirect('/admin/auth');
}