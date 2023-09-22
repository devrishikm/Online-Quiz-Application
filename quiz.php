<?php
$servername = "127.0.0.1";
$username = "root";
$_password = "";
$database = "quiz";
// Create a connection
$conn = mysqli_connect($servername, $username, $_password, $database);
// Die if connection was not successful
if (!$conn){
 die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
//  echo "Connection is successful<br>";
}
 
// Variables to be inserted into the table
$now = new DateTime();
$startdatetime = $now->format('Y-m-d H:i:s');
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
  #entry through form
  $password = $_GET['password'];
  $sql = "SELECT * FROM `quiz_user_result` WHERE password='$password'";
  $result = mysqli_query($conn, $sql);
  
  // Find the number of records returned
  $num = mysqli_num_rows($result);
 
  // Display the rows returned by the sql query
  if($num==0){
    // get all available books to show in table
    $sql = "SELECT * FROM `quiz_questioninfo`";
    $result = mysqli_query($conn, $sql);
    // Find the number of records returned
    $num = mysqli_num_rows($result);
    if($num> 0){
      // We can fetch in a better way using the while loop
      echo"<form action='submit_result.php' method='post'>";
      while($row = mysqli_fetch_assoc($result)){
       echo "
        <B>".$row['q_no']."</B>.
        <B>".$row['question']."</B><br>
        <input type='radio' name='option".$row['q_no']."' id='question_option".$row['q_no']."' value='".$row['option_1']."'/ required>".$row['option_1']."<br>
        <input type='radio' name='option".$row['q_no']."' id='question_option".$row['q_no']."' value='".$row['option_2']."'/ required>".$row['option_2']."<br>
        <input type='radio' name='option".$row['q_no']."' id='question_option".$row['q_no']."' value='".$row['option_3']."'/ required>".$row['option_3']."<br>
        <br>
        ";
        } 
        echo " <input type='hidden' value='$password' name='password'>";
        echo " <input type='hidden' value='$startdatetime' name='startdatetime'>";
        echo " <button value='submit'>Submit</button>";
        echo"</form>";
    } 
    else{
      echo "No questions found";
    }
  }
  else{
    echo "Already done with exam";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
body {
	height: 100%;
  font-size:20px;
	font-family: Poppins-Regular,sans-serif;
  Background-color:slateblue;
  color:white;
  text-align:left;
  padding:10px;
  margin-left:375px;
  margin-right:350px;
  border:solid 10px white;
}
button {
  font-size:20px;
  margin-left:350px;
  margin-right:0px;
  border-radius:12px;
  padding:10px;
}
</style>
</head>
<body>
  
</body>
</html>