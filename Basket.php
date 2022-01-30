<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/basketCss.css">
        
    </head>
    
<body>
    <?php
    //including the php functions that we are going to use
include("navbarPHP.php");
outputNavBar("Basket");

?>
<!--Displaying the navigation bar-->

<h1>Basket</h1>

<div class="orders">
    <!-- the picture and the product name will be displayed here-->
<p><a>Game 1</a> <span class="price">$15<button>Remove from order</button></span></p>
<p><a>Game 2</a> <span class="price">$5<button>Remove from order</button></span></p>
<p><a>Game 3</a> <span class="price">$8<button>Remove from order</button></span></p>
<p><a>Game 4</a> <span class="price">$2<button>Remove from order</button></span></p>
<p><a>Game 5</a> <span class="price">$45<button>Remove from order</button></span></p>
<p><a>Game 6</a> <span class="price">$25<button>Remove from order</button></span></p>
<p><a>Game 7</a> <span class="price">$35<button>Remove from order</button></span></p>
<p><a>Game 8</a> <span class="price">$22<button>Remove from order</button></span></p>
</div>
<button class="btn"> Pay now</button>

</body>
</html>