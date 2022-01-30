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
        
        $("body").on("click",".login_btn",function(){
            
            var userMail = $("#userMail").val();
            var userPass = $("#userPass").val();

            if(userMail != "" && userPass != ""){
                $.ajax({
                    url : "http://localhost/frontend/staff/home.php",
                    type: "POST",
                    data : {userPass:userPass, userMail:userMail},
                    success:function(response_data) 
                    {
                        
                    }
                });
            }else{
                $("#error_msgs").html('All Field Required');
            }
        });
    });
</script>
</body>
</html>