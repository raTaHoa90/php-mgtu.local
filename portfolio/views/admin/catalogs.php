@extend CONTENT main

<script src="/js/admin/catalogs.js"></script>

<section>
    Загрузка файла:
    <form action="/admin/catalogs/loadFile" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="path" value="">
        <input type="file" name="document" ><br>
        <input type="submit" value="Отправить файл в текущий каталог">
    </form>
    <br><hr>

    Создать каталог:
    <form action="/admin/catalogs/createCatalog" method="POST">
        <input type="hidden" name="path" value="">
        Имя каталога для создания: <input name="name" value="" placeholder="name dir" maxlength="32"> <br>
        <input type="submit" value="Создать каталог">
    </form>
</section>

<section class="files">

</section>
