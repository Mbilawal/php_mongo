<?php
include("db/Db.php");

$collection = $db->customer;

if(isset($_POST['userPass']) && isset($_POST['userMail'])  && isset($_POST['userName'])  && isset($_POST['userAddress'])){

    $insertOneResult = $collection->insertOne([
       'email'      => $_POST['userMail'],
       'name'       => $_POST['userName'],
       'role'       => 0,
       'password'   => md5($_POST['userPass']),
       'address'    => $_POST['userAddress']
    ]);

    if($insertOneResult->getInsertedCount()){

        echo "USER SUCCESSFULLY REGISTERED";
        exit;

    }else{
        echo "ERROR ON REGISTER RECORD";
        exit;    
    }
}else{
    echo "ALL FIELDs REQUIRED";
    exit;
}


?>