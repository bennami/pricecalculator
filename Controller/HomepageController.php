<?php


class HomepageController
{
    public $customers;
    public $products;

    public function __construct($p,$c)
    {
        $this->products = $p;
        $this->customers = $c;
    }

// creates list to be displayed in the drop down menu, using previous function as parameter
    public function createProductsList($allProducts){
        $list_array = array();
        for($i=0; $i< count($allProducts); $i++){
            $list_item = "<option value =".$allProducts[$i]->getId().">" . ucfirst(strtolower($allProducts[$i]->getName())). "</option>";
            array_push($list_array, $list_item );
        }

        return implode('<br>', $list_array);
    }
//createProductsList($allProducts);

   public function createCustomerObject($all){
        $list_array = array();
        for($i=0; $i< count($all); $i++){
            $list_item = "<option>" . ucfirst(strtolower($all[$i]->getName())). "</option>";
            array_push($list_array, $list_item );
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