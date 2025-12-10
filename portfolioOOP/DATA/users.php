<?php
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
//echo json_encode($users);

const CONTINUE_ARRAY = ['.', '..'];

function getUserByID(int $id): ?array {
    $users = loadModel('users');
    foreach($users as $user)
        if($user['id'] == $id)
            return $user;
    return null;
}

function getUserByLogin(string $login): ?array {
    $users = loadModel('users');
    foreach($users as $user)
        if($user['login'] == $login)
            return $user;
    return null;
}

function saveUserData(int $id, array $data): bool {
    $users = loadModel('users');
    $numUser = -1;
    foreach($users as $num => $user)
        if($user['id'] == $id)
            $numUser = $num;

    if($numUser < 0)
        return false;

    $users[$numUser] = $data;
    file_put_contents(config('app.paths.models').'/users.json', json_encode($users));
    return true;
}

function createUserData(array $data): bool {
    $users = loadModel('users');

    $users = loadModel('users');
    $max = array_reduce($users, fn($max, $user)=> max($max, $user['id']), 0);
    $max++;

    $data['id'] = $max;
    $users[] = $data;
    file_put_contents(config('app.paths.models').'/users.json', json_encode($users));
    return true;
}

function getAllPhotos(){
    $user = AutoAuth();
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