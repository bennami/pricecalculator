<?php
declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// getting all json files
$customer_json = file_get_contents('../JSON/customers.json');
$groups_json = file_get_contents('../JSON/groups.json');
$products_json = file_get_contents('../JSON/products.json');

//decoding json files into arrays
$customer_array = json_decode($customer_json);
$groups_array = json_decode($groups_json);
$products_array = json_decode($products_json);

var_dump($customer_array, $groups_array, $products_array);



class User
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }
}

class Customer {


}
class Group_name {

}
class Products {

    public $name;
    public $description;
    public $price;

// every time an object is created, we pass the info we get from the user
    public function __construct($name, $description, $price ) {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;

    }

}