<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Upload Image</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div class="inside">
        <div class="inn">
            <a href="index.php">Home</a>
            <a href="logout.php">Logout</a>
            <?php if(isset($_SESSION['userAdded'])){ ?>
            <br/><br/>
            <a href="view_login_successful.php">Back</a>
            <br/>
            <label id="lblHelloUser">Logged in: <?php echo $_SESSION['userAdded']; ?></label>
            <!--Follwing is from: https://www.w3schools.com/php/php_file_upload.asp-->
            <form action="model_image.php" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
            <?php }else {
            header('location: view_login.php');
            exit();}?>
        </div>
    </div>

</body>

</html>
