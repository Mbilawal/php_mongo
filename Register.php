<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="assets/css/loginCss.css">
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
outputNavBar("Register");
?>
    
    <!--Displaying the detals of the user-->
    <h1>Registration</h1>
    <form onsubmit="return false">  
        <div id="error_msg">
            <span id="response"></span><br>
        </div>
        <div>  
            Email*:<br>
            <input type="email" name="userMail" required placeholder="Enter a email addres" id="userMail"><br>

            Username*:<br>
            <input type="text" name="userName" id="userName" required><br>

            Password*:<br>
            <input type="password" id="userPass" required><br>

            Address*<br>
            <input type="text" id="userAddress" required><br>

            <button class="reg_btn">Register</button>
            <button class="login_btn"><a href="Login.php">Login</a></button>
        </div>
    </form>
    
    <script src="assets/js/jquery-1.11.1.min.js"> </script>
    <script type="text/javascript">
        $(document).ready(function(e) {
            
            $("body").on("click",".reg_btn",function(){
                
                var userMail    = $("#userMail").val();
                var userPass    = $("#userPass").val();
                var userName    = $("#userName").val();
                var userAddress = $("#userAddress").val();

                if(userMail != "" && userPass != "" && userAddress != "" && userName != ""){
                    $.ajax({
                        url : "registeruser.php",
                        type: "POST",
                        data : {userPass:userPass, userMail:userMail,userAddress:userAddress,userName:userName},
                        success:function(response_data) 
                        {
                            $("#response").html(response_data)
                        }
                    });
                }else{
                    $("#response").html('<span style="color:red">All Fields Required</span>');
                }
            });
        });
    </script>
</body>
</html>