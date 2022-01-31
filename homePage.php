<?php
session_start();

if(!isset($_SESSION['logged_in'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/homeCSS.css">
</head>
<?php
include("navbarPHP.php");
outputNavBar("Login");
?>
<!--Displaying the navigation bar-->

<h1> Home page </h1>

<input class="search"  type="text" name="search" class="searching" id="search">
<button class=" process">Search</button>

<body>


<p class="products">Popular products:</label>
<div class="row">
    <div class="col">
        <img src="product6.jpg" class ="one"> <p>10.35£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="product7.jpg" class ="one"><p>20.00£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="product8.jpg" class ="one"><p>23.99£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="product9.jpg" class ="one"> <p>10.99£</p>
        <button>Put in basket</button>
    </div>
    <div class="col">
        <img src="produvt10.jpg" class ="one"> <p>21.99£</p>
        <button>Put in basket</button>
    </div>
</div>


</body>
</html>
