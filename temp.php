<?php
//check email
$sql = "SELECT * FROM user WHERE email = '".$email."'";
$result = mysqli_query(db_connect(),$sql);
if(mysqli_num_rows($result)>=1)
       {
        //echo "Email ID taken. ";
       }


$sql = "INSERT INTO user (username, password, email) VALUES ('". $user. "','". $password . "','".$email."')";


if (mysqli_query(db_connect(), $sql)) {
    //echo "New record created successfully";
    


    
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error(db_connect());
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
    }//func

    $code=incrementalHash();

$sqlo = "INSERT INTO user (code) VALUES ('".$code."')";
mysqli_query(db_connect(),$sqlo);  
    
    
        //header('Location: view_verify.php');


//email    
//$to = "st8511x@greenwich.ac.uk";
$to = $email;
$subject = "Activation Code";
$txt = "hi";
$headers = "From: donotreply@greengreenwich.org" . "\r\n";
//"CC: somebodyelse@example.com";

mail($to,$subject,$txt,$headers);

?>