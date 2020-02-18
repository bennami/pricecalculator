<?php

// getting all json files
$groups_json = file_get_contents('JSON/groups.json');

//decoding json files into arrays
$groups_array = json_decode($groups_json);
//var_dump($groups_array);


class Group
{
    private $id;
    private $name;
    private $variable_discount;
    private $group_id;

    public function __construct($id, $name, $variable_discount, $group_id ) {
        $this->id = $id;
        $this->name = $name;
        $this->variable_discount = $variable_discount;
        $this->group_id = $group_id;
    }

}