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

namespace DATA;

use lib\SYS;

class Users extends Model {

    const CONTINUE_ARRAY = ['.', '..'];

    static function all(){
        $users = SYS::loadModel('users');
        return array_map(fn($user)=>new Users($user), $users); 
    }

    static function getUserByID(int $id): ?Users {
        $users = SYS::loadModel('users');
        foreach($users as $user)
            if($user['id'] == $id)
                return new static($user);
        return null;
    }

    static function getUserByLogin(string $login): ?Users {
        $users = SYS::loadModel('users');
        foreach($users as $user)
            if($user['login'] == $login)
                return new static($user);
        return null;
    }

    static function create(array $data): Users {
        $users = SYS::loadModel('users');

        $max = array_reduce($users, fn($max, $user)=> max($max, $user['id']), 0);
        $max++;

        $data['id'] = $max;
        $users[] = $data;
        file_put_contents(config('app.paths.models').'/users.json', json_encode($users));
        return new static($data);
    }

    //==============================================================

    function save(): bool {
        $users = SYS::loadModel('users');
        $numUser = -1;
        foreach($users as $num => $user)
            if($user['id'] == $this->id)
                $numUser = $num;

        if($numUser < 0)
            return false;

        $users[$numUser] = $this->getData();
        file_put_contents(config('app.paths.models').'/users.json', json_encode($users));
        return true;
    }

    function getAllPhotos(): array{
        $path = 'img/photos_'.$this->id;
        
        $result = [];
        if(!is_dir($path))
            return $result;

        $catalogs = scandir($path);
        foreach($catalogs as $entry)
            if(!in_array($entry, static::CONTINUE_ARRAY) && !is_dir('img/'.$entry)) 
                $result[] = $entry;

        return $result;
    }

    function pathPublic(){
        return 'public/storage/'.$this->id.'_catalog';
    }
}