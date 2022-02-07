<?php

session_start();

if(!isset($_SESSION['user'])){
    header('location:login.php');
}

include("db/Db.php");

$where_arr = [];
//checks for keywords in search bar
if(isset($_POST['keyword'])){
    $keyword = $_POST['keyword'];
    $search_name = new MongoDB\BSON\Regex( ".*{$keyword}.*", 'i' );

    $where_arr['$or'][] = array('product_name' => $search_name);
    $where_arr['$or'][] = array('price' => $search_name);
    $where_arr['$or'][] = array('description' => $search_name);
    $where_arr['$or'][] = array('year' => $search_name);
    $where_arr['$or'][] = array('stocknumber' => $search_name);
}

//Get Db Collection
$collection = $db->product;

//Find Products
$get_product = $collection->find($where_arr);
$product_arr = iterator_to_array($get_product);


$response = '';
$cc = 0;

if(!empty($product_arr)){
    foreach($product_arr as $data){

        if(isset($data['image'])){
            $data['image'] = '<img src="assets/img/'.$data['image'].'" class ="one" />';
        }else{
            $data['image'] = '<img src="assets/img/empty_user.png" class ="one" />';
        }

        $dd = $cc % 5;
        if($dd == 0){

            if($cc != 0){
                $response.='</div>';
            }

            $response.='<div class="row">';
        }
            
        $response.='<div class="col">
                        '.$data['image'].' 
                        <p>'.$data['product_name'].'£</p>
                        <p>'.$data['price'].'£</p>
                        <button class="add_product_cart" price="'.$data['price'].'" data_id="'.$data['_id'].'">Put in basket</button>
                    </div> <br><br>';
        
        // $zz = $cc % 4;
        // if($zz == 0){
        //     $response.='</div>';
        // }               
        $cc++;
    }

}else{
    $response.='<div class="row"><h4>No Record Found</h4></div>';
}

echo $response;
exit;

?>