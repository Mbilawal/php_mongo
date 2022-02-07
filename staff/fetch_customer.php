<?php

session_start();
//checking if session is not set for staff then it goes into login page
if(!isset($_SESSION['staff'])){
    header('location:../login.php');
}

include("db/Db.php");

$where_arr = [];

if(isset($_POST['keyword'])){


    $keyword = $_POST['keyword'];
    $search_name = new MongoDB\BSON\Regex( ".*{$keyword}.*", 'i' );

    $or_arr = [];
    $or_arr['$or'][] = array('name' => $search_name);
    $or_arr['$or'][] = array('email' => $search_name);
    $or_arr['$or'][] = array('address' => $search_name);

    $where_arr['$and'][] = $or_arr;
}

$where_arr['$and'][] = ['role' => 0];

$collection = $db->customer;
$get_product = $collection->find($where_arr);
$product_arr = iterator_to_array($get_product);

$response = '<tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
              </tr>';

if(!empty($product_arr)){
    
    foreach($product_arr as $data){

        $response.='<tr>
                    <td>'.$data['_id'].'</td>
                    <td>'.$data['name'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['address'].'</td>
                    
                  </tr>';
    }

}else{
    $response.='<tr>No Record Found</tr>';
}

echo $response;
exit;

?>