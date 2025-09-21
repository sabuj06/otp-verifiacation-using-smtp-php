<?php
require 'config.php';

$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);

$output = "";
while($row = mysqli_fetch_assoc($result)){
if (!empty($row['image'])) {
    $imagePath = 'uploads/' . $row['image'];
} else {
    $imagePath = 'uploads/default.png';
}

    $output .= "<tr>
        <td><img src='$imagePath' width='50' height='50' style='object-fit:cover;'></td>
        <td>{$row['name']}</td>
        <td>{$row['email']}</td>
        <td>{$row['phone_number']}</td>
        <td>{$row['gender']}</td>
        <td>{$row['department']}</td>
        <td>
            <button class='btn btn-primary btn-sm editBtn' data-id='{$row['id']}'>Edit</button>
            <button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['id']}'>Delete</button>
        </td>
    </tr>";
}

echo $output;
