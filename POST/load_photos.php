<?php
chdir('..');
include_once "lib/utils.php";
include_once "lib/session.php";
include 'DATA/users.php';

AutoAuth(true);

function hasLoadCorrectFile(){
    return 
        isset($_FILES['photo']) && 
        $_FILES['photo']['error'] == 0 && 
        substr($_FILES['photo']['type'], 0, 6) == 'image/';
}

if(hasLoadCorrectFile()){
    $fileName = 'img/photos_'.$user['id'].'/'.basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], $fileName);
}

redirect();
