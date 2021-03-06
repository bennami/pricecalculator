<?php


class HomepageController
{
    private $customers = array();
    private $products = array();
    private $groups = array();


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

        //create json Groups
        $Groups_json = file_get_contents('JSON/groups.json');
        $Groups_array = json_decode($Groups_json, true);

        foreach ($Groups_array as $group) {
            //if value of these properties is null,  change it to a 0 or a string
            if (empty($group['variable_discount'])) {
                $group['variable_discount'] = 0;
            }
            if (empty($group['fixed_discount'])) {
                $group['fixed_discount'] = 0;
            }
            if (!isset($group['group_id'])) {
                $group['group_id'] = 'no';
            }

            //create array of group class objects
            array_push($this->groups, $group['name'] = new Group ($group['id'], $group['name'], $group['variable_discount'], $group['fixed_discount'], $group['group_id']));
        }

        //var_dump($this->groups);

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

    public function getChosenOne($customer_selected)
    {
        foreach ($this->customers as $chosenOne) {

            if ($customer_selected == $chosenOne->getName()) {
                //group Id
                return $chosenOne;
            }
        }

    }

    public function getChosenProduct($product_selected)
    {
        foreach ($this->products as $chosenProduct) {

            if ($product_selected == $chosenProduct->getId()) {
                return $chosenProduct;
            }
        }

    }


//render function with both $_GET and $_POST vars available if it would be needed.
    public function render()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST)) {
                $customer_selected = $_POST ['customerName'];

                //this is the id of the product
                $product_selected = $_POST ['productName'];

                //chosen customer object
                $foundHim = $this->getChosenOne($customer_selected);

                foreach ($this->products as $chosenProduct) {

                    if ($product_selected == $chosenProduct->getId()) {

                        //var_dump($chosenProduct);

                    }
                }

                //this is where all chosen groups go
                $allChosenGroups = [];

                //get group that belongs to customer
                foreach ($this->groups as $group) {
                    if ($foundHim->getGroupId() == $group->getId()) {
                        $chosenGroup = $group;
                        // var_dump($chosenGroup);
                        array_push($allChosenGroups, $chosenGroup);
                        $chosenGroup->getVariableDiscount();
                        $chosenGroup->getFixedDiscount();
                    }
                }

                //get group that belongs  to chosen group, this does not always exist
                foreach ($this->groups as $group) {
                    if ($chosenGroup->getGroupId() == $group->getId()) {
                        $nestedGroup = $group;
                        //  var_dump($nestedGroup);
                        array_push($allChosenGroups, $nestedGroup);
                        $nestedGroup->getVariableDiscount();
                        $nestedGroup->getFixedDiscount();
                    }
                }

                //get company group
                foreach ($this->groups as $group) {
                    if ($nestedGroup->getGroupId() == $group->getId()) {

                        $superNestedGroup = $group;
                        // var_dump($superNestedGroup);
                        array_push($allChosenGroups, $superNestedGroup);

                    }
                }

                //get variable discounts and fixed discounts into corresponding arrays
                $allVariableDiscounts = [];
                $allFixedDiscounts = [];
                foreach ($allChosenGroups as $group) {
                    array_push($allVariableDiscounts, $group->getVariableDiscount());
                    array_push($allFixedDiscounts, $group->getFixedDiscount());

                }
                // var_dump($allChosenGroups, $allVariableDiscounts, $allFixedDiscounts);

                //get highest value of variable discount array, this will be a percentage
                $largestVariableDiscount = max($allVariableDiscounts);
                $largestVariableDiscount;

                //getting the substraction of fixed discount array
                $sumFixedDiscount = array_sum($allFixedDiscounts);
                $totalWithFixedDiscount = 0;

                // for fixed prices which are higher than the original price
                if ($sumFixedDiscount > $this->getChosenProduct($product_selected)->getPrice()) {
                    echo '<br>' . $sumFixedDiscount . ' &#8364';
                    echo '<br>' . 'Fixed price is higher than the original price. Fixed discount is not applicable';
                } else {
                    $totalWithFixedDiscount = $this->getChosenProduct($product_selected)->getPrice() - $sumFixedDiscount;
                    echo '<br>' . 'fixed price discount is ' . $sumFixedDiscount . ' &#8364' . '<br>';
                    echo $totalWithFixedDiscount . ' &#8364';
                }
                //discount with variable discount array

                $totalWithVariableDiscount = $this->getChosenProduct($product_selected)->getPrice() * ((100 - $largestVariableDiscount) / 100);

                echo '<br>' . 'variable discount is ' . $largestVariableDiscount . ' %';
                echo '<br>' . round($totalWithVariableDiscount, 2) . ' &#8364';

                if ($totalWithFixedDiscount > $totalWithVariableDiscount) {
                    echo '<br>' . "It's recommended to give you a variable discount of $largestVariableDiscount %";
                    echo '<br>' . round($totalWithVariableDiscount, 2) . ' &#8364';
                } else {
                    echo '<br>' . "It's recommended to give you a fixed discount of $sumFixedDiscount . '&#8364'";
                    echo '<br>' . 'Total to pay with discounts :' . $totalWithFixedDiscount . ' &#8364' . '<br>';
                }

                $price_discounts = $totalWithFixedDiscount * ((100 - $largestVariableDiscount) / 100);
                echo '<br>' . 'Price with both discounts is ' . round($price_discounts, 2) . ' &#8364';


            } else {
                $_POST["customerName"] = $_POST ["customerName"] = 0;
                $_POST["productName"] = $_POST ["productName"] = 0;
            }

        }

        //var_dump($chosenProduct);
        //you should not echo anything inside your controller - only assign vars here
        // then the view will actually display them.

//var_dump($this->products);

        //load the view
        require 'View/homepage.php';
    }
}

function whatIsHappening()
{
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