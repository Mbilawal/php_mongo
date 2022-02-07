<?php
session_start();

if(!isset($_SESSION['user'])){
    header('location:login.php');
}

include("db/Db.php");

$collection = $db->order;

if(isset($_POST['product_id']) && isset($_POST['price'])){

    //Order Date
    $orig_date = new DateTime(date('Y-m-d G:i:s'));
    $orig_date=$orig_date->getTimestamp(); 
    $utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);

    //Insert Cart Order
    $insertOneResult = $collection->insertOne([
       'productid'      => new MongoDB\BSON\ObjectID($_POST['product_id']),
       'customerid'     => new MongoDB\BSON\ObjectID($_SESSION['admin_id']),
       'price'          => (int) $_POST['price'],
       'created_date'   => $utcdatetime,
       'status'         => 0
    ]);

    //Check if Inserted Order
    if($insertOneResult->getInsertedCount()){  
        echo 1;
        exit;
    }

    echo 0;
    exit;

}else{
    echo 0;
    exit;
}

?>