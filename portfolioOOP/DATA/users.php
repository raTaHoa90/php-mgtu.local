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
        return static::table("SELECT * FROM users WHERE deleted_at is null AND fio <> '' ORDER BY fio");
    }

    static function getUserByLogin(string $login): ?Users {
        $result = static::table('SELECT * FROM '.static::getTable().' WHERE login=$? LIMIT 1', [$login]);
        return $result[0] ?? null;
    }

    static function create(array $data = []): Users {
        $user = new static($data);
        $user->save();
        return $user;
    }

    //==============================================================
    function setPassword(string $password){
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    function testPassword(string $password): bool{
        return password_verify($password, $this->password);
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