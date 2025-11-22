<?php
define('test1', 21); // создание константы по старому способу
const TEST2 = 42;
echo test1 . ' '. TEST2 . '<br><hr>';
const FIRST_NUMBER = 5;

function ftest($a = TEST2){
    return $a + test1;
}

$a = 3;
echo ftest().'<br>';
echo ftest(FIRST_NUMBER).'<br>';
echo ftest(2).'<br>';
echo ftest($a).'<br>';

$c = rand(1, 6);
switch($c){
    case 'text': echo 'TEXT'; break;

    case 1: 
    case 2:
        echo 'NUMBER';
        break;

    case FIRST_NUMBER:
        echo 'FIRST';
        break;

    default:
        echo 'Что-то другое';
        break;
}
echo '<br><hr><br>';

const 
    COLOR_WHITE = 1, // 'W'
    COLOR_BLACK = 2, // 'B'
    COLOR_GREEN = 3, // 'G'
    COLOR_RED   = 4; // 'R'

$numColor = $_GET['color'] ?? COLOR_BLACK;

/**
 * Эта функция сделана для преобразования значения цвета в его описание
 * @param int $color Константа номера или ключа цвета
 * @return string возвращает цвет по переданному параметру
 */
function ColorToStr(int|string $color): string {
    switch($color){
        case 'W': case COLOR_WHITE: return 'white';
        case 'B': case COLOR_BLACK: return 'black';
        case 'G': case COLOR_GREEN: return 'green';
        case 'R': case COLOR_RED:   return 'red';
        default: return '???';
    }
}
echo ColorToStr($numColor).'<br>';

const TO_COLOR = [
    COLOR_WHITE => 'white',
    COLOR_BLACK => 'black',
    COLOR_GREEN => 'green',
    COLOR_RED   => 'red',
    'W' => 'white',
    'B' => 'black',
    'G' => 'green',
    'R' => 'red'
];
echo (TO_COLOR[$numColor] ?? '???') . '<br>';
// => isset(TO_COLOR[COLOR_GREEN]) ? TO_COLOR[COLOR_GREEN] : '???'

$color = match($numColor){
    'W', COLOR_WHITE => 'white',
    'B', COLOR_BLACK => 'black',
    'G', COLOR_GREEN => 'green',
    'R', COLOR_RED   => 'red',
    default          => '???'
};
echo $color;
