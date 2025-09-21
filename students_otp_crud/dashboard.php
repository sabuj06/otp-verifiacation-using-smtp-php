<?php  
include 'edit_modal.php';
session_start();
if(!isset($_SESSION["user_email"])){
   header("Location:index.php");
    exit;
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <div class="text-center">
        <h3>WelCome, <?=htmlspecialchars($_SESSION["user_email"]); ?></h3>
    </div>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="add_students.php" class="btn btn-success">Add Students</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>

    <h4 class="text-center">Student List</h4>
    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Department</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="studentTable">
            <tr><td colspan="7" class="text-center">Loading....</td></tr>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function(){
 
    function loadstudents(){
        $.ajax({
            url:"featch_students.php",
            type:"GET",
            success:function(data){
                $("#studentTable").html(data);
            }
        });
    }
    loadstudents();

    $(document).on("click", ".deleteBtn", function(){
        if(confirm("Are you sure you want to delete this student?")){
            var id = $(this).data("id");
            $.ajax({
                url: "delete_students.php",
                type: "POST",
                data: { student_id: id },
                success: function(response){
                    alert(response);
                    loadstudents();
                }
            });
        }
    });

    $(document).on("click", ".editBtn", function(){
        var id = $(this).data("id");
        $.ajax({
            url: "edit_students.php",  
            type: "POST",
            data: { id: id },
            dataType: "json",
            success: function(data){
                if (data.error) {
                    alert(data.error);
                    return;
                }
                $("#edit_id").val(data.id);
                $("#edit_name").val(data.name);
                $("#edit_email").val(data.email);
                $("#edit_phone_number").val(data.phone_number);
                $("#edit_gender").val(data.gender);
                $("#edit_department").val(data.department);

                var imgPath = "uploads/" + data.image;
                $("#edit_image_preview").attr("src", imgPath);

                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
            }
        });
    });


    $(document).on("change", "#edit_image", function(e){
        let reader = new FileReader();
        reader.onload = function(e){
            $("#edit_image_preview").attr("src", e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on("submit", "#editForm", function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("action", "update"); 

        $.ajax({
            url: "edit_students.php", 
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
                $("#editModal").modal("hide"); 
                loadstudents(); 
            }
        });
    });
});
</script> 
</body>
</html>
