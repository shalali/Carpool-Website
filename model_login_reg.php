<?php ob_start(); session_start();

$dbname = "mdb_st8511x";
$host = "mysql.cms.gre.ac.uk";
$username = "st8511x";
$password = "tina2";


//est. connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
        } 
                    
if(isset($_POST['code'])){
    if(!empty($_POST['code'])){
        $userWelcome = mysqli_real_escape_string($conn,$_SESSION["userAdded"]);
        $sqlStatus = "UPDATE `user` SET status = '1' WHERE username = '".$userWelcome."' AND code ='".mysqli_real_escape_string($conn,$_POST['code'])."'";
        var_dump($sqlStatus);
        if(mysqli_query($conn,$sqlStatus)){
            mysqli_close($conn);
            header('Location: view_login_successful.php?loginMode=0&user='.$userWelcome);
            exit();
        }
        else{
            echo 'error';
        }
    }
}
?>