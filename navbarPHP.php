<?php


function outputNavBar($pageNames){
    echo '<ul class="topheader">';
    $pageNames= array("Main", "Registration", "Login", "Basket", "Products");
    $AddresLink= array("homePage.php", "Register.php", "login.php", "Basket.php", "Product.php");

    for($i = 0; $i < count($pageNames); $i++){
        echo '<li><a class=custom';
        echo ' href="'. $AddresLink[$i] . '">' . $pageNames[$i] . '</a></li>';
    }
    echo '</ul>';
}
