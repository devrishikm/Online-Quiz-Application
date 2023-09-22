<html>

<head>
<style>
    body {
        background-color:slateblue;
        padding:10px;
        text-align:center;
        color:white;
        font-size:38px;
        border:solid 10px white;
        margin-left:300px;
        margin-right:300px;
        margin-top:50px;
        margin-bottom:400px;
    }
    
    table {
        color:white;
        font-size:30px;
        margin-left:350px;
        margin-right:500px;
        padding:10px;
    }
    button {
        font-size:25px;
        border-radius:12px;
        margin-left:445px;
        margin-right:500px;
    }
</style>
</head>
<body>
<h1>Quiz</h1>
<form action="" method="post"> 
<table>
<tr>
    <td>User ID</td>
    <td><input type="text" name= "userid"></td>
</tr>
<tr>
    <td>Password</td>
    <td><input type="password" name= "password"></td>
</tr>
</table><br>
<button value='submit'>Submit</button>
</form>

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

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    #entry through form
$userid = $_POST['userid'];
$password = $_POST['password'];
$sql = "SELECT * FROM quiz_userinfo where user_id = '$userid' and Password = '$password'";
$result = mysqli_query($conn, $sql);
 
// Find the number of records returned
$num = mysqli_num_rows($result);
if($num> 0){
    echo "<script>
    window.location.href='quiz.php?password=$password';
    </script>";
    }
    else{
        echo "Not registered for quiz";
       }
}
?>
</body>
</html>