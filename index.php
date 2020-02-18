<?php
declare(strict_types = 1);

//include all your model files here
require 'Model/customer.php';
require 'Model/products.php';
require 'Model/group.php';

//include all your controllers here
require 'Controller/HomepageController.php';

session_start();
if(!isset($_SESSION)){
//create json  and objects products
$allProducts =  [];
$products_json = file_get_contents('JSON/products.json');
$products_array = json_decode($products_json,true);

foreach ($products_array as $products) {
    array_push($allProducts, $products['name'] = new Products ($products['name'], $products['id'], $products['description'], $products['price']));
}

//create json and objects customers
$Customers_json = file_get_contents('JSON/customers.json');
$Customers_array = json_decode($Customers_json,true);
$allCustomers =  array();

foreach ($Customers_array as $customer) {
    array_push($allCustomers, $customer['name'] = new Customer ($customer['name'], $customer['id'], $customer['group_id']));
}

/*//create json Groups
$Groups_json = file_get_contents('JSON/groups.json');
$Groups_array = json_decode($Groups_json,true);
$allGroups =  array();

foreach ($Groups_array as $group) {
    array_push($allGroups, $group['name']  = new Group ($group['id'], $group['name'], $group['variable_discount'], $group['group_id']));
}*/

//save products, customers and groups in session

//$_SESSION['groups'] = $allGroups;

}else{
    $allProducts= $_SESSION['products'];
    $allCustomers = $_SESSION['customers'];
}

//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!
$controller = new HomepageController($allProducts, $allCustomers);
$controller->render($_GET, $_POST);
?>

