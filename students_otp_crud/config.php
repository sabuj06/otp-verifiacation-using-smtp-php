<?php 
$servername="localhost";
$username="root";
$password="";
$dbname="student_management";
$conn=mysqli_connect($servername,$username,$password,$dbname);
if(!$conn){
 die("Mysqli Connect Error". mysqli_connect_error());
}
?>