<?php
declare(strict_types = 1);

if (isset($_POST['submit'])) {

    if ($_POST['customerName']) {
        $client = new Customer($_POST['customerName']);
        var_dump($client);
    }
    if ($_POST['productName']) {
        var_dump($_POST['productName']);
    }
}

// getting customers name and displaying them into an array
function get_customer() {
    $list_arrayII = array();
    $customer_json = file_get_contents('JSON/customers.json');
    $customer_array = json_decode($customer_json);

    for ($i = 0; $i < count($customer_array); $i++) {
        $list_itemII = "<option>" . ucwords(strtolower($customer_array[$i]->name)). "</option>";
        array_push($list_arrayII, $list_itemII);
    }
    return implode('<br>', $list_arrayII);
}
get_customer();

// getting products name and displaying them into an array
function get_names() {
    $list_array = array();
    $products_json = file_get_contents('JSON/products.json');
    $products_array = json_decode($products_json);

    for ($i = 0; $i < count($products_array); $i++) {
        $list_item = "<option>" . ucfirst(strtolower($products_array[$i]->name)). "</option>";
        array_push($list_array, $list_item);
    }
    return implode('<br>', $list_array);
}
get_names();

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

