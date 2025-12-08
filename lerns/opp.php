<?php

class BaseObject {

    const DEFAULT_CITY = "Москва";

    public $name;
    protected $_city;
    private $_age;

    static private $_countObjects = 0;
    static function count(): int {
        return static::$_countObjects;
    }

    function __construct(string $name, int $age, string $city = self::DEFAULT_CITY) {
        $this->name = $name;
        $this->_city = $city;
        $this->_age = $age;

        static::$_countObjects++;
        //echo static::class.' ';
        //echo self::class.' ';
    }

    function speak(){
        echo 'my name is '.$this->getName().' (age = '.$this->_age.')<br>';
    }

    function getName():string {
        return $this->name;
    }

    protected function getAge(){
        return $this->_age;
    }
}

class Human extends BaseObject {
    function getName():string {
        return ' human '.$this->name.' city='.$this->_city;
    }

    private function infoOne($a){
        return $a * 2;
    }

    private function infoTwo($a, $b){
        return $a + $b;
    }

    private function infoThree($a, $b, $c){
        return ($a + $b) / $c;
    }

    function info(...$args){
        switch(count($args)){
            case 1: return $this->infoOne($args[0]);
            case 2: return $this->infoTwo(...$args);
            case 3: return $this->infoThree(...$args);
        }
        return null;
    }
}

class Animal extends BaseObject {
    public $breed;

    function __construct(string $name, int $age, $bread)
    {
        parent::__construct($name, $age);
        $this->breed = $bread;
    }

    function getName():string {
        return ' animal ('. $this->breed .') '.parent::getName().' city='.$this->_city;
    }
}

class SuperClass {
    private array $_fields = [];

    /**
     * Конструктор объекта, собирает объект и позволяет инициировать данные внутри объекта
     */
    function __construct(array $ar = []){
        $this->_fields = $ar;
    }

    /**
     * Геттер, вызывается тогда, когда указанного в коде поля не существует
     */
    function __get($name) {
        return $this->_fields[$name] ?? null;
    }

    /**
     * Сеттер, вызывается тогда, когда под несуществующее поле, 
     * пытаются что-то сохранить
     */
    function __set($name, $value) {
        $this->_fields[$name] = $value;
    }

    /**
     * Вызывается тогда, когда необходимо проверить 
     * существование поля в объекте
     */
    function __isset($name) {
        return isset($this->_fields[$name]);
    }

    /**
     * Вызывается вместо несуществующего метода, с указанием его имени
     */
    function __call($name, $arguments)
    {
        return $name.'('.count($arguments).')';
    }

    /**
     * аналогично __call, но для статики
     */
    static function __callStatic($name, $arguments)
    {
        return 'static '.$name.'('.count($arguments).')';
    }


    /**
     * Вызывается когда объект уже нигде не нужен и 
     * сборщик мусора хочет его уничтожит
     */
    function __destruct()
    {
        
    }

    /**
     * Вызывается, когда ключ пытаются уничтожить
     */
    function __unset($name) {
        unset($this->_fields[$name]);
    }

    /**
     * вызывается, когда PHP уходит в сон
     * тут можно например описать отключение от БД или други ресурсов, что бы за зря их не держать
     */
    function __sleep() {
        
    }

    /**
     * вызывается, когда PHP возвращается из спящего режима
     * тут можно например переподключиться к БД или переоткрыть файл
     */
    function __wakeup()
    {
        
    }

    /**
     * вызывается когда объект пытаются преобразовать в строку
     */
    function __toString()
    {
        return 'count('.count($this->_fields).')';
    }

    /**
     * вызывается, когда мы пытаемся клонировать объект (clone)
     */
    function __clone()
    {
        $new = new static();
        
        // $new2 = new self();
        // $new3 = new Superclass();

        $new->_fields = $this->_fields;
        return $new;
    }

    /**
     * Вызывается, когда мы хотим получить дамп объекта через var_dump
     */
    function __debugInfo()
    {
        return $this->_fields;
    }

    /**
     * Вызывается при сериализации объекта
     */
    function __serialize(): array
    {
        return $this->_fields;
    }

    /**
     * Обратные действия __serialize
     */
    function __unserialize(array $data): void
    {
        $this->_fields = $data;
    }

    /**
     * Вызывается, когда объект пытаются использовать как функцию
     */
    function __invoke($name)
    {
        return $this->_fields[$name] ?? null;
    }
}


$human = new Human('Максим', 38,'Краснодар');
$duck = new Animal('Гага', 1, "Утка");
$dog = new Animal('Рекс', 5, "Собака");
$cat = new Animal("Пушок", 3, "Кошка");

echo BaseObject::count().'<br>';

$entities = [$human, $duck, $dog, $cat];
foreach($entities as $entity)
    $entity->speak();

//$str = serialize($obj);
//$obj = unserialize($str);

echo $human->info(15).' '.$human->info(5,6).' '.$human->info(4,3,2);

$nm = 'name';
$md = "info";
//var_dump($human);
$human->$nm = 'Иван';
//var_dump($human);

echo '<br>'.$human->name.' '.$human->$nm.' '.$human->$md(9);

$obj = (object)[
    'name' => 'test',
    'age' => 10
];

$obj->test = '123';
var_dump($obj);

$h = clone $human;

//==================================
echo '<hr>';

$super = new Superclass();
$super->test = 1;
$super->test2 = "value";
if(!isset($super->test3)) echo 'test3 not Found<br>';
var_dump($super);

echo $super->test . ' ' . $super->method(1,2,3).'<br>';
echo Superclass::method2(3,2,1,0,4,5);

echo '<hr>';
var_dump($super);
$serSuper = serialize($super);
echo $serSuper.'<br>';
$super2 = unserialize($serSuper);
var_dump($super2);

echo $super("test");