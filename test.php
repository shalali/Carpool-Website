  <?php
$host = "mysql.cms.gre.ac.uk";
$username = "st8511x";
$password = "tina2";
$dbname = "mdb_st8511x";

//est. connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) 
{
    die("Connection failed: " . $conn->connect_error);
} 

echo "Connected successfully";

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
$sqlo = "INSERT INTO user (username, password, code) VALUES ('aaaaa', 'b', '".$code."')";


//$sqlo = "INSERT INTO user (code) VALUES ('".$code."')";

if (mysqli_query($conn, $sqlo)) {
    echo "New record created successfully";
     
} else {
    echo "Error: " . $sqlo . "<br>" . mysqli_error($conn);
}
    
 mysqli_close($conn);
       


    
    ?>