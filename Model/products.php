<?php


class Products
{
    public $name;
    public $id;
    public $description;
    public $price;

// every time an object is created, we pass the info we get from the user
    public function __construct($name, $id, $description, $price ) {
        $this->name = $name;
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
    }
}