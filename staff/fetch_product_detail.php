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
                            <form id="product_edit_form" >';
                            
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


    $target_dir = "../assets/img/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $upd_arr = 
    [
       'product_name'   => $_POST['product_name'],
       'console_type'   => $_POST['console_type'],
       'price'          => $_POST['price'],
       'year'           => $_POST['year'],
       'stocks'         => $_POST['stocks'],
       // 'image'          => $_POST['image'],
    ];

    // Check if $uploadOk is set to 0 by an error
    if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
        $upd_arr['image'] = $_FILES["file"]["tmp_name"];
        // echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
    }else{
        echo "Sorry, there was an error uploading your file.";
        exit;
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

?>