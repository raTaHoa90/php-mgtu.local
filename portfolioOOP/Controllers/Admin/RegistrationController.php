<?php

namespace Controllers\Admin;

use DATA\Users;
use lib\MailAgent;
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

        if(isset($_POST['email']) && !$_POST['email'] && 
            !SYS::emailValidation($_POST['email'])
        ){
            SYS::$session['error'] = 'Неправильно введен Email';
            SYS::back();
        }

        $login = trim($_POST['login']);
        $password = $_POST['pass'];

        $user = [
            'password' => '',
            'login' => $login,
            'email' => trim($_POST['email'])
        ];

        $user = Users::create($user);
        if($user === null)
            SYS::$session['error'] = 'Неудалось сохранить пользователя';

        $user->setPassword($_POST['pass'])->save();

        $mail = new MailAgent();
        $mail->addAddress($user->email);
        $mail->setMessage('Вы зарегестрировались на сайте Портфолио', <<<ENDMESSAGE
            <!DOCTYPE html>
            <html>
                <head></head>
                <body>
                    Вы зарегистрировались на нашем сайте портфолио!<br>
                    ваш логин: <b>$login</b><br>
                    пароль: <b>$password</b><br><br>
                    Добро пошаловать!!!
                </body>
            </html>
        ENDMESSAGE);
        $mail->send();

        SYS::redirect('/admin/auth');
    }
}