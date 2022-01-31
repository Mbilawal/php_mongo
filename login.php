<?php
session_start();

// echo "<pre>";
// print_r($_SESSION);
// exit;

if(isset($_SESSION['logged_in']) && isset($_SESSION['user'])){
    header('location:Product.php');
}

if(isset($_SESSION['logged_in']) && isset($_SESSION['staff'])){
    header('location:staff/homePage.php');
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/loginCss.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
        <style type="text/css">
            .topheader{
                display: none;
            }
        </style>
    </head>
    <!--Displaying the navigation bar-->
<body>
    <body>
    <?php
    //including the php functions that we are going to use
include("navbarPHP.php");
outputNavBar("Log in");
?>
<!--Displaying the navigation bar-->
<!--User labels for loging in-->
<h1 style="color: #fff;">Log in</h1>
<div id="error_msg1">
    <span style="color: #fff;" id="error_msgs"></span><br>
</div>
<div>
    <form onsubmit="return false">
        Email:<br>
        <input type="email" name="userMail" required placeholder="Enter a email addres" id="userMail"><br>
        <!-- Username:<br> -->
        <!-- <input type="text" name="userName" required><br> -->
        Password:<br>
        <input type="password" id="userPass" required><br>
        <button class="login_btn">Log in</button>
        <button class="reg_btn"><a href="Register.php">Sign Up</a></button>
    </form>
</div>
<script src="assets/js/jquery-1.11.1.min.js"> </script>
<script type="text/javascript">
    $(document).ready(function(e) {
        
        //Click Event through Jquery AJAX
        $("body").on("click",".login_btn",function(){
            
            var userMail = $("#userMail").val();
            var userPass = $("#userPass").val();

            var email_length= userMail.length;
            
            if(email_length > 3){

                //Validate Email Pattern
                var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                
                if(pattern.test(userMail)){

                    if(userMail != "" && userPass != ""){

                        //Ajax Call to Authenicate the Login
                        $.ajax({
                            url : "verifylogin.php",
                            type: "POST",
                            data : {userPass:userPass, userMail:userMail},
                            success:function(response) 
                            {
                                if(response == 1){
                                    window.location.href = "Product.php";
                                }else if(response == 2){
                                    window.location.href = "staff/homePage.php";
                                }else{
                                    $("#error_msgs").html(response);
                                }   
                            }
                        });
                    }else{
                        $("#error_msgs").html('All Field Required');
                    }

                }else{
                    $("#error_msgs").html('Enter Valid Email Address');
                }
            }else{
                $("#error_msgs").html('Enter Valid Email Address');
            }
        });
    });
</script>
</body>
</html>