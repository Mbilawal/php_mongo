<?php
include("db/Db.php");

$collection = $db->customer;

if(isset($_POST['userPass']) && isset($_POST['userMail'])  && isset($_POST['userName'])  && isset($_POST['userAddress'])){

    $where_arr = [];
    $where_arr['$and'][] = array('email' => 
                                    array(
                                        '$regex'    => '^'.$_POST['userMail'].'$',
                                        '$options'  => 'i'
                                    )
                                );

    $where_arr['$and'][] = array('role' => 0);
    
    //Find One Query 
    $user_arr = (array) $collection->findOne($where_arr);

    if(empty($user_arr)){

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
        echo "USER ALREADY REGISTERED";
        exit;    
    }

}else{
    echo "ALL FIELDs REQUIRED";
    exit;
}


?>