<?php
if(isset($_REQUEST['q'])){
    $email = $_REQUEST['q'];
    include_once('./dbConn.php');
    $sql = "SELECT emailId FROM loginData WHERE emailId='{$email}';";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "0";
    }
    else{
        echo "1";
    }
    
}
else{
    header("location: ../pages/register.php");
}