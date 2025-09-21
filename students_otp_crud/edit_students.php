<?php
require 'config.php'; 

if (isset($_POST['action']) && $_POST['action'] === 'update') {
    
    $id = intval($_POST['edit_id']);
    $name = $_POST['edit_name'];
    $email = $_POST['edit_email'];
    $phone = $_POST['edit_phone_number'];
    $gender = $_POST['edit_gender'];
    $department = $_POST['edit_department'];

    if (!empty($_FILES['image']['name'])) {
        $newImageName = time() . "_" . $_FILES['image']['name']; 
        $target = "uploads/" . $newImageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $sql = "UPDATE students 
                    SET name='$name', email='$email', phone_number='$phone',
                        gender='$gender', department='$department', image='$newImageName'
                    WHERE id=$id";
        } else {
            echo "Pic Not Uploaded!";
            exit;
        }
    } else {
        $sql = "UPDATE students 
                SET name='$name', email='$email', phone_number='$phone',
                    gender='$gender', department='$department'
                WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        echo "Student Was Update";
    } else {
        echo " Error: " . mysqli_error($conn);
    }

}

elseif (isset($_POST['id']) && !empty($_POST['id'])) {
    $id = intval($_POST['id']);
    $sql = "SELECT * FROM students WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);

    $data['image_path'] = !empty($data['image']) ? 'uploads/'.$data['image'] : 'uploads/default.png';

    echo json_encode($data);
}

else {
    echo json_encode(['error' => ' No Id Has been Found']);
}
