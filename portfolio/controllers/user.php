<?php

function getCatalogs($path, $pathGET){
    if(!is_dir($path))
        mkdir($path);

    $topCatalog = true;
    if(isset($pathGET) && $pathGET){
        $path .= '/'.$pathGET;
        $topCatalog = false;
    }

    $path = strtr($path, ['//' => '/', '..'=>'']);

    if(!is_dir($path))
        return false;

    $result = [];
    $dir = dir($path);
    while(false !== ($name = $dir->read()))
        if($name != '.' && (!$topCatalog || $name != '..')){
            $fullPath = $path.'/'.$name;
            $data = ['name' => $name];
            if(file_exists($fullPath)){
                $size = filesize($fullPath);
                $prefix = 'bytes';
                while( $size > 1024 ){
                    $size = $size / 1024;
                    $prefix = match($prefix){
                        'bytes' => 'kb',
                        'kb' => 'mb',
                        'mb' => 'gb'
                    };
                }

                $data['size'] = ((int)$size).' '.$prefix;
                $data['ext'] = pathinfo($fullPath, PATHINFO_EXTENSION);
                $data['created_at'] = date('d.m.Y H:i', filectime($fullPath));
                $data['type'] = filetype($fullPath);
            } else 
                $data['type'] = 'dir';

            $result[] = $data;
        }

    usort($result, function($a, $b){
        if( $a['type'] == $b['type'] ) 
            return $a['name'] <=> $b['name'];
        elseif($a['type'] == 'dir')
            return -1;
        else
            return 1;
    });

    return $result;
}

function GET_default($params){
    $menu = include 'menu/main.php';
    $user = getUserByLogin($params['login']);
    
    if($user === null)
        redirect('/users');

    $currentPath = ($_GET['path'] ?? '');
    $currentPath = strtr($currentPath, ['..'=>'']);
    $currentPath = strtr($currentPath, ['//'=>'/', '\\\\','\\']);
    if($currentPath == '/' || $currentPath == '\\')
        $currentPath = '';

    $catalog = getCatalogs('public/storage/'.$user['id'].'_catalog', $currentPath);

    if($catalog === false)
        redirect('/users/'.$user['login']);

    if($currentPath) {
        $topPath = pathinfo($currentPath, PATHINFO_DIRNAME);
        if($topPath == '/' || $topPath == '\\')
            $topPath = '';
    } else
        $topPath = '';

    view('users/simple', [
        'caption' => 'Профиль: '.($user['fio'] ?: $user['login']),
        'menu' => $menu,
        'user' => $user,
        'catalogs' => $catalog,
        'userpath' => '/storage/'.$user['id'].'_catalog/'. $currentPath.'/',
        'currentPath' => $currentPath,
        'topPath' => $topPath,
        'EXT_PIC' => ['png','jpg','jepg','gif','webp','ico'],
        'EXT_DOC' => ['doc','docx','odt','pdf','xml']
    ]);
}