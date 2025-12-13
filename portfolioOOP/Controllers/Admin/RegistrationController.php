<?php

namespace Controllers\Admin;

use DATA\Users;
use lib\SYS;

class RegistrationController extends BaseAuthController {
    
    function index(){
        SYS::view('admin/registration', [
            'caption' => 'Регистрация'
        ]);
    }

    function registers(){
        if(isset($_POST['pass']) && $_POST['pass'] &&
            $_POST['pass'] != ($_POST['pass_two'] ?? '')
        ) {
            SYS::$session['error'] = 'Несовпадают введеные пароли';
            SYS::back();
        }

        if(isset($_POST['login']) && !$_POST['login']){
            SYS::$session['error'] = 'Недопустимо вводить пустой логин';
            SYS::back();
        }

        $user = [
            'password' => $_POST['pass'],
            'login' => $_POST['login']
        ];

        if(Users::create($user) === null)
            SYS::$session['error'] = 'Неудалось сохранить пользователя';

        SYS::redirect('/admin/auth');
    }
}