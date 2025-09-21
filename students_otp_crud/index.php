<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'config.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'src/Exception.php';

session_start();
if(isset($_SESSION['user_email'])){
  header("Location:dashboard.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   echo $email = trim($_POST['email']);  
   
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die(" Invalid Email Format!");
    }
 
    $otp   = rand(100000, 999999);

    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conn, "UPDATE users SET otp='$otp', is_verified=0 WHERE email='$email'");
    } else {
        mysqli_query($conn, "INSERT INTO users (email, otp, is_verified) VALUES ('$email', '$otp', 0)");
    }

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'sabujadak006@gmail.com';  
        $mail->Password   = 'usrxoyacagnmuyxi';      
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('sabujadak006@gmail.com', 'Student System');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "Your OTP is <b>$otp</b>";

        $mail->send();

        header("Location: verify.php?email=" . urlencode($email));
        exit;
    } catch (Exception $e) {
        echo "OTP sending failed: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
  <h2>Register Your Email</h2>
  <form method="POST" action="">
    <div class="mb-3 mt-3">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
    </div>
    <button type="submit" class="btn btn-primary">Send OTP</button>
  </form>
</div>
</body>
</html>
