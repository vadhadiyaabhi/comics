<?php

$con=mysqli_connect('localhost','root');
 if(!$con){
    die("Error!; mysqli_connect_error()");
 }
 else
 {
   $a=mysqli_select_db($con,'comics');
 }
 

?>