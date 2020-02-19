<?php


class HomepageController
{
    public $customers = array();
    public $products = array();

    public function __construct()
    {
        //create json  and objects products

        $products_json = file_get_contents('JSON/products.json');
        $products_array = json_decode($products_json, true);

        foreach ($products_array as $products) {
            array_push($this->products, $products['name'] = new Products ($products['name'], $products['id'], $products['description'], $products['price']));
        }

        //create json and objects customers
        $Customers_json = file_get_contents('JSON/customers.json');
        $Customers_array = json_decode($Customers_json, true);


        foreach ($Customers_array as $customer) {
            array_push($this->customers, $customer['name'] = new Customer ($customer['name'], $customer['id'], $customer['group_id']));
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
    }

// creates list to be displayed in the drop down menu, using previous function as parameter
    public function createProductsList($allProducts)
    {
        $list_array = array();
        for ($i = 0; $i < count($allProducts); $i++) {
            $list_item = "<option value =" . $allProducts[$i]->getId() . ">" . ucfirst(strtolower($allProducts[$i]->getName())) . "</option>";
            array_push($list_array, $list_item);
        }

        return implode('<br>', $list_array);
    }

//createProductsList($allProducts);

    public function createCustomerObject($all)
    {
        $list_array = array();
        for ($i = 0; $i < count($all); $i++) {
            $list_item = "<option>" . ucfirst(strtolower($all[$i]->getName())) . "</option>";
            array_push($list_array, $list_item);
        }
        return implode('<br>', $list_array);
    }

    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        /* if (isset($_POST['submit'])) {

             if ($_POST['customerName']) {


             }


             if ($_POST['productName']) {
                 foreach ($_SESSION ['products'] as $product) {
                     if ($product->getName() == $_POST['customerName']) {
                         echo $product;
                     }
                 }

             }
         }*/
        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }
}