<?php
session_start();

if(!isset($_SESSION['staff'])){
    header('location:login.php');
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
        <input class="search"  type="text" name="search" placeholder="Search Product" class="searching" id="search">
        <button class="process search_keyword">Search</button>

        <table  class="table">
          <tr>
            <th>Product ID</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Product Price</th>
            <th>Product Created Date</th>
            <th>Action</th>
          </tr>
          
          <tr>
            <td>Alfreds Futterkiste</td>
            <td>Alfreds Futterkiste</td>
            <td>Alfreds Futterkiste</td>
            <td>Alfreds Futterkiste</td>
            <td>Alfreds Futterkiste</td>
            <td>Maria Anders</td>
          </tr>
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

                $.ajax({
                    url : "fetch_product.php",
                    type: "POST",
                    data : {keyword:keyword},
                    success:function(response) 
                    {
                        $('.table').html(response);
                    }
                });
            }else{
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
                    $('#editproduct_model').html(response);
                    $('#editproduct_model').modal('show');
                }
            });

        });


        //Click Event through Jquery AJAX
        $("body").on("click",".save_product",function(e){

            var id = $(this).attr('data_id');
            var postData = $('#product_edit_form').serializeArray();
            
            var attachment = document.getElementById('edit_attachment').files[0];
            var e_name = $('#e_name').val();
            var e_consoletype = $('#e_consoletype').val();
            var e_yeat = $('#e_yeat').val();
            var e_stock = $('#e_stock').val();
            var e_price = $('#e_price').val();

            postData.push({name: 'console_type', value: e_consoletype});
            postData.push({name: 'price', value: e_price});
            postData.push({name: 'product_name', value: e_name});
            postData.push({name: 'stocks', value: e_stock});
            postData.push({name: 'year', value: e_yeat});
            postData.push({name: 'file', value: attachment});
            postData.push({name: 'type', value: 'save'});
            postData.push({name: 'id', value: id});

            $.ajax({
                url : "fetch_product_detail.php",
                type: "POST",
                data : postData,
                success:function(response) 
                {
                    $('#editproduct_model').modal('hide');
                    fetch_product();
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

    });
</script>
</body>
</html>