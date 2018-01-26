<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <meta charset="UTF-8">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
        <link type="text/css" rel="stylesheet" href="style.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div class="inside">
            <div class="inn">
                <a href="index.php">Home</a>
                <form id="frmRegister" action="model_login.php" method="post">
                    <div class="login-form">
                        <h1>Login</h1>
                        <label id="lblName">Username:</label><br/>
                        <input type="text" id="txtName" name="username" required/><br/>
                        <label style="color:red;" id="lblUseError"></label><br/>
                        <label id="lblPassword">Password:</label><br/>
                        <input type="password" id="txtPassword" name="password" required/><br/>
                        <label style="color:red;" id="lblPError"></label>
                        <br/>
                        <input type="submit" value="Login" name="login" onclick= "true"/>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
