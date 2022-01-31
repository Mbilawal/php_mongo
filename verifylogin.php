<?php
include("db/Db.php");

$collection = $db->customer;

if(isset($_POST['userPass']) && isset($_POST['userMail'])){

    $where_arr = [];
    $where_arr['$and'][] = array('email' => 
                                    array(
                                        '$regex'    => '^'.$_POST['userMail'].'$',
                                        '$options'  => 'i'
                                    )
                                );

    $where_arr['$and'][] = ['password' => md5($_POST['userPass']) ];

    $user_arr = (array) $collection->findOne($where_arr);
    // $user_arr = iterator_to_array($get_user);
    
    if(!empty($user_arr)){

        session_start();
        
        $_SESSION = array(
            'logged_in'     => true,
            'admin_id'      =>  (string) $user_arr['_id'],
            'name'          =>  $user_arr['name'],
            'email'         =>  $user_arr['email'],
            'role'          =>  $user_arr['role']
        );

        if($user_arr['role'] == 0){
            
            $_SESSION['user'] = true;

            echo 1;
            exit;

        }elseif($user_arr['role'] == 1){

            $_SESSION['staff'] = true;

            echo 2;
            exit;
        }    

    }else{
        echo "No Record Found";
        exit;    
    }
}else{
    echo "ALL FIELDs REQUIRED";
    exit;
}
?>