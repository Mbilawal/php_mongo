<?php
session_start();
if(!isset($_SESSION['user'])){
    header('location:login.php');
}?>
<!DOCTYPE html>
<html>
<head>
    <!--Bootstrapp-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/productCSS.css">

    <style>
        p {
            margin: 4px;
        }
        .custom_search{
            display: flex;
            align-content: space-around;
            justify-content: center;
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
    <div class="container-fluid">
        <h1> Dashboard </h1>
        <br>
        <br>
        <span class="custom_search">
            <input class="search"  type="text" name="search" placeholder="Search Product" class="searching" id="search">
            <button class="process search_keyword">Search</button>
        </span>
        <br>
        <br>
    </div>
    <div class="container">

    </div>

<!--JQuery Liberary Load-->
<script src="assets/js/jquery-1.11.1.min.js"> </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(document).ready(function(e) {
        
        function fetch_product() {
            //ajax request to show all the products
            $.ajax({
                url : "fetch_customer_product.php",
                type: "POST",
                data : "",
                success:function(response) 
                {
                    $('.container').html(response);
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
                    url : "fetch_customer_product.php",
                    type: "POST",
                    data : {keyword:keyword},
                    success:function(response) 
                    {
                        //APPend to table
                        $('.container').html(response);
                    }
                });
            }else{
                //Fetch All Product
                $.ajax({
                    url : "fetch_customer_product.php",
                    type: "POST",
                    data : "",
                    success:function(response) 
                    {
                        //APPend to table
                        $('.container').html(response);
                    }
                });
            }
        });

        //Cart Order
        $("body").on("click",".add_product_cart",function(){
            
            var product_id  = $(this).attr('data_id');
            var price       = $(this).attr('price');

            if(product_id != ''){
                //Cart Product
                $.ajax({
                    url : "Get_cart_order.php",
                    type: "POST",
                    data : {price:price,product_id:product_id},
                    success:function(response) 
                    {
                        if(response){
                            alert('Product Added to Cart');
                        }else{
                            alert('Error Occur');
                        }
                    }
                });
            }else{
                
            }
        });

    });
</script>
</body>
</html>