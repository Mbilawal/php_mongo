<?php

//Start session
session_start();

//Destroy Lougout the session
session_destroy();

//Redirect to the Login
 header('location:login.php');

?>