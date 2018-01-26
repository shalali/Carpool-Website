<?php  
ob_start();
session_start(); 
//unset($_SESSION["update"]);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Post Information</title>
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
        <br/>
         <?php if(isset($_SESSION['userAdded'])){ ?>
                <a href="view_login_successful.php">Back</a>
        <br/>
        <label id="lblHelloUser">Logged in: <?php echo $_SESSION["userAdded"];?></label>
        <?php 
            if(isset($_SESSION['dataup'])){
                echo '<br><b>DATA UPDATED SUCCESSFULLY</b>';
                unset($_SESSION['dataup'])
            }
        
        ?>
        <h2>About Me</h2>
    </div>
<?php extract(get_user_details()); ?>
         <h3>Current Information</h3>
         <p>Name: <?= $name; ?></p>
         <p>Purpose: <?= $purpose; ?></p>
         <p>Gender: <?= $gender; ?></p>
         <p>Age: <?= $age; ?></p>
         <p>Profession: <?= $profession; ?></p>
    
<h2> ADD / Edit Information</h2>
<?php if (isset($_POST["aboutMeSave"])){
    if(update_user_details($_POST['lblPurposeC'],$_POST['memberName'],$_POST['lblGender'],$_POST['lblAgeC'],$_POST['profession'])){
        $_SESSION['dataup'] = true;
        header('location: view_aboutme.php');
    }
}?>
    <form id="frmAboutMe" action="view_aboutme.php" method="post">
        <table>
            <tr>
                <td>
                    <label id="lblPurpose">Purpose:</label>
                </td>

                <td>
                            <select name="lblPurposeC">
                            <option value="pooler">Pooler</option>
                            <option  value="lifter">Lifter</option>
                            </select>                        
                </td>
            </tr>        
            <tr>
                <td>
                    <label id="lblName">Name:</label>
                </td>
                <td>
                        <input type="text" id="txtMemberName" name="memberName">                  
                </td>
            </tr>
            <tr>
                <td>
                    <label id="lblGender">Gender:</label>
                </td>

                <td>
                      <select name="lblGender">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label id="lblAge">Age:</label>
                </td>
                <td>
                       <select name="lblAgeC">
                        <option value="17-30">17-30</option>
                        <option value="30-50">30-50</option>
                        <option value="51+">51+</option>
                        </select>
                </td> 
            </tr>
            <tr>
                <td>
                    <label id="lblProfession">Profession:</label>
                </td>
                <td>
                   
                            <input type="text" id="txtProfession" name="profession">
                </td>
            </tr>
             <tr>
                <td>
                    <br>
                    <label id="lblImage">Image(s):</label>
                </td>
                <td>
                    <br>
                    <input type="file" size="40" name="uploadImage"/>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    <br>
                    <input type="submit" value="Save" name="aboutMeSave" <?php $_SESSION["save"]="a";?>>
                </td>
            </tr>
        </table>
    </form>
    <?php }else {
            header('location: view_login.php');
            exit();
    
        }?>
         
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

function get_user_details(){
    $conn = db_connect();
    $sql = "SELECT purpose,name,gender,age,profession FROM memberpost WHERE username ='".$_SESSION['userAdded']."'";
    $result = mysqli_query($conn,$sql);
    $values = mysqli_fetch_assoc($result);
        return $values;
}
function update_user_details($purpose,$name,$gender,$age,$profession){
    $conn = db_connect();
    $purpose = mysqli_real_escape_string($conn,$purpose);
     $name = mysqli_real_escape_string($conn,$name);
     $gender = mysqli_real_escape_string($conn,$gender);
     $age = mysqli_real_escape_string($conn,$age);
     $profession = mysqli_real_escape_string($conn,$profession);
    $sql = "UPDATE `memberpost` SET `purpose` = '".$purpose."', `name` = '".$name."', `gender` = '".$gender."', `age` = '".$age."', `profession` = '".$profession."'";   
    mysqli_query($conn,$sql);
if(mysqli_affected_rows($conn) > 0){
        return true;
    }
    else{
        return false;
    }
    
    
}
?>
