<?php
$file = file_get_contents('DATA/users.json');
/*
    id:
    login:
    password:
    avatar: 
    fio:
    city:
    job:
    tel:
    age:
*/
$users = json_decode($file, true);
$isAuth = false;
$user = null;
//echo json_encode($users);

const CONTINUE_ARRAY = ['.', '..'];

function getUserByID(int $id): ?array {
    global $users;
    foreach($users as $user)
        if($user['id'] == $id)
            return $user;
    return null;
}

function getUserByLogin(string $login): ?array {
    global $users;
    foreach($users as $user)
        if($user['login'] == $login)
            return $user;
    return null;
}

function saveUserData(int $id, array $data): bool {
    global $users;
    $numUser = -1;
    foreach($users as $num => $user)
        if($user['id'] == $id)
            $numUser = $num;

    if($numUser < 0)
        return false;

    $users[$numUser] = $data;
    file_put_contents('DATA/users.json', json_encode($users));
    return true;
}

function AutoAuth(bool $isRedirect = false){
    global $isAuth, $user;
    $isAuth = isset($_SESSION['hasAuth']);
    $user = $isAuth ? getUserByID($_SESSION['UID']) : null;

    if($isRedirect && !$user) 
        redirect();
}

function getAllPhotos(){
    global $user;
    $path = 'img/photos_'.$user['id'];
    
    $result = [];
    if(!is_dir($path))
        return $result;

    $catalog = dir($path);
    while(false !== ($entry = $catalog->read())){
        //echo $entry.'<br>';
        if(!in_array($entry, CONTINUE_ARRAY) && !is_dir('img/'.$entry)) 
            $result[] = $entry;
    }

    return $result;
}