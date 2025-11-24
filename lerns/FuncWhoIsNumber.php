<?php

function RunIsGet(array $variables){
    if(isset($variables['run'])){
        $guess = $variables['guess'];
        $variant = $variables['variant'];

        if($guess == $variant)
            echo 'Поздравляею, вы угадали число!!!';
        else
            echo "Увы, было загадано число $guess, а не $variant";
        echo '<br>Сервер загадал новое число, попробуйте угадать его.<br>';
    } else
        echo 'Сервер загадал число, попробуйте угадать его.<br>';
}

function EvenOrOdd(int $guess): void {
    echo '<li>Загаданное число <b>';
    if($guess % 2 == 1)
        echo 'не';
    echo 'четное</b>';
}

function CountChars(string $guess): void {
    echo '<li>Загаданное число состоит из ' . strlen($guess) . ' символов';
}

function HasNumberReverse(string $guess): void{
    switch(strlen($guess)){
        case 1: break;
        case 2: 
            if($guess[0] == $guess[1])
                echo '<li>Загаданное число явняется Число-палиндром';
            break;
        case 3:
            if($guess[0] == $guess[2])
                echo '<li>Загаданное число явняется Число-палиндром';
            break;

        default: echo '<li><b style="color: red">не предусмотренное значение</b>';
    }
}