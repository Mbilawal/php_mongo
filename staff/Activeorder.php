<?php
session_start();

if(!isset($_SESSION['staff'])){
    header('location:../login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../assets/css/productCSS.css">
    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
        input#search {
            height: 30px;
        }
    </style>
</head>
<!--Displaying the navigation bar-->
<?php
include("navbarPHP.php");
outputNavBar("Login");
?>
<!--Displaying the navigation bar-->

<!--Displaying all the products for the users-->
<body>
    <div class="container">
        <h1> Order Listing </h1>
        <br>
        <br>
        <span class="left">
            <!-- <input class="search"  type="text" name="search" placeholder="Search Order" class="searching" id="search">
            <button class="process search_keyword">Search</button> -->
        </span>
        <br>
        <table  class="table">
          
        </table>
    </div>

    <div id="editorder_model" class="modal hide" tabindex="-1" role="dialog">
      
    </div>

<script src="../assets/js/jquery-1.11.1.min.js"> </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(e) {
        
        //Get Order Listing Through Ajax
        function fetch_order() {
            
            $.ajax({
                url : "fetch_order.php",
                type: "POST",
                data : "",
                success:function(response) 
                {
                    $('.table').html(response);
                }
            });
        }

        fetch_order();

        //Click Event through Jquery AJAX
        $("body").on("click",".edit_order",function(e){
            
            var id = $(this).attr('data_id');

            $.ajax({
                url : "fetch_order_detail.php",
                type: "POST",
                data : {id:id,type:'detail'},
                success:function(response) 
                {
                    $('#editorder_model').html(response);
                    $('#editorder_model').modal('show');
                }
            });

        });


        //Click Event through Jquery AJAX
        $("body").on("click",".save_order",function(e){

            
            var formdata = new FormData();
            
            var id = $(this).attr('data_id');
            var e_status = $('#e_status').val();
            
            formdata.append('status', e_status);
            formdata.append( 'type', 'save');
            formdata.append( 'id', id);

            $.ajax({
                url : "fetch_order_detail.php",
                type: "POST",
                data : formdata,
                cache: false,
                contentType: false,
                processData: false,

                success:function(response) 
                {
                    if(response == 1){
                        $('#editorder_model').modal('hide');
                        fetch_order();
                    }else{
                        $('.modal_error').html(response);
                        $('.modal_error').css('display','block');
                    }
                }
            });

        });


         //Click Event through Jquery AJAX
        $("body").on("click",".remove_order",function(e){

            var id = $(this).attr('data_id');

            $.ajax({
                url : "fetch_order_detail.php",
                type: "POST",
                data : {id:id,type:'remove'},
                success:function(response) 
                {
                    fetch_order();
                }
            });

        });

    });
</script>
</body>
</html>