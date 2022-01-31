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

    $where_arr['$or'][] = array('product_name' => $search_name);
    $where_arr['$or'][] = array('price' => $search_name);
    $where_arr['$or'][] = array('description' => $search_name);
    $where_arr['$or'][] = array('year' => $search_name);
    $where_arr['$or'][] = array('stocknumber' => $search_name);
}

$collection = $db->product;
$get_product = $collection->find($where_arr);
$product_arr = iterator_to_array($get_product);

$response = '<tr>
                <th>Product ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Year</th>
                <th>Stock</th>
                <th>Action</th>
              </tr>';

if(!empty($product_arr)){
    
    foreach($product_arr as $data){

        if($data['image']!=""){
            $data['image'] = '<img src="../assets/img/'.$data['image'].'" width="50px" height="50px" />';
        }

        $response.='<tr>
                    <td>'.$data['_id'].'</td>
                    <td>'.$data['image'].'</td>
                    <td>'.$data['product_name'].'</td>
                    <td>'.$data['price'].'</td>
                    <td>'.$data['year'].'</td>
                    <td>'.$data['stocks'].'</td>
                    <td>
                        <button type="button" data_id="'.$data['_id'].'" class="btn btn-danger remove_product">Remove</button>
                        <button type="button" data_id="'.$data['_id'].'" class="btn btn-warning edit_product">Edit</button>
                    </td>
                  </tr>';
    }

}else{
    $response.='<tr>No Record Found</tr>';
}

echo $response;
exit;

?>