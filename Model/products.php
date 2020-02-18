<?php


class Products
{
    private $name;
    private $id;
    private $description;
    private $price;

// every time an object is created, we pass the info we get from the user
    public function __construct($name, $id, $description, $price ) {
        $this->name = $name;
        $this->id = $id;
        $this->description = $description;
        $this->price = $price;
    }

    public function getName():string{
       return $this->name;
    }

    public function getId(): int{
        return $this->id;
    }




}