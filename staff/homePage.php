<?php
session_start();

if(!isset($_SESSION['staff'])){
    header('location:login.php');
}

include("db/Db.php");

//Product Count
$product_count = $db->product->count();

//User Count
$customer_arr = $db->customer->count(['role' => 0]);

//Order Count
$order_arr = $db->order->count(); ?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/homeCSS.css">
</head>
<?php
include("navbarPHP.php");
outputNavBar("Login");
?>
<!--Displaying the navigation bar-->

<!-- <h1> Home page </h1> -->


<body>
<p class="products">DASHBOARD:</label>
<div class="row">
    <div class="col">
        <div class="custom_block">
            <h2>TOTAL PRODUCTS</h2>
            <p><?php echo $product_count; ?></p>
        </div>
    </div>
    <div class="col">
        <div class="custom_block">
            <h2>TOTAL CUSTOMER</h2>
            <p><?php echo $customer_arr; ?></p>
        </div>
    </div>
    <div class="col">
        <div class="custom_block">
            <h2>TOTAL ORDERS</h2>
            <p><?php echo $order_arr; ?></p>
        </div>
    </div>
</div>


</body>
</html>
