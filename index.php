<?php ob_start(); session_start(); ?>
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <title>Green Greenwich</title>
    <meta charset="UTF-8">
    
    <link type="text/css" rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
   </head>
<body>
    <div class="inside">
    <div class="inn">
         <div class="posts">
             <h1>Home page</h1>
             
                <?php if(isset($_SESSION['userAdded'])){ ?>
             
                    <label id="lblloggedInPerson">Hi <?=$_SESSION['userAdded'];?> </label>
                    <a href="logout.php">Logout</a>
                    <br/><br/>
                    <a href="view_login_successful.php">Postings</a>
                    <?php 
                                                       }?>
                
                <?php if(!isset($_SESSION['userAdded'])){ ?>
                    <a href="view_login.php">Login</a>
                    <br>
                    <a href="view_register.php">Register</a>
                    <?php 
                                                     }?>
             
                <h2>Member Search</h2>
               <?php
             
                $_PHP_SELF =  $_SERVER['PHP_SELF'];
                $dbname = "mdb_st8511x";
                $host = "mysql.cms.gre.ac.uk";
                $username = "st8511x";
                $password = "tina2";
             $rec_limit = 10;
             $conn = mysqli_connect($host, $username, $password, $dbname);

             if(! $conn ) {
                die('Could not connect: ' . mysqli_error());
             }
             mysqli_select_db($conn,$dbname);

             /* Get total number of records */
             $sql = "SELECT count(journeyid) FROM journey";
             $retval = mysqli_query(  $conn,$sql);

             if(! $retval ) {
                die('Could not get data: ' . mysqli_error());
             }
             $row = mysqli_fetch_array($retval, MYSQLI_BOTH );
             $rec_count = $row[0];

             if( isset($_GET{'page'} ) ) {
                $page = $_GET{'page'} + 1;
                $offset = $rec_limit * $page ;
             }else {
                $page = 0;
                $offset = 0;
             }

             $left_rec = $rec_count - ($page * $rec_limit);
             $sql = "SELECT * ". 
                "FROM journey ".
                "LIMIT $offset, $rec_limit";

             $retval = mysqli_query(  $conn,$sql);

             if(! $retval ) {
                die('Could not get data: ' . mysqli_error());
             }

             while($row = mysqli_fetch_array($retval, MYSQLI_BOTH)) {
                echo "Starting Point :{$row['start']}  <br> ".
                   "Ending Point : {$row['end']} <br> ".
                   "Days : {$row['days']} <br> ".
                    "<a href=\"single.php?postid={$row['journeyid']}\">More Detail</a><br>".
                   "--------------------------------<br>";
             }

             if( $page > 0 ) {
                $last = $page - 2;
                echo "<a href=\"$_PHP_SELF?page=$last\">Previous 10 Records</a> | ";
                echo "<a href=\"$_PHP_SELF?page=$page\">Next 10 Records</a>";
             }else if( $page == 0 ) {
                echo "<a href=\"$_PHP_SELF?page=$page\">Next 10 Records</a>";
             }else if( $left_rec < $rec_limit ) {
                $last = $page - 2;
                echo "<a href=\"$_PHP_SELF?page=$last\">Previous 10 Records</a>";
             }

             mysqli_close($conn);
          ?>
        </div>
    </div>
    </div>
</body>
</html>
