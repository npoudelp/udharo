<?php
if (isset($_REQUEST['q'])) {
    $bid = $_REQUEST['q'];

    include_once("./dbConn.php");

    $sql = "UPDATE balance SET status = 'hide' WHERE bid = {$bid};";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        header("location: ../pages/profile.php");
    } else {
        echo "Error deleting account";
    }
} else {
    header("location:../pages/profile.php");
}
