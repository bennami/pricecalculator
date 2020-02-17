<?php

// getting all json files
$groups_json = file_get_contents('JSON/groups.json');

//decoding json files into arrays
$groups_array = json_decode($groups_json);
//var_dump($customer_array, $groups_array, $products_array);



class Group
{

}