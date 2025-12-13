<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $caption ?? '404' ?></title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">
</head>
<body>
    <header>
        <a href="/"><img id="logo" src="/imgs/logo.webp"></a>

        <?php if(isset($menu)): ?>
        <nav>
            <ul><?php foreach($menu as $menuItem): ?>
                <li><a class="btn" href="<?= $menuItem['url'] ?>">
                    <?php if(isset($menuItem['icon'])): ?>
                    <i class="fa <?= $menuItem['icon'] ?>"></i>
                    <?php endif ?>
                    <?= $menuItem['caption'] ?>
                </a></li>
            <?php endforeach; ?></ul>
        </nav>
        <?php endif ?>
    </header>
    <div>
        <div>
            
<section>
    <?php if(isset($error)):?>
    <div class='error'><?= $error ?></div>
    <?php endif; ?>
    <form action="/admin/profile" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="uid" value="<?= $user['id'] ?>">
        <table>
            <tr>
                <td>Логин:</td>
                <td><input required autocomplete="off" name="login" value="<?= $user['login'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td>Введите пароль:</td>
                <td><input autocomplete="off" type="password" name="pass"></td>
            </tr>
            <tr>
                <td>Повторите пароль:</td>
                <td><input autocomplete="off" type="password" name="pass_two"></td>
            </tr>
            <tr>
                <td>ФИО:</td>
                <td><input autocomplete="off"  name="fio" value="<?= $user['fio'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td>Аватарка</td>
                <td>
                    <?php if(!empty($user['avatar'])): ?>
                        <div class="avatar" style="background-image: url(/storage/avatars/<?= $user['avatar'] ?>)"></div>
                    <?php endif; ?>
                    <input type="file" name="avatar">
                </td>
            </tr>
            <tr>
                <td>Телефон:</td>
                <td><input autocomplete="off" type="tel" name="tel" value="<?= $user['tel'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td>Почта:</td>
                <td><input autocomplete="off" type="email" name="email" value="<?= $user['email'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td>Телеграмм:</td>
                <td><input autocomplete="off" name="telegram" value="<?= $user['telegram'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td>О себе:</td>
                <td><textarea autocomplete="off" name="desc" rows=10 cols=50><?= $user['desc'] ?? '' ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Сохранить"></td>
            </tr>
        </table>
    </form>
</section>
        </div>
    </div>

    <footer>&copy; 2025 Все права защищены</footer>
</body>
</html>