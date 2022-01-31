<?php

session_start();

if(!isset($_SESSION['staff'])){
    header('location:login.php');
}

include("db/Db.php");

//Get Collection From Db
$collection = $db->product;

if($_POST['type'] == 'detail'){

    //Find One Query 
    $product_arr = $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_POST['id'])]);

    $response = '<div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h2 style="display:none;" class="modal_error"></h5>
                            <form id="product_edit_form"  method="post" enctype="multipart/form-data" >';
                            
                                if(!empty($product_arr)){
                                    $response.='
                                    <br> Product Name <br><input type="text" value="'.$product_arr['product_name'].'" id="e_name" >   <br><br>
                                    <br> Console Type <br><input type="text" value="'.$product_arr['console_type'].'" id="e_consoletype" >   <br><br>
                                    <br> Year <br><input type="number" value="'.$product_arr['year'].'" id="e_yeat" >   <br><br>
                                    <br> Stocks <br><input type="number" value="'.$product_arr['stocks'].'" id="e_stock" >   <br><br>
                                    <br> Price <br><input type="number" value="'.$product_arr['price'].'" id="e_price" >   <br><br>
                                    <br> Pic <br><input type="file" id="edit_attachment" >   <br><br>';

                                }else{
                                    $response.='<p>No Record Found</p>';
                                }

                        $response .='
                    </form>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" data_id="'.$_POST['id'].'" class="btn btn-primary save_product">Save changes</button>
                  </div>
                </div>
              </div>';

    echo $response;
    exit;

}

if($_POST['type'] == 'save'){

    $upd_arr = 
    [
       'product_name'   => $_POST['product_name'],
       'console_type'   => $_POST['console_type'],
       'price'          => $_POST['price'],
       'year'           => $_POST['year'],
       'stocks'         => $_POST['stocks'],
    ];

    if($_FILES['file']['name']!=""){
        $target_dir = "../assets/img/";
        $ext                        =   pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
        $file_name                  =   'attachment-'.date('YmdGis').'.'.$ext;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $file_name)) {
            $upd_arr['image'] = $file_name;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $collection->updateOne(
       ['_id' => new MongoDB\BSON\ObjectID($_POST['id'])],
       ['$set' => $upd_arr]
    );

    echo 1;
    exit;

}

if($_POST['type'] == 'remove'){

    //Remove Record for Product
    $collection->deleteOne(['_id' => new MongoDB\BSON\ObjectID($_POST['id'])]);

}


if($_POST['type'] == 'add_product'){

    $orig_date = new DateTime(date('Y-m-d G:i:s'));
    $orig_date=$orig_date->getTimestamp(); 
    $utcdatetime = new MongoDB\BSON\UTCDateTime($orig_date*1000);

    $ins_arr = 
    [
       'product_name'   => $_POST['product_name'],
       'console_type'   => $_POST['console_type'],
       'price'          => $_POST['price'],
       'year'           => $_POST['year'],
       'stocks'         => $_POST['stocks'],
       'created_date'   => $utcdatetime
    ];

    if($_FILES['file']['name'] != ""){

        $target_dir = "../assets/img/";
        $ext                        =   pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); 
        $file_name                  =   'attachment-'.date('YmdGis').'.'.$ext;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir . $file_name)) {
            $ins_arr['image'] = $file_name;
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $insertOneResult = $collection->insertOne($ins_arr);

    if($insertOneResult->getInsertedCount()){
        echo 1;
        exit;
    }else{
        echo 1;
        exit;
    }


}

if($_POST['type'] == 'add'){


    $response = '<div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Product</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h2 style="display:none;" class="modal_error"></h5>
                            <form id="product_edit_form"  method="post" enctype="multipart/form-data" >
                                <br> Product Name <br><input type="text" id="a_name" >   <br><br>
                                <br> Console Type <br><input type="text" id="a_consoletype" >   <br><br>
                                <br> Year <br><input type="number" id="a_yeat" >   <br><br>
                                <br> Stocks <br><input type="number" id="a_stock" >   <br><br>
                                <br> Price <br><input type="number" id="a_price" >   <br><br>
                                <br> Pic <br><input type="file" id="edit_attachment" >   <br><br>    
                            </form>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_add_product">Save changes</button>
                    </div>
                </div>
            </div>';

    echo $response;
    exit;

}

?>