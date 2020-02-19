<?php
    session_start();
    
    session_destroy();
    $expiry = time()-4000;
    $name = $_COOKIE['student'];
    $roll = $_COOKIE['roll_no'];
    
    setcookie("student", $name, $expiry);
    setcookie("roll_no", $roll, $expiry);
    
    header("location: index.php");
?>