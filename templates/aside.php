<div class="panel">
    <div class="avatar" style="background-image: url(<?= $user['avatar'] ?>)">
    </div>
    <center><b><?= $user['fio'] ?></b></center>
</div>

<div class="panel">
    <h3>Мои друзья:</h3>
    <div class="friends">
        <a href="#f1" class="avatar" style="background-image: url(/img/frind1.png);" title="Иванов Иван Иванович"></a>
        <a href="#f2" class="avatar" style="background-image: url(/img/frind2.avif);" title="Иванов Иван Иванович"></a>
        <a href="#f3" class="avatar" style="background-image: url(/img/frind3.webp);" title="Иванов Иван Иванович"></a>
        <a href="#f4" class="avatar" style="background-image: url(/img/frind4.webp);" title="Иванов Иван Иванович"></a>
        <a href="#f5" class="avatar" style="background-image: url(/img/frind5.jpg);" title="Иванов Иван Иванович"></a>
    </div>
</div>

<div class="panel -info">
    <table>
        <tr><td>Город:</td><td><?= $user['city'] ?></td></tr>
        <tr><td>Рабора:</td><td><?= $user['job'] ?></td></tr>
        <tr><td>Телефон:</td><td><a href="tel: <?= $user['tel'] ?>"><?= $user['tel'] ?></a></td></tr>
    </table>
</div>