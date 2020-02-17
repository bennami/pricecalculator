<?php
declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// getting all json files
$customer_json = file_get_contents('JSON/customers.json');
$groups_json = file_get_contents('JSON/groups.json');


//decoding json files into arrays
$customer_array = json_decode($customer_json);
$groups_array = json_decode($groups_json);


 //var_dump($customer_array, $groups_array, $products_array);

 function get_names()
 {
     $list_array = array();
     $products_json = file_get_contents('JSON/products.json');
     $products_array = json_decode($products_json);

     for ($i = 0; $i < count($products_array); $i++) {
         $list_item = "<option>" . $products_array[$i]->name . "</option>";
         array_push($list_array, $list_item);
     }
     return implode('<br>', $list_array);
 }
 get_names();

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