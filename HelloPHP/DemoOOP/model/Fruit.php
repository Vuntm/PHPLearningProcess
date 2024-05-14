<?php
class Fruit{
    public $name;
    public $color;

    function getName(){
        return $this->name;
    }
    function getColor(){
        return $this->color;
    }
    function setName($name){
        $this-> name = $name;
    }
    function setColor($color){
        $this->color = $color;
    }

    function __construct($name, $color){
        $this->name = $name;
        $this->color = $color;
    }

    function __destruct(){
        echo" ".$this->name." ".$this->color."";
    }

}