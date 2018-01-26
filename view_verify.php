<?php ob_start(); session_start();  
    if (isset($_SESSION["codeC"]) && isset($_SESSION["userAdded"])) {
        
            $correctCode = $_SESSION["codeC"];
            $usernameVerified = $_SESSION["userAdded"];
        }
?>
<!DOCTYPE html>
<html>

    <head>
        <title>Verify</title>
        <meta charset="UTF-8">

        <script type="text/javascript">
            function codeIsCorrect() {
                
                document.getElementById("lblError").innerHTML = "Please enter a code.";//clear error labels

                var userCode = document.getElementById("txtCode").value;
                var correctCode = "<?php echo get_this_code($_SESSION["userAdded"]); ?>";//the right code
                var usernameVerified = "<?php echo $_SESSION["userAdded"]; ?>";
                
                

                if (userCode == ""){

                    //document.getElementById("lblError").innerHTML = "Wrong code. Try again.";
                    document.getElementById("lblError").innerHTML = "Please enter a code.";

                    //alert("Please enter a code.");
                    return false;

                }
                else if (userCode == correctCode) {
                    //update their verified status to true i.e "1"in db
                                
                    return true;

                }
                else {

                    document.getElementById("lblError").innerHTML = "Wrong code. Try again.";
                    //alert("Try again.");
                    return false;

                }

            }

        </script>
    <link type="text/css" rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
<div class="inside">
            <div class="inn">
        <a href="index.php">Home</a>
        <a href="">Back</a>

        <form id="frmRegister" action="model_login_reg.php" method="post">
            <div>
                <h2>Verify Account</h2>

                <label id="lblCode">Enter activation code:</label>
                <input type="text" id="txtCode" name="code">

                <input type="submit" value="Register" name="register" onclick="return codeIsCorrect();">

                <label style="color:red;" id="lblError"></label>

                <label id="lblCode"></label>


            </div>
        </form>
  </div>
        </div>
    </body>


    </html>

<?php
function db_connect(){

    $dbname = "mdb_st8511x";
   
    $host = "mysql.cms.gre.ac.uk";
    $username = "st8511x";
    $password = "tina2";

    //$host = "localhost";
    //$username = "root";
    //$password = "";

    //est. connection
    $conn = mysqli_connect($host, $username, $password, $dbname);

    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . $conn->connect_error);
    } 
    
    //echo "Connected successfully";    
    return $conn;
}//db_connect

function get_this_code($username){
    $conn = db_connect();
    $username = mysqli_real_escape_string($conn,$username);
    $sql = "SELECT code FROM user WHERE username = '".$username."'";
    $result = mysqli_query($conn,$sql);
    $value = mysqli_fetch_assoc($result);
    return $value['code'];
}

?>
