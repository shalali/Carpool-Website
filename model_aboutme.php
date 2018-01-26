<?php session_start(); //initiates and sets the session cookie 
ob_start();?>
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
   
//check if details have been entered before


$sql="SELECT * FROM memberpost WHERE username = '".$_SESSION['userAdded']."'";
$conn = db_connect();
$result = mysqli_num_rows(mysqli_query($conn,$sql));


if($result>0){//about me info already entered && have not clicked save
    $user = $_SESSION['userAdded'];
    $_SESSION["empty"]=1; 
    $conn = db_connect();
    //fetch default values
    $purpose = $conn->query("SELECT purpose FROM memberpost WHERE username = '".$user."'")->fetch_object()->purpose;  
    $_SESSION["purpose"] = $purpose;
  
    $name = $conn->query("SELECT name FROM memberpost WHERE username = '".$user."'")->fetch_object()->name; 
    $_SESSION["name"] = $name; 
        
    $gender = $conn->query("SELECT gender FROM memberpost WHERE username = '".$user."'")->fetch_object()->gender; 
    $_SESSION["gender"] = $gender;
        
    $age = $conn->query("SELECT age FROM memberpost WHERE username = '".$user."'")->fetch_object()->age; 
    $_SESSION["age"] = $age;
        
    $profession = $conn->query("SELECT profession FROM memberpost WHERE username = '".$user."'")->fetch_object()->profession; 
    $_SESSION["profession"] = $profession;
    
    header('Location: view_aboutme.php');
}

if(isset($_SESSION["save"]) && $_SESSION["save"]=="a"){
    
             //echo $temp;
            $dbname = "mdb_st8511x"; 
            $conn = db_connect();
            $username = $_SESSION["userAdded"];

             $purpose = $_POST["lblPurposeC"];    
             $name = $_POST["memberName"];
             $gender = $_POST["lblGender"];
             $age = $_POST["lblAgeC"];
             $profession = $_POST["profession"];

            $sql = "INSERT INTO memberpost (purpose, name, gender, age, profession, username)VALUES('".$purpose."','".$name."','".$gender."','".$age."','".$profession."','".$username."')"; 
            mysqli_query($conn,$sql);
            mysqli_close($conn);

            echo '<a href="index.php">About me added. Return home.</a>';  
                //header('Location: view_aboutme.php');
    }

if ($result==0){
        
        $_SESSION["empty"]=0;
        header('Location: view_aboutme.php');
    }

//if about me has already be written, edit
//empty about me


/*
else{
    echo "b";
//header('Location: view_aboutme.php');  
if(isset($_POST["lblPurpose"])){
  $purpose = $_POST["lblPurpose"];     
}
if(isset($_POST["memberName"])){
    $name = $_POST["memberName"];
}
if(isset($_POST["lblGender"])){
    $gender = $_POST["lblGender"];
}
if(isset($_POST["lblAge"])){
    $age = $_POST["lblAge"];
}
if(isset($_POST["profession"])){
    $profession = $_POST["profession"];
}
$username = $_SESSION["userAdded"];
$sql = "INSERT INTO memberpost (purpose, name, gender, age, profession,username)VALUES('".$purpose."','".$name."','".$gender."',".$age.",'".$profession."','".$username."')"; 
mysqli_query($conn,$sql);
mysqli_close($conn);
echo '<a href="index.php">About me added. Return home.</a>';
}*/

?>