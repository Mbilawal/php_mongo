<?php
session_start();

if(!isset($_SESSION['user'])){
    header('location:login.php');
}

include("db/Db.php");


//Get Only Customer Order
$where_arr = [];
$where_arr = ['customerid' => new MongoDB\BSON\ObjectID($_SESSION['admin_id'])];

$collection = $db->order;
$get_order = $collection->find($where_arr);
$order_arr = iterator_to_array($get_order);

$response = '<tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Customer Email</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Status</th>
                <th>Created Date</th>
              </tr>';

if(!empty($order_arr)){    
    foreach($order_arr as $data){

        //Get Customer Name
        $customer_arr = $db->customer->findOne(['_id' => new MongoDB\BSON\ObjectID($data['customerid'])]);

        //Get Product Name
        $product_arr = $db->product->findOne(['_id' => new MongoDB\BSON\ObjectID($data['productid'])]);
        
        //Order Status
        if($data['status'] == 0){
            $data['status'] = '<span class="label label-default">Cart</span>';
        }elseif($data['status'] == 1){
            $data['status'] = '<span class="label label-warning">In Progress</span>';
        }elseif($data['status'] == 2){
            $data['status'] = '<span class="label label-success">Completed</span>';
        }elseif($data['status'] == 3){
            $data['status'] = '<span class="label label-danger">Rejected</span>';
        }

        //Convert Mongo Date to Datetime
        $datetime   =   date("Y-m-d G:i:s", (string) $data['created_date']/1000);

        $response.='<tr>
                    <td>'.$data['_id'].'</td>
                    <td>'.$customer_arr['name'].'</td>
                    <td>'.$customer_arr['email'].'</td>
                    <td>'.$product_arr['product_name'].'</td>
                    <td>'.$data['price'].'</td>
                    <td>'.$data['status'].'</td>
                    <td>'.$datetime.'</td>
                  </tr>';
    }

}else{
    $response.='<tr>No Record Found</tr>';
}

echo $response;
exit;

?>