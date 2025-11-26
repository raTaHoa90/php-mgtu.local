<?php
function redirect($toUrl = ''){
    if(empty($toUrl))
        $toUrl = $_SERVER['HTTP_REFERER'];
    header('Location: '. $toUrl);
    exit;
}

function addUrlParam($url, $paramKey, $paramValue){
    if(strpos($url, '?') === false)
        return "$url?$paramKey=$paramValue";

    $urlSplit = explode('?', $url);
    $params = explode('&', $urlSplit[1]);
    $isErrorKey = false;
    foreach($params as &$param){
        $param = explode('=', $param);
        if($param[0] == $paramKey){
            $param[1] = $paramValue;
            $isErrorKey = true;
        }
        $param = implode('=', $param);
    }

    if(!$isErrorKey)
        $params[] = "$paramKey=$paramValue";    
    return $urlSplit[0].'?'.implode('&', $params);
}


function delUrlParam($url, $paramKey){
    if(strpos($url, '?') === false)
        return $url;

    $urlSplit = explode('?', $url);
    $params = explode('&', $urlSplit[1]);
    foreach($params as &$param){
        $param = explode('=', $param);
        if($param[0] == $paramKey)
            $param = "";
        else
            $param = implode('=', $param);
    }
    $params = array_filter($params, fn($value)=> !empty($value) );

    if(count($params) > 0)
        return $urlSplit[0].'?'.implode('&', $params);
    else
        return $urlSplit[0];
}