<?php
include 'config.php';
session_start();
if(!isset($_SESSION['user_email'])){
    echo "Access Denied";
    exit;
}

if(isset($_POST['student_id'])){
    $id = intval($_POST['student_id']);
    $sql = "DELETE FROM students WHERE id = $id";
    if(mysqli_query($conn, $sql)){
        echo "Student deleted successfully.";
    } else {
        echo "Error deleting student: ". mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
