<?php
/*include("vendor/autoload.php");

$client = new MongoDB\Client(
    'mongodb://localhost:27017/test?retryWrites=true&w=majority'
);

$db = $client->test;

$collection = $db->users;

$insertOneResult = $collection->insertOne([
   'username'   => 'admin',
   'email'      => 'admin@gmail.com',
   'name'       => 'Admin User',
   'role'       => 1,
   'password'   => md5('12345')
]);
// printf("Inserted %d document(s)\n", $insertOneResult->getInsertedCount());
// var_dump($insertOneResult->getInsertedId());

if($insertOneResult->getInsertedCount()){
  
    $collection->updateOne(array('_id' => $insertOneResult->getInsertedId()), [
       'id'   => (string) $insertOneResult->getInsertedId()
    ]);
}*/

// echo "<pre>";
// print_r($db->showcollection());
// exit;
?>

<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
}?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assets/css/productCSS.css">
</head>
<!--Displaying the navigation bar-->
<?php
include("navbarPHP.php");
outputNavBar("Login");
?>
<!--Displaying the navigation bar-->

<!--Displaying all the products for the users-->
<h1> Product page </h1>
<body>
<div class="row">
    <div class="col">
        <img src="assets/img/product6.jpg" class ="one"> <p>10.35£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product7.jpg" class ="one"><p>20.00£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product.jpg" class ="one"><p>23.99£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product9.jpg" class ="one"> <p>10.99£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product8.jpg" class ="one"> <p>21.99£</p>
        <button>Put in basket</button>
    </div>
</div>
<div class="row">
    <div class="col">
        <img src="assets/img/product1.jpg" class ="one"> <p>10.35£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product2.jpg" class ="one"><p>20.00£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product3.jpg" class ="one"><p>23.99£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product4.jpg" class ="one"> <p>10.99£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product5.jpg" class ="one"> <p>21.99£</p>
        <button>Put in basket</button>
    </div>
</div>

<div class="row">
    <div class="col">
        <img src="assets/img/product11.jpg" class ="one"> <p>10.35£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product12.jpg" class ="one"><p>20.00£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product13.jpg" class ="one"><p>23.99£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product14.jpg" class ="one"> <p>10.99£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="assets/img/product15.jpg" class ="one"> <p>21.99£</p>
        <button>Put in basket</button>
    </div>
</div>

</body>
</html>