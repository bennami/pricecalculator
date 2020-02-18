<?php
declare(strict_types = 1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


class Customer
{
    private $name;
    private $id;
    private $groupId;

    public function __construct( $name, $id, $groupId)
    {
        $this->name = $name;
        $this->id = $id;
        $this->groupId = $groupId;
    }

    public function getName() : string
    {
        return $this->name;
    }
}


