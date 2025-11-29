<?php
chdir('..');
include_once "lib/utils.php";
include_once "lib/session.php";
include_once 'DATA/users.php';
include_once 'DATA/chat.php';

AutoAuth(true);

saveChatData($user['id'], $_POST['msg']);

redirect();