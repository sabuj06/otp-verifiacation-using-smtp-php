<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "student_management");
if (!$conn) {
    die("Connection failed");
}

// Form data
$name       = $_POST['name'];
$email      = $_POST['email'];
$phone      = $_POST['phone_number'];
$gender     = $_POST['gender'];
$department = $_POST['department'];

// Image upload
$image_name = "";
if (!empty($_FILES['student_image']['name'])) {
    $folder = "uploads/";
    if (!is_dir($folder)) {
        mkdir($folder);
    }
    $image_name = time() . "_" . $_FILES['student_image']['name'];
    move_uploaded_file($_FILES['student_image']['tmp_name'], $folder . $image_name);
}

// Insert query
$sql = "INSERT INTO students (name, email, phone_number, gender, department, image)
        VALUES ('$name','$email','$phone','$gender','$department','$image_name')";

// Result
echo mysqli_query($conn, $sql) ? "success" : "error";

mysqli_close($conn);
?>
