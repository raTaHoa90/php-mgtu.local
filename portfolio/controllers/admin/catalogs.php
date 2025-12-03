<?php

function GET_catalogs(){
    $menu = include 'menu/admin.php';
    $user = AutoAuth();
    if($user === null)
        redirect('/admin/auth');


    view('admin/catalogs',[
        'caption' => 'Портфолио: '.$user['fio'],
        'menu' => $menu
    ]);
}