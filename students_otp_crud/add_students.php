<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Add Student</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"/>
</head>
<body>

<div class="container mt-5">
    <a href="dashboard.php" class="btn btn-primary"> Go To Dashboard</a>
  <h4 class="text-center mb-3">Add Student</h4>

  <form id="addStudentForm" enctype="multipart/form-data">
    <div class="form-group">
      <label>Name:</label>
      <input type="text" name="name" class="form-control" placeholder="Enter name" required />
    </div>

    <div class="form-group">
      <label>Email:</label>
      <input type="email" name="email" class="form-control" placeholder="Enter email" required />
    </div>

    <div class="form-group">
      <label>Phone:</label>
      <input type="text" name="phone_number" class="form-control" placeholder="Enter phone" required />
    </div>

    <div class="form-group">
      <label>Gender:</label>
      <select name="gender" class="form-control" required>
        <option value="">Select</option>
        <option>Male</option>
        <option>Female</option>
      </select>
    </div>

    <div class="form-group">
      <label>Department:</label>
      <input type="text" name="department" class="form-control" placeholder="Enter Department" required />
    </div>

<div class="form-group">
    <label>Image:</label>
    <input type="file" id="studentImage" class="form-control" name="student_image" accept="image/*" required>
    <img id="imagePreview" style="max-width:200px; max-height:150px; margin-top:5px; display:none;">
</div>

    <button type="submit" class="btn btn-primary btn-block">Add Student</button>
  </form>
</div>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 
<script>

$(document).ready(function(){
  $("#studentImage").on("change", function(event){
    var reader = new FileReader();

    reader.onload = function(e){
      $("#imagePreview").attr("src", e.target.result).show();
    };

    reader.readAsDataURL(event.target.files[0]);
  });
});

$(document).ready(function(){
  $("#addStudentForm").on("submit", function(e){
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      url: "insert_students.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        if(response.trim() == "success"){
          alert("Student added successfully!");
          $("#addStudentForm")[0].reset();
          $("#imagePreview").hide();
        } else {
          alert("Error: " + response);
        }
      }
    });
  });
});
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
