<?php

namespace DATA;

class Model {
    private array $fields = [];
    public int $id;
    
    function __construct($data = null)
    {
        if($data === null) return;
        $this->id = $data['id'];
        unset($data['id']);
        $this->fields = $data;
    }

    function __get($name) {
        if($name == 'id')
            return $this->id;

        return $this->fields[$name] ?? null;
    }

    function __set($name, $value) {
        if($name == 'id')
            $this->id = $value;
        else
            $this->fields[$name] = $value;
    }

    function __isset($name){
        return array_key_exists($name, $this->fields);
    }

    function __unset($name){
        unset($this->fields[$name]);
    }

    function getData(){
        $data = $this->fields;
        $data['id'] = $this->id;
        return $data;
    }
}