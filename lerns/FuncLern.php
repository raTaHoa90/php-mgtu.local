<?php
$globalVariable = 10;

function sumA($a, $b = 10){
    return $a + $b;
}

function sumB($a, $b = 10){
    $args = func_get_args();
    //print_r($args);
    $sum = 0;
    foreach($args as $arg)
        $sum += $arg;
    return $sum;
}

function sumC($a, $b = 10, ...$args){
    $sum = $a + $b;
    foreach($args as $arg)
        $sum += $arg;
    return $sum;
}

function DivMod1($a, $b){
    $mod = $a % $b;
    $a -= $mod;
    return [
        'mod' => $mod,
        'div' => $a / $b
    ];
}

function DivMod2($a, $b, &$mod){
    $mod = $a % $b;
    $a -= $mod;
    return $a / $b;
}

function SumD($a, $b){
    global $globalVariable;
    return $globalVariable + $a + $b;
}

function SumE(int $a, int $b): int {
    global $globalVariable;
    return $globalVariable + $a + $b;
}

$arr = [10, 11, 12, 13, 14];

echo sumA(10, 12).' ';
echo sumA(10).' ';
echo sumB(10, 11, 12, 13, 14).' ';
echo sumC(10, 11, 12, 13, 14).' ';
echo sumC(...$arr).'<br>';

$result = DivMod1(14, 5);
echo $result['div'].($result['mod'] ? '(+'.$result['mod'].')' : ''). '<br>';

$result = DivMod2(23, 7, $mod);
echo $result.($mod ? "(+$mod)" : ''). '<br>';

//$globalVariable

echo sumD(5, 2). ' ';
$globalVariable = 20;
echo sumD(1, 2). ' ';
$globalVariable = 30;
$a = '4';
echo sumE($a, '6'). ' ';

$func = function(int $a, int $b): int {
    return $a + $b;
};
echo $func(16, 12). ' ';

$func = function(int $aA, int $aB) use(&$globalVariable, $a): int {
    return $aA + $aB + $globalVariable + $a;
};
$globalVariable = 3;
echo $func(1, 2). ' ';

$func2 = fn(int $a, int $b): int => $a + $b + $globalVariable;
echo $func2(25, 30).'<br>';

$arr = [];
for($i = 0; $i < 10; $i++)
    $arr['key'.rand(0, 99)] = rand(0, 999);
$arr2 = $arr;
print_r($arr);
echo '<br>';
sort($arr);
print_r($arr);
echo '<br>';

rsort($arr);
print_r($arr);
echo '<br>';

echo '<br><hr>';
shuffle($arr); // перемешиваем массив случайным образом
print_r($arr);

$arr = $arr2;
echo '<br><hr>';
ksort($arr); // сортировка по возрастанию, по клуючам
print_r($arr);

$arr = $arr2;
echo '<br>';
asort($arr); // сортируем с сохранением пары key => value
print_r($arr);
echo '<br>';
arsort($arr); // сортируем с сохранением пары key => value, но от большего к меньшему
print_r($arr);

$arr = $arr2;
echo '<br>';
uksort($arr, fn(string $a, string $b): int => +substr($b, 3) <=> +substr($a, 3) );
print_r($arr);

$arr = $arr2;
echo '<br>';
uasort($arr, fn(int $a, int $b): int => $b <=> $a );
print_r($arr);