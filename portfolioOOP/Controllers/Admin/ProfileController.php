<?php

namespace Controllers\Admin;

use lib\SYS;

class ProfileController extends BaseAdminController {

    function index(){
        SYS::view('admin/profile', [
            'caption' => 'Настройка профиля'
        ]);
    }

    function save(){

        if(isset($_POST['pass']) && $_POST['pass']){
            if($_POST['pass'] != ($_POST['pass_two'] ?? '')){
                SYS::$session['error'] = 'Несовпадают введеные пароли';
                SYS::back();
            }
            $this->user->setPassword($_POST['pass']);
        }

        if(isset($_POST['login']) && !$_POST['login']){
            SYS::$session['error'] = 'Недопустимо вводить пустой логин';
            SYS::back();
        }

        $fields = ['login', 'fio', 'tel', 'email', 'telegram'];
        foreach($fields as $field)
            $this->user->{$field} = $_POST[$field];
        $this->user->description = $_POST['desc'];

        if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0){
            $fileName = $this->user->id.'_'.basename($_FILES['avatar']['name']);
            move_uploaded_file($_FILES['avatar']['tmp_name'], 'public/storage/avatars/'.$fileName);
            $this->user->avatar = $fileName;
        }

        if(!$this->user->save())
            SYS::$session['error'] = 'Неудалось сохранить пользователя';

        SYS::redirect('/admin/profile');
    }
}