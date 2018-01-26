<?php ob_start(); session_start(); ?>
<?php 
$dbname = "mdb_st8511x";
$host = "mysql.cms.gre.ac.uk";
$username = "st8511x";
$password = "tina2";
//est. connection
$conn = mysqli_connect($host, $username, $password, $dbname);
// Check connection
if (!$conn){
    die("Connection failed: " . $conn->connect_error);
    }

if(isset($_POST["username"]) && isset($_POST["password"])){
    if(!empty($_POST['username']) && !empty($_POST['password'])){
        $usernameEntered = mysqli_real_escape_string($conn,$_POST["username"]);
        $passwordEntered = mysqli_real_escape_string($conn,$_POST["password"]);
        checkUserExist($conn,$usernameEntered,$passwordEntered);
    }
}
function checkUserExist($conn,$usernameEntered,$passwordEntered){
    $sqlUserCheck= "SELECT username FROM user WHERE  username= '".$usernameEntered."'";
    $resultUserExists= mysqli_query($conn,$sqlUserCheck);
    if(mysqli_num_rows($resultUserExists)>0){
        if(!(checkPassMatch($usernameEntered, $passwordEntered, $conn)) || $usernameEntered == ""){
            echo '<a href="view_login.php">Oops. Wrong password. Try again</a>';
            }
    }
    else{
        echo $usernameEntered;
        echo '<a href="view_login.php">Oops. Wrong credentials. Try again</a>';
    }
}
function checkPassMatch($userEntered, $passEntered, $c){
        $pass = $c->query("SELECT password FROM user WHERE username = '".$userEntered."'")->fetch_object()->password;  

        if($passEntered == $pass){
                checkVerified($userEntered, $c);
            return true;
        }
            return false;
}
function checkVerified($user, $con){
    $status = $con->query("SELECT status FROM user WHERE username = '".$user."'")->fetch_object()->status;  
    if($status == 1){
        $_SESSION["userAdded"]=$user;    
        header('Location: view_login_successful.php');
        exit();
        
     }
    else if($status == 0){
        $code = $con->query("SELECT code FROM user WHERE username = '".$user."'")->fetch_object()->code;  
        $_SESSION["codeC"] = $code;//unconfirmed code
        $_SESSION["userAdded"]=$user;//username
        header('Location: view_verify.php');
        exit();
    }
    
}
mysqli_close($conn);
ob_end_flush();
exit();
?>
