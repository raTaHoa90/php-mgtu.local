<?php

function GET_profile(){
    $menu = include 'menu/admin.php';
    $user = AutoAuth();
    if($user === null)
        redirect('/admin/auth');

    view('admin/profile', [
        'caption' => 'Настройка профиля',
        'menu' => $menu,
        'user' => $user
    ]);
}

function POST_profile(){
    unset($_SESSION['error']);
    $user = AutoAuth();
    if($user === null)
        redirect('/admin/auth');

    if(isset($_POST['pass']) && $_POST['pass']){
        if($_POST['pass'] != ($_POST['pass_two'] ?? '')){
            $_SESSION['error'] = 'Несовпадают введеные пароли';
            redirect();
        }
        $user['password'] = $_POST['pass'];
    }

    if(isset($_POST['login']) && !$_POST['login']){
        $_SESSION['error'] = 'Недопустимо вводить пустой логин';
        redirect();
    }

    $fields = ['login', 'fio', 'tel', 'email', 'telegram', 'desc'];
    foreach($fields as $field)
        $user[$field] = $_POST[$field];

    if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0){
        $fileName = $user['id'].'_'.basename($_FILES['avatar']['name']);
        move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/storage/avatars/'.$fileName);
        $user['avatar'] = $fileName;
    }

    if(!saveUserData($user['id'], $user))
        $_SESSION['error'] = 'Неудалось сохранить пользователя';

    redirect('/admin/profile');
}