<?php
include 'config.php';
session_start();

if(!isset($_SESSION['user_email'])){
    echo json_encode(["error" => "Access Denied"]);
    exit;
}

if(isset($_POST['student_id'])){
    $id = intval($_POST['student_id']);
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);

        // Full image path বানানো
       $row['image'] = !empty($row['image']) ? $row['image'] : 'default.png';


        echo json_encode($row);
    } else {
        echo json_encode(["error" => "No student found"]);
    }
} else {
    echo json_encode(["error" => "No ID provided"]);
}
?>
