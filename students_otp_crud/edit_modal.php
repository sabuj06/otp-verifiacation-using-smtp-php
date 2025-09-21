<!DOCTYPE html>
<html lang="en">
<head>
  <title>Small Edit Modal</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container mt-5">
  <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Edit Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <form id="editForm" enctype="multipart/form-data">
            <input type="hidden" name="edit_id" id="edit_id">

            <input type="text" name="edit_name" id="edit_name" class="form-control mb-2" placeholder="Name">

            <input type="email" name="edit_email" id="edit_email" class="form-control mb-2" placeholder="Email">

            <input type="text" name="edit_phone_number" id="edit_phone_number" class="form-control mb-2" placeholder="Phone">

            <select name="edit_gender" id="edit_gender" class="form-control mb-2">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>

            <input type="text" name="edit_department" id="edit_department" class="form-control mb-2" placeholder="Department">

            <img id="edit_image_preview" src="" alt="Image" width="80" height="80" class="mb-3 border">

            <input type="file" name="image" id="edit_image" class="form-control">

            <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" id="updateBtn" class="btn btn-primary">Update</button>
        </div>
          </form>
        </div>

        

      </div>
    </div>
  </div>

</div>
</body>
</html>


