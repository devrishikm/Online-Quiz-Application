<html>
<head>
<style>
    body {
    Background-color:slateblue;
    padding:10px;
    text-align:center;
    font-family: Poppins-Regular,sans-serif;
    }
    h1 {
        color:white;
        font-size:50px;
    }
    h2 {
        color: mediumseagreen;
        font-size:70px;
    }
</style>
</head>
<body>
<?php
$servername = "127.0.0.1";
$username = "root";
$_password = "";
$database = "quiz";
// Create a connection
$conn = mysqli_connect($servername, $username, $_password, $database);

if (!$conn){
 die("Sorry we failed to connect: ". mysqli_connect_error());
}
else{
//  echo "Connection is successful<br>";
}    
$now = new DateTime();
$enddatetime = $now->format('Y-m-d H:i:s');
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    #entry through form
    $startdatetime = $_POST['startdatetime'];
    $password = $_POST['password'];
    $sql = "SELECT q_no,ans FROM `quiz_answerinfo`";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if($num> 0){
    $inssql="INSERT INTO quiz_user_result(password,Question_1_option,Question_2_option,Question_3_option,Question_4_option,Question_5_option,Question_6_option,Question_7_option,Question_8_option,Question_9_option,Question_10_option,score,starttime,endtime) VALUES ('$password', ";
    $anscount=0;
    while($row = mysqli_fetch_assoc($result)){
        // compare ans
        $aa=$_POST['option'.$row['q_no']];
        if($row['ans']==$aa)
        {
            $anscount++;
        }
        
        $inssql.="'$aa',";
    }
    $inssql.=$anscount.',';
    $inssql.="'$startdatetime',";
    $inssql.="'$enddatetime');";
    echo "<h1>". "Marks Obtained: "."</h1>" ."<h2>".$anscount."</h2>";
    /*$sql1 = "INSERT INTO quiz_user_result(user_id,Question_1_option,Question_2_option,Question_3_option) VALUES ('$userid', '$selected_option1','$selected_option2','$selected_option3')";*/
    $result1 = mysqli_query($conn, $inssql);

    }
}
?>
</body>
</html>
