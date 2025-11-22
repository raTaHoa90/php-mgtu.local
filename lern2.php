<?php
$cars = ['bmw', 'audi', 'kia', 'vaz'];

$i = 0;
echo '<h3>WHILE</h3><ul>';
while($i < count($cars)) {
    echo '<li>'.$cars[$i].'</li>';
    //$i = $i + 1;
    //$i += 1;
    $i++;
}
echo '</ul><hr>';

$i = 0;
echo '<h3>DO WHILE</h3><ul>';
do {
    echo '<li>'.$cars[$i].'</li>';
    $i++;
} while ($i < count($cars));
echo '</ul><hr>';

echo '<h3>FOR</h3><ul>';
for($i = 0; $i < count($cars); $i++)
    echo '<li>'.$cars[$i].'</li>';
echo '</ul><hr>';

echo '<h3>FOREACH (value)</h3><ul>';
foreach($cars as $car)
    echo "<li>$car</li>";
echo '</ul><hr>';

echo '<h3>FOREACH (key => value) </h3><ul>';
foreach($cars as $i => $car)
    echo "<li>$car($i)</li>";
echo '</ul><hr>';

$arr = &$cars;

$arr[] = 'kamaz';

echo '<h3>FOREACH (key => ref value)</h3>';
print_r($cars);
echo '<ul>';
foreach($cars as $i => &$car) {
    $car .= "($i)";
    //$car = $car . "($i)";
    echo "<li>$car</li>";
}
echo '</ul>';
print_r($cars);
echo '<hr>';

print_r($arr);

$a = 'b';
$b = 'c';
$c = 'd';
$d = 123;

echo '<br>'.$$$$a.' '; // => $$$b => $$c => $d => 123
$$$$a = 321;
echo $d.' ';

$func = 'count';
echo $func($cars);