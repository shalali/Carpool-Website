<?php ob_start(); session_start(); if(isset($_SESSION['userAdded'])){ ?>
<a href="index.php">Home</a>
<a href="logout.php">Logout</a>
<br/> <br/>
<a href="view_login_successful.php">Back</a>
<br/> <br/>
<?php 
    if(isset($_GET['postid'])){
        
       // $sql = "SELECT * FROM journey";
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
        
        $sql = "SELECT * FROM journey";
        $result= mysqli_query($conn,$sql);
        
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
            
            $user =  get_user($row['username'],$conn);
            echo 
                //personal info
            "Name :{$user['name']}  <br> ".
            "Purpose :{$user['purpose']}  <br>".

             //"Email :{$user['email']}  <br> ".
             "Gender :{$user['gender']}  <br> ".
            "Profession :{$user['profession']}  <br> <br>".
                
                //journey info:
             "Starting Point :{$row['start']}  <br> ".
               "Ending Point : {$row['end']} <br> ".
               "Days : {$row['days']} <br> ".
               "Time : {$row['time']} <br>
               --------------------------------<br>";
         }
        
  
    
mysqli_close($conn);
          }//if isset
?>
<?php }else {
            header('location: view_login.php');
            exit();
    
        }?>

<?php 
function get_user($username,$conn){  
        // Check connection
        if (!$conn){
            die("Connection failed: " . $conn->connect_error);
        }
        //$sql = 'SELECT * FROM user, memberpost WHERE user.username =\''.mysqli_real_escape_string($conn,$username).'\'';
    
    //$sql= "select * from user, memberpost where user.username= '".$username."'";
    $sql="select * from user join memberpost on user.username=memberpost.username where user.username='".$username."'";
        
        $result= mysqli_query($conn,$sql);        
        $row = mysqli_fetch_assoc($result);      
        return $row;
    }

?>