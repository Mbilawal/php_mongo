<?php

session_start();

if(!isset($_SESSION['staff'])){
    header('location:../login.php');
}

include("db/Db.php");

//Get Collection From Db
$collection = $db->order;

if($_POST['type'] == 'detail'){

    //Find One Query 
    $order_arr = (array) $collection->findOne(['_id' => new MongoDB\BSON\ObjectID($_POST['id'])]);

    $response = '<div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Order Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <h2 style="display:none;" class="modal_error"></h5>
                            <form id="order_edit_form"  method="post" >';
                            
                                if(!empty($order_arr)){
                                    
                                    $response.='

                                    <br> Status <br>
                                    <select class="select" name="e_status" id="e_status">';
                                        
                                        $slec = '';
                                        if($order_arr['status'] == 0){
                                            $slec = 'selected';
                                        }
                                        $response.='<option value="0" '.$slec.'>Cart</option>';

                                        $slec2 = '';
                                        if($order_arr['status'] == 1){
                                            $slec2 = 'selected';
                                        }
                                        $response.='<option value="1" '.$slec2.'>In-Progress</option>';

                                        $slec3 = '';
                                        if($order_arr['status'] == 2){
                                            $slec3 = 'selected';
                                        }
                                        $response.='<option value="2" '.$slec3.'>Completed</option>';

                                        $slec4 = '';
                                        if($order_arr['status'] == 3){
                                            $slec4 = 'selected';
                                        }
                                        $response.='<option value="3" '.$slec4.'>Rejected</option>';
                                    
                                    $response.='
                                    </select>
                                    <br><br>';

                                }else{
                                    $response.='<p>No Record Found</p>';
                                }

                        $response .='
                    </form>
                </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" data_id="'.$_POST['id'].'" class="btn btn-primary save_order">Save changes</button>
                  </div>
                </div>
              </div>';

    echo $response;
    exit;

}

if($_POST['type'] == 'save'){

    $upd_arr = 
    [
       'status'   => $_POST['status'],
    ];

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