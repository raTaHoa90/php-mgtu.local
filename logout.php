<?php
setcookie('hasAuth', '0', 1);
setcookie('UID', 0, 1);
header('Location: '. $_SERVER['HTTP_REFERER']);