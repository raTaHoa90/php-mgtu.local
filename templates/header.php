<header>
    <a href="/" > <img src="/img/logo.png" id="logo"></a>
<?php if($isAuth): ?>
    <form action="?" method="GET">
        <input name="search">
    </form>
    <?php include 'head_menu.php'; ?>
<?php endif; ?>
</header>