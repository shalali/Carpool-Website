<?php session_start(); //initiates and sets the session cookie ?>
<?php
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
if(isset($_POST["startingPoint"]) && isset($_POST["destination"]) && isset($_POST["travelTime"]) && isset($_POST["check_list"])){
  if(!empty($_POST['check_list'])){}
    $start = mysqli_real_escape_string($conn,$_POST["startingPoint"]); 
    $end = mysqli_real_escape_string($conn,$_POST["destination"]);
    $time = mysqli_real_escape_string($conn,$_POST["travelTime"]);
    $daysString = '';
    foreach($_POST['check_list'] as $p){
        $daysString .= $p.', ';
    }
    $days = mysqli_real_escape_string($conn,$daysString);

$username = $_SESSION["userAdded"];

$sql = "INSERT INTO journey (username, start, end, time, days)VALUES('".$username."','".$start."','".$end."','".$time."','".$days."')"; 
 mysqli_query($conn,$sql);

mysqli_close($conn);

echo '<a href="index.php">Journey added. Return home.</a>';
    
}

?>