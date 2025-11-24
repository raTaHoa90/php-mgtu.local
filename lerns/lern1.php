<?php
// a-zA-Z0-9_
/*
    Многострочный комментарий
*/

$value = 123;
/*
    int    - целое число
    float  - вещественное/дробное число 
    bool   - булевой/логический тип (false / true)
    string - строка
    array  - массив/ассоциативный массив
    object - объект
    null   - пустая ссылка
    callable - функция
    resource - ресурс
    void     - отсутсвие значения
*/

$a = 8;
$b = 3;
$c = -5;

echo ($a + $b) . '<br>';
echo ($a - $b) . '<br>';
echo ($a * $b) . '<br>';
echo ($a / $b) . '<br>';
echo ($a % $b) . '<br>';
echo ($a ** $b). '<br>';
echo ($a + $b + $c * ($a - $b) ). '<br>';
echo -$a . '<br>';

$result = $a + $b + $c;
echo $result;
echo $a . ' + ' . $b . ' = ' . ($a + $b) . '<br>';

$a = $a | $b; // бинарное Или
$a = $a & $b; // бинарное И
$a = $a ^ $b; // бинарное xor
$a = ~$a;     // бинарное не

$a = 0b0101; // => 5
$b = $a << 2; // 0b10100 => 24
$c = $a >> 1; // 0b0010 => 2

echo '<hr>';

echo 1234 . '<br>'; // dec
echo 0123 . '<br>'; // oct => 83 dec
echo 0o123 . '<br>'; // oct
echo 0x1A . '<br>'; // hex => 26 dec
echo 0b1111111 . '<br>'; // bin
echo 1_234_567 . '<br>'; // => 1234567

$a = 1.123;
$b = 1.2e3; // 1.2 * 10**3 => 1.2 * 1000 => 1200
$c = 7E-10; // 7 * 10**(-10) => 0.0000000007
$d = 1_234.567;
$inf = INF;
$mInf = -INF;
$notANumber = NAN;

$no  = false;
$yes = true;
$equ = $a == $b; // сравнение A равен ли B
$notEqu = $a != $b;
$equ = $a === $b; // проверкаа на абсолютное равенство A равен ли B
$notEqu = $a !== $b;
$lt  = $a < $b;
$lte = $a <= $b;
$gt  = $a > $b;
$gte = $a >= $b;

$cmp = $a <=> $b; // -1 = A > B; 0 = A == B; 1 = A < B

$and = $lte && $equ;
$or  = $gt || $lt;
$not = !$equ;
$and = $lte and $gt;
$xor = $lte xor $gt;
$or = $lte or $gt;

echo '<hr>"'.false.'"<br>"';
echo true . '"<br>';

// false, 0, '', '0', null, []  EQU false
echo '' ? 'TRUE ' : 'FALSE ';
echo '0' ? 'TRUE ' : 'FALSE ';
echo '1' ? 'TRUE ' : 'FALSE ';
echo 0 ? 'TRUE ' : 'FALSE ';
echo 1 ? 'TRUE ' : 'FALSE ';
echo null ? 'TRUE ' : 'FALSE ';
echo [] ? 'TRUE ' : 'FALSE ';
echo [0] ? 'TRUE ' : 'FALSE ';
echo [[]] ? 'TRUE ' : 'FALSE ';

echo ('0' + '1').'<hr>';

// STRING
echo 'string \n test $a\\ \' \"<br>';
echo "string \n test $a\\ \' \"<br>";

$heredoc = <<<END
    Тут какой-то 
    очень длинный 
    многострочный текст
    и можно вставлять переменные $a <br>
END;
echo $heredoc;

$nowdoc = <<<'CUSTOM_TEXT_END'
    Тут какой-то 
    очень длинный 
    многострочный текст
    и можно вставлять переменные $a <br>
CUSTOM_TEXT_END;
echo $nowdoc;

echo $a . 
    ' ' . 
    $b ; // конкатинация строк, т.е. сложение строк или добавление к первой строки в конец вторую строку
echo "$a $b<br><hr>";

// ARRAY
$a = array(1, array(2, array(5, 'text')), 3, 4);
$a = [1, [2, [5, 'text']], 3, 4];
$array = [1, 2, true, 'text', 4.4, false];
echo $array[0]; // => 1
echo $array[3]; // => text

$array[2] = 'true';
$array[10] = 'где-то далеко';
$array[] = 'new value';
$array['test'] = 'Это не числовой индекс';
$array2 = ['1' => 15, 5 => null, 'а это будет 6', 'test' => 'text', 'даже русские текст' => '???'];
unset($array2[1]);
$isKey = isset($array2[1]);
$isKey = array_key_exists(1, $array2);
$countElements = count($array2);
$keys = array_keys($array2);

echo implode(',', $keys);
$array = explode(',', '1,2,3,4,5,6');
echo implode(',', $array)."<br>\n";

print_r($array2);
print_r($keys);

if(true)
    echo 'TRUE';
else
    echo 'FALSE';

if($a > $b)
    echo 'a > b';
elseif($a < $b)
    echo 'a < b';
else
    echo 'a = b';

if(true)
    echo 'TEST';

if(true) {
    echo 'TEST 1<br>';
    echo 'TEST 2<br>';
}

// дополнительные функции для различной математике
$guess = rand(0,999); // получаем случайное число от 0 до 999
$str = ''.$guess;     // преобразуем число в строку
$len = strlen($str);    // узнать длину строки в байтах
$len = mb_strlen($str); // узнать длину строки в символах
$pos = strpos($str, $findstr); // возвращает индекс начала строки поиска, и FALSE, если искомая строка не найдена в строке
$pos = mb_strpos($str, $findstr); // возвращает индекс начала строки поиска, и FALSE, если искомая строка не найдена в строке
if($pos === false)
    echo 'Строка не найдена';

$round = round(5.0 / 2); // => 2.5 => 3
$int = (int)(5.0 / 2);   // => 2.5 => 2
$sin = sin(1.2);
$cos = cos(1.2);
$tang= tan(1.2);
$log = log(1.2);
$lten= log10(1.2);
//M_PI
//M_E
$pi = pi();
$power = pow(2, 0.5);
