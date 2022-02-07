<?php


function outputNavBar($pageNames){
    echo '<ul class="topheader">';
    $pageNames= array("Main",  "Basket", "Orders", "Logout");
    $AddresLink= array("homePage.php",  "Basket.php", "Orders.php", "logout.php");

    for($i = 0; $i < count($pageNames); $i++){
        echo '<li><a class=custom';
        echo ' href="'. $AddresLink[$i] . '">' . $pageNames[$i] . '</a></li>';
    }
    echo '</ul>';
}
