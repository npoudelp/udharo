<?php
if(isset($_REQUEST['q'])){
    session_start();
    session_destroy();
    header("location:../index.php");
}
else{
    header("location:../pages/login.php");
}