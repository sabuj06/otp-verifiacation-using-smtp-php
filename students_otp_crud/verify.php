<?php 
include 'config.php';
session_start();
if(!isset($_GET['email'])){
  header("Location:index.php");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
  $email=$_POST["email"];
  $otp=$_POST["otp"];
  $stmt=mysqli_prepare($conn,"SELECT id From users where email=? AND otp=? AND is_verified = 0");
  mysqli_stmt_bind_param($stmt,"ss",$email,$otp);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
  if(mysqli_stmt_num_rows($stmt)==1){
  $stmt=mysqli_prepare($conn,"UPDATE users set is_verified=1 WHERE email=?");
  mysqli_stmt_bind_param($stmt,"s",$email);
  mysqli_stmt_execute($stmt);
  $_SESSION["user_email"]=$email;
  header("Location:dashboard.php");
  exit;
  }
  else{
    die("Invalid OTP!");
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Verify Otp</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-5">
  <h2  class="text-center">Enter Otp</h2>
  <?php if(isset($error)) echo"<div class='alert alert-danger'>$error</div>"?>
  <form method="POST">
    <div class="mb-3 mt-3">
      <input type="hidden" class="form-control" id="email"  name="email" value="<?php echo htmlspecialchars($_GET["email"])?>">
    </div>
    <div class="mb-3">
      <label for="otp">Otp Code</label>
      <input type="text" class="form-control"  placeholder="Enter otp" name="otp">
    </div>
    <button type="submit" class="btn btn-success">Verify</button>
  </form>
</div>
</body>
</html>
