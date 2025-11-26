<?php
include_once "lib/utils.php";
include_once "lib/session.php";

reStartSession();
redirect();
//setcookie('hasAuth', '0', 1);
//setcookie('UID', 0, 1);
//header('Location: '. $_SERVER['HTTP_REFERER']);