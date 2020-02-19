<?php
$localhost = 'localhost';
$username = 'root';
$password = '';
	
	$con = mysqli_connect($localhost,$username,$password, 'aptitude');
    
    if(!isset($con)){
        echo 'Aptitude Database Error!';
    }
?>