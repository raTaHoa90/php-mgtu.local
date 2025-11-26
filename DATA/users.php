<?php
$file = file_get_contents('DATA/users.json');
$users = json_decode($file, true);
//echo json_encode($users);

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