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
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
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
        <h1> Customer Listing </h1>
        <input class="search"  type="text" name="search" placeholder="Search Customer" class="searching" id="search">
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

<script src="../assets/js/jquery-1.11.1.min.js"> </script>
<script type="text/javascript">
    $(document).ready(function(e) {
        
        $.ajax({
            url : "fetch_customer.php",
            type: "POST",
            data : "",
            success:function(response) 
            {
                $('.table').html(response);
            }
        });

        
        //Click Event through Jquery AJAX
        $("body").on("click",".search_keyword",function(){
            
            var keyword = $("#search").val();

            if(keyword != ''){

                $.ajax({
                    url : "fetch_customer.php",
                    type: "POST",
                    data : {keyword:keyword},
                    success:function(response) 
                    {
                        $('.table').html(response);
                    }
                });
            }else{
                $.ajax({
                    url : "fetch_customer.php",
                    type: "POST",
                    data : "",
                    success:function(response) 
                    {
                        $('.table').html(response);
                    }
                });
            }
        });

    });
</script>
</body>
</html>