<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Price calculator PHP</title>
    <!-- CSS links (Bootstrap) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<?php require 'includes/header.php' ?>
<section>
    <form method="post">
        <div class="dropdown">
            <label for="exampleFormControlSelect2">Our Customers</label>
            <select multiple class="form-control" name="customerName" id="exampleFormControlSelect2">
                <?php echo $this->createCustomerObject($this->customers); ?>
            </select>
        </div>

        <label for="exampleFormControlSelect2">Our Products</label>
        <select multiple class="form-control" name="productName" id="exampleFormControlSelect2">
            <?php echo $this->createProductsList($this->products); ?>
        </select>

        <input class="btn btn-primary" type="submit" name="submit" value="Submit">
    </form>
</section>
<section>
    <p> <?php if (isset($customer_selected)) {
            echo $this->getChosenOne($customer_selected)->getName();
        } ?></p>
    <div name="description">Product name: <?php if (isset($product_selected)) {
            echo $this->getChosenProduct($product_selected)->getName();
        } ?> </div>
    <div name="description">Product ID: <?php if (isset($product_selected)) {
            echo $this->getChosenProduct($product_selected)->getId();
        } ?> </div>
    <div name="description">Product description: <?php if (isset($product_selected)) {
            echo $this->getChosenProduct($product_selected)->getDescription();
        } ?> </div>
    <div name="price">Price: <?php if (isset($product_selected)) {
            echo $this->getChosenProduct($product_selected)->getPrice();
        } ?> </div>
</section>
<?php require 'includes/footer.php' ?>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>
</html>