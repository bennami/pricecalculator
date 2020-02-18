<?php
declare(strict_types = 1);

if (isset($_POST['submit'])) {

    if ($_POST['customerName']) {

        var_dump($_POST['customerName']);
    }
    if ($_POST['productName']) {
       var_dump($_POST['productName']);
    }
    if ($_POST['Group']) {
        var_dump($_POST['Group']);
    }
}

// creates products objects and displaying name in list
function createProductsObject(){

    $products_json = file_get_contents('JSON/products.json');
    $products_array = json_decode($products_json,true);
    $allProducts =  array();

    foreach ($products_array as $products) {
     array_push($allProducts, $products['name'] = new Products ($products['name'], $products['id'], $products['description'], $products['price']));
    }

    $list_array = array();
    for($i=0; $i< count($allProducts); $i++){
        $list_item = "<option>" . ucfirst(strtolower($allProducts[$i]->getName())). "</option>";
         array_push($list_array, $list_item );
    }

    return implode('<br>', $list_array);
}

//var_dump(createProductsObject());

function createCustomerObject(){

    $Customers_json = file_get_contents('JSON/customers.json');
    $Customers_array = json_decode($Customers_json,true);
    $allCustomers =  array();

    foreach ($Customers_array as $customers) {
        array_push($allCustomers, $customers['name'] = new Customer ($customers['name'], $customers['id'], $customers['group_id']));
    }

    $list_array = array();
    for($i=0; $i< count($allCustomers); $i++){
        $list_item = "<option>" . ucfirst(strtolower($allCustomers[$i]->getName())). "</option>";
        array_push($list_array, $list_item );
    }

    return implode('<br>', $list_array);

}

function createGroupObject(){

    $Groups_json = file_get_contents('JSON/groups.json');
    $Groups_array = json_decode($Groups_json,true);
    $allGroups =  array();

    foreach ($Groups_array as $groups) {
        array_push($allGroups, $groups['name']  = new Group ($groups['id'], $groups['name'], $groups['variable_discount'], $groups['group_id']));
    }
    $list_array = array();
    for($i=0; $i< count($allGroups); $i++){
        $list_item = "<option>" . ucfirst(strtolower($allGroups[$i]->getName())). "</option>";
        array_push($list_array, $list_item );
    }

    return implode('<br>', $list_array);
}
//var_dump(createCustomerObject(),createGroupObject(),createProductsObject());

class HomepageController
{
    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        //this is just example code, you can remove the line below


        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }
}