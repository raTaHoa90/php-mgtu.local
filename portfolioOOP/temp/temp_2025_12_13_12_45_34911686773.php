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
            
<script src="/js/admin/catalogs.js"></script>
<script>
    catalogs.userDir = '<?= $user['id'].'_catalog' ?>';
</script>

<div class='errors'></div>

<section>
    Загрузка файла:
    <form action="/admin/catalogs/loadFile" method="POST" enctype="multipart/form-data">
        <input type="file" name="document" id="upFile" multiple><br>
        <input type="button" value="Отправить файл в текущий каталог" onclick="catalogs.uploadFile()">
    </form>
    <br><hr>

    Создать каталог:
    <form action="#" method="POST" onsubmit="return false">
        Имя каталога для создания: <input id="dirname" name="name" value="" placeholder="name dir" maxlength="32"> <br>
        <input type="button" value="Создать каталог" onclick="catalogs.createDir()">
    </form>
</section>

<template id="error_templ">
    <div class='error'>
        <span>ОШИБКА</span>
        <i class="fa fa-window-close-o" onclick="this.parentElement.remove();"></i>
    </div>
</template>
<template id="dir_templ">
    <div class='dir'>
        <span class="btn f-t-r" href="#" onclick="catalogs.deleteDir('#=DirName=#',this.parentElement)"><i class="fa fa-trash-o"></i></span>

        <img src="/imgs/ext/dir.png"><br>
        <b><a href="#">NameDir</a></b>
    </div>
</template>
<template id="file_templ">
    <div class='file'>
        <span class="btn f-t-r" href="#" onclick="catalogs.deleteFile('#=FileName=#',this.parentElement)"><i class="fa fa-trash-o"></i></span>

        <img src="/imgs/ext/file.png"><br>
        <a href="#">NameFile.txt</a>
        <div class="file-info">
            <i>15 kb</i><br>
            <span>12.10.2020 15:14</span>
        </div>
    </div>
</template>

<section id="pathdir"></section>

<section class="files">
</section>

        </div>
    </div>

    <footer>&copy; 2025 Все права защищены</footer>
</body>
</html>