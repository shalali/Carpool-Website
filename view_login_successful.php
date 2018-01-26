<?php ob_start(); session_start(); ?>
<html>
<head>
    <title>Login Successful</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="inside">
    <div class="inn">
    <a href="index.php">Home</a>
    <a href="logout.php">Logout</a>
    <div>
        <?php if(isset($_SESSION['userAdded'])){ ?>
            <h2 id= "headerWelcome">Welcome, <?= $_SESSION['userAdded']; ?></h2>
            <a title="Click here to post info about yourself" href="model_aboutme.php" id="lblPostInfo">About Me</a>
            <br>
            <a title="Click here to post info about your intended journeys" href="view_member_post.php" id="lblPostInfo">Post Information</a>        
            <br>
        <a title="Upload images" href="view_image.php" id="lblPostInfo">Upload Images(s)</a>
        <br/>
        <a href="" id="lblEditInfo">Edit Information</a>
        <?php } else {
            header('location: view_login.php');
            exit();

        }?>
    </div>
        </div>
        </div>
</body>
</html>

