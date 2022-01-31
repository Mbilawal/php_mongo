<?php

session_start();

if(!isset($_SESSION['staff'])){
    header('location:login.php');
}

include("db/Db.php");

$where_arr = [];

if(isset($_POST['keyword'])){


    $keyword = $_POST['keyword'];
    $search_name = new MongoDB\BSON\Regex( ".*{$keyword}.*", 'i' );

    $where_arr['$or'][] = array('name' => $search_name);
    $where_arr['$or'][] = array('email' => $search_name);
    $where_arr['$or'][] = array('address' => $search_name);
}

$collection = $db->customer;
$get_product = $collection->find($where_arr);
$product_arr = iterator_to_array($get_product);

$response = '<tr>
                <th>Customer ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
              </tr>';

if(!empty($product_arr)){
    
    foreach($product_arr as $data){

        $response.='<tr>
                    <td>'.$data['_id'].'</td>
                    <td>'.$data['name'].'</td>
                    <td>'.$data['email'].'</td>
                    <td>'.$data['address'].'</td>
                    <td>
                        <button type="button" data_id="'.$data['_id'].'" class="btn btn-danger remove_product">Remove</button>
                    </td>
                  </tr>';
    }

}else{
    $response.='<tr>No Record Found</tr>';
}

echo $response;
exit;

?>