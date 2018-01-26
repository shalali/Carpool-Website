<?php
//ob_start();
session_start();

//validation
    //check username
    //check email
    //checl captcha

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

echo $userDetailCheck= checkUserDetails();//main validation

function getPassword(){
 if(isset($_GET['password'])){
    $pass = $_GET['password'];

     return $pass;
 }
    else{
        return "";    
    }
}

function getConfirmPassword(){
 if(isset($_GET['confirmPassword'])){
    $cPass = $_GET['confirmPassword'];

     return $cPass;
 }
    else{
        return "";    
    }
}

 function checkPasswords(){
     
     if(getPassword()==getConfirmPassword()){//passwords match
         return true;  
     }
     else{
         return false;
     }
 }


function getUsername(){
 if(isset($_GET['username'])){
    $user = $_GET['username'];

     return $user;
 }
    else{
        return "";    
    }
}

function getEmail(){
 if(isset($_GET['email'])){
    $email = $_GET['email'];

     return $email;
 }
    else{
        return "";    
    }
}

function getGeneratedCaptcha(){
 if(isset($_GET['generatedCaptcha'])){
    $generatedcaptcha = $_GET['generatedCaptcha'];

     return $generatedcaptcha;
 }
    else{
        return "";    
    }
}

function getUserCaptcha(){
 if(isset($_GET['enteredCaptcha'])){
    $captcha = $_GET['enteredCaptcha'];

     return $captcha;
 }
    else{
        return "";    
    }
}

function checkCaptcha($captcha){//global captcha is accessed
    if ($captcha != $_SESSION["vercode"] OR $_SESSION["vercode"]=='') { 
    return false;  
    //echo  '<strong>Wrong captcha code. Try again.</strong>'; 
    } 
    else { 
    return true; 
     // add form data processing code here 
     //echo  '<strong>Verification successful.</strong>';
    //view_verify.php
    }
}

function checkUserDetails(){
    $conn = db_connect();
    $sqlUser = "SELECT userid FROM user WHERE username = '".getUsername()."'";
    $sqlEmail = "SELECT userid FROM user WHERE email = '".getEmail()."'";
    
    $passConfirmed = checkPasswords();
    //$captchaValid = checkCaptcha(getUserCaptcha());
    
    $captchaIsValid = (getGeneratedCaptcha() == getUserCaptcha());
    
    $resultUser = mysqli_query($conn,$sqlUser);
    $rowNoUser = mysqli_num_rows($resultUser);
    
    $resultEmail = mysqli_query($conn,$sqlEmail);
    $rowNoEmail = mysqli_num_rows($resultEmail);
    
        if($rowNoUser==0 && $rowNoEmail==0 && $captchaIsValid && $passConfirmed==true && $passConfirmed!==""){
            addUser();
            return $rowNoUser;
        }
    else if($rowNoUser>0){//check username doesnt exist
        return "Username Taken";
        
    }else if($rowNoEmail >0){//check email doesnt exist
        return "Email Taken";

    }else if(!$captchaIsValid){//confirm captcha
        return "Wrong captcha";
        //return getGeneratedCaptcha();
    }
    else if($passConfirmed == false){//confirm captcha
        return "Passwords do not match";
    }
    
  
    
}


function incrementalHash($len = 5){
  $charset = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
  $base = strlen($charset);
  $result = '';

  $now = explode(' ', microtime())[1];
  while ($now >= $base){
    $i = $now % $base;
    $result = $charset[$i] . $result;
    $now /= $base;
    }//loop
  return substr($result, -5);
    
    $code=incrementalHash();
    
    return $code;
}/*This code is borrowed from: 
https://stackoverflow.com/questions/5438760/generate-random-5-characters-string/5438778 */

   

function addUser(){
    $conn = db_connect();
    
    $activationCode = incrementalHash();//generates activation code 
    //$inactive = 1;
    $_SESSION["code"] = $activationCode;
    
    $usernameAdded = getUsername();
    $_SESSION["userAdded"] = $usernameAdded;

    
    $sql = "INSERT INTO user (username, password, email, code) VALUES ('". $usernameAdded. "','".getPassword(). "','".getEmail()."','".$activationCode."')";
    
    //*note status is set to a default value of inactive by the tinyint 0. 
    mysqli_query($conn,$sql);
    
    //$sqlm = "UPDATE user SET status = '1' WHERE username = '".getUsername()."'"; 
    
    //mysqli_query($conn,$sqlm);


    $to = getEmail();
    $subject = "Activation Code";
    $txt = $activationCode;
    $headers = "From: donotreply@greengreenwich.org" . "\r\n";
    //"CC: somebodyelse@example.com";

    mail($to,$subject,$txt,$headers);
}//addUser


//function checkEmailTaken

//pase

//close connection
mysqli_close(db_connect());


//exit(0);

?>
