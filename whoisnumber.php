<?php
    include 'FuncWhoIsNumber.php';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Угадай число</title>
</head>
<body>
    <?php
        RunIsGet($_GET);

        $guess = rand(0, 999);
        echo '<ul>';

        EvenOrOdd($guess);
        CountChars($guess);
        HasNumberReverse($guess);

        echo '</ul>';
    ?>
    <hr>
    <form action="?">
        <input type="hidden" value="<?= $guess ?>" name="guess">
        <table>
            <tr>
                <td>Введите число от 0 до 999: </td>
                <td><input type="number" name="variant" placeholder="999"></td>
            </tr>
            <tr><td></td><td><input type="submit" name="run" value="Проверить"></td></tr>
        </table>
    </form>
</body>
</html>