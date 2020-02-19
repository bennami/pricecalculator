<?php


class HomepageController
{
    public $customers = array();
    public $products = array();

    public function __construct(){
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

        //create json Groups
        $Groups_json = file_get_contents('JSON/groups.json');
        $Groups_array = json_decode($Groups_json,true);
        $allGroups =  array();

        foreach ($Groups_array as $group) {
            //if value of these properties is null,  change it to a 0 or a string
            if (empty($group['variable_discount'])){
                $group['variable_discount'] = 0;
            }
            if (empty($group['fixed_discount'])){
                $group['fixed_discount'] = 0;
            }
            if (empty($group['group_id'])){
                $group['group_id'] = 'no';
            }

            //create array of group class objects
            array_push($allGroups, $group['name']  = new Group ($group['id'], $group['name'], $group['variable_discount'], $group['fixed_discount'], $group['group_id']));
        }
        var_dump($allGroups);
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
            $list_item = "<option >" . ucwords(strtolower($all[$i]->getName())) . "</option>";
            array_push($list_array, $list_item);
        }
        return implode('<br>', $list_array);
    }

    //render function with both $_GET and $_POST vars available if it would be needed.
    public function render(array $GET, array $POST)
    {
        if($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST)) {
           echo $customer_selected = $_POST ['customerName'];
           echo $product_selected = $_POST ['productName'];

           foreach ($this->customers as $customer) {

               if ($customer_selected == $customer->getName()) {
                   var_dump($customer);
               }
           }
           foreach($this->products as $product){

               if($product_selected == $product->getId()){
                   var_dump($product);
                   }
           }

        }else{
            $_POST["customerName"] =$_POST ["customerName"] =0;
            $_POST["productName"] =$_POST ["productName"] =0;
        }

        }
        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

        //load the view
        require 'View/homepage.php';
    }
}
function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}
//whatIsHappening();