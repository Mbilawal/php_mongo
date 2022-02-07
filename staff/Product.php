<?php
session_start();
//checking if session is not set for staff then it goes into login page
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
        <h1> Product Listing </h1>
        <br>
        <br>
        <span class="left">
            <input class="search"  type="text" name="search" placeholder="Search Product" class="searching" id="search">
            <button class="process search_keyword">Search</button>
        </span>
        <span class="right">
            <button class="process add_product">Add Product</button>
        </span>
        <br>
        <table  class="table">
          
        </table>
    </div>

    <div id="editproduct_model" class="modal hide" tabindex="-1" role="dialog">
      
    </div>

<script src="../assets/js/jquery-1.11.1.min.js"> </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(e) {
        
        function fetch_product() {
            //ajax request to show all the products
            $.ajax({
                url : "fetch_product.php",
                type: "POST",
                data : "",
                success:function(response) 
                {
                    $('.table').html(response);
                }
            });
        }

        fetch_product();
        
        //Click Event through Jquery AJAX
        $("body").on("click",".search_keyword",function(){
            
            var keyword = $("#search").val();

            if(keyword != ''){
                //Fetch All Product
                $.ajax({
                    url : "fetch_product.php",
                    type: "POST",
                    data : {keyword:keyword},
                    success:function(response) 
                    {
                        //APPend to table
                        $('.table').html(response);
                    }
                });
            }else{
                //Fetch All Product
                $.ajax({
                    url : "fetch_product.php",
                    type: "POST",
                    data : "",
                    success:function(response) 
                    {
                        //APPend to table
                        $('.table').html(response);
                    }
                });
            }
        });


        //Click Event through Jquery AJAX
        $("body").on("click",".edit_product",function(e){
            
            var id = $(this).attr('data_id');

            $.ajax({
                url : "fetch_product_detail.php",
                type: "POST",
                data : {id:id,type:'detail'},
                success:function(response) 
                {
                    //Model Show
                    $('#editproduct_model').html(response);
                    $('#editproduct_model').modal('show');
                }
            });

        });


        //Click Event through Jquery AJAX
        $("body").on("click",".save_product",function(e){

            var id = $(this).attr('data_id');
            var formdata = new FormData();
            
            var attachment = document.getElementById('edit_attachment').files[0];
            
            var file_list = document.getElementById('edit_attachment').files.length;    
            if(file_list > 0){
                formdata.append( 'file', attachment);
                formdata.append( 'file_lenght', file_list);
            }else{
                formdata.append( 'file_lenght', file_list);
            }
            var e_name = $('#e_name').val();
            var e_consoletype = $('#e_consoletype').val();
            var e_yeat = $('#e_yeat').val();
            var e_stock = $('#e_stock').val();
            var e_price = $('#e_price').val();

            formdata.append('console_type', e_consoletype);
            formdata.append( 'price', e_price);
            formdata.append( 'product_name', e_name);
            formdata.append( 'stocks', e_stock);
            formdata.append( 'year', e_yeat);
            formdata.append( 'type', 'save');
            formdata.append( 'id', id);

            $.ajax({
                url : "fetch_product_detail.php",
                type: "POST",
                data : formdata,
                cache: false,
                contentType: false,
                processData: false,

                success:function(response) 
                {
                    if(response == 1){
                        $('#editproduct_model').modal('hide');
                        fetch_product();
                    }else{
                        $('.modal_error').html(response);
                        $('.modal_error').css('display','block');
                    }
                }
            });

        });


         //Click Event through Jquery AJAX
        $("body").on("click",".remove_product",function(e){

            var id = $(this).attr('data_id');

            $.ajax({
                url : "fetch_product_detail.php",
                type: "POST",
                data : {id:id,type:'remove'},
                success:function(response) 
                {
                    fetch_product();
                }
            });

        });

        
        //Click Event through Jquery AJAX
        $("body").on("click",".add_product",function(e){
            
            $.ajax({
                url : "fetch_product_detail.php",
                type: "POST",
                data : {type:'add'},
                success:function(response) 
                {
                    $('#editproduct_model').html(response);
                    $('#editproduct_model').modal('show');
                }
            });

        });

        //Click Event through Jquery AJAX
        $("body").on("click",".save_add_product",function(e){

            
            var attachment = document.getElementById('edit_attachment').files[0];
            var a_name = $('#a_name').val();
            var a_consoletype = $('#a_consoletype').val();
            var a_yeat = $('#a_yeat').val();
            var a_stock = $('#a_stock').val();
            var a_price = $('#a_price').val();

            if(a_name!="" || a_consoletype != "" || a_yeat!=""){

                var formdata = new FormData();
                formdata.append('console_type', a_consoletype);
                formdata.append( 'price', a_price);
                formdata.append( 'product_name', a_name);
                formdata.append( 'stocks', a_stock);
                formdata.append( 'year', a_yeat);
                formdata.append( 'type', 'add_product');
                
                var file_list = document.getElementById('edit_attachment').files.length;    
                if(file_list > 0){
                    formdata.append( 'file', attachment);
                    formdata.append( 'file_lenght', file_list);
                }else{
                    formdata.append( 'file_lenght', file_list);
                }

                $.ajax({
                    url : "fetch_product_detail.php",
                    type: "POST",
                    data : formdata,
                    cache: false,
                    contentType: false,
                    processData: false,

                    success:function(response) 
                    {
                        if(response == 1){
                            $('#editproduct_model').modal('hide');
                            fetch_product();
                        }else{
                            $('.modal_error').html(response);
                            $('.modal_error').css('display','block');
                        }
                    }
                });
            }else{
                alert('Fill the Fields');
            }


        });

    });
</script>
</body>
</html>