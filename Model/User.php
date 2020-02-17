<?php
declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// getting all json files
$groups_json = file_get_contents('JSON/groups.json');

//decoding json files into arrays
$groups_array = json_decode($groups_json);
 //var_dump($customer_array, $groups_array, $products_array);


class Customer
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

