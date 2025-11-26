<?php
    header('Set-Cookie: key321=321; expires="Sun, 08 Jun 2025 10:46:34 GMT";',false);
    header('Set-Cookie: key123=321; max-age=60000; path="/admin"; secure',false);
    header("Set-Cookie: key5=text; max-age=60000; httponly",false);

    setcookie('key6', 'test', time() + 60000, '/');
    setcookie('key123', '123', time() + 60000, '/');

    setcookie('hasAuth', '1', $time);
    //setcookie('hasAuth', '1', 0); //- для хранении куки-переменной, пока пользователь не закроет браузер
    //setcookie('hasAuth', '1', 1); //- для удаления куки-переменной
    setcookie('UID', $users[$userNum]['id'], $time);
    header('Location: '. $_SERVER['HTTP_REFERER']);