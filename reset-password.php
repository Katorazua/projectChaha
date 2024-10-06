<?php
require 'config/database.php';

if (isset($_GET['token'])) {
    $resetToken = $_GET['token'];
    $expiry = date('Y-m-d H:i:s');
    
    // Check if the reset token is valid
    $stmt = $connection->prepare("SELECT * FROM users WHERE reset_token_hash = ? AND reset_token_expiration > ?");
    $stmt->bind_param("ss", $resetToken, $expiry);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update the User's Password
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $newPassword = $_POST['new_password'];
          $password_confirmation = $_POST["password_confirmation"];
          $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

          if  (strlen($newPassword) < 8 || strlen($password_confirmation) < 8) {
              $_SESSION['reset'] = "password should be 8+ character";
          }

          if ($newPassword !== $password_confirmation) {
            $_SESSION['reset'] = "Password do not match";
          }
          
          $stmt = $connection->prepare("UPDATE users SET password = ?, reset_token_hash = NULL, reset_token_expiration = NULL WHERE reset_token_hash = ?");
          $stmt->bind_param("ss", $hashedPassword, $resetToken);
          $stmt->execute();
          
          // echo "Password has been reset. You can now log in.";
          $_SESSION['signup-success'] = "Password has been reset. You can now log in.";
          header('location: signin.php');
          exit;
        }
    } else {
        // echo "Invalid or expired reset token.";
        $_SESSION['reset'] = "Invalid or expired reset token.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset password</title>
  <link rel="stylesheet" href="alpha.css/price.css"> 
</head>
<body style="background-image: url('img/bg-pattern.jpg');background-repeat:no-repeat;background-position:center;background-size:fit;position:relative;">
  <section>
    <div class="modal" style="margin: 40 auto; width: 30%;">   
      <div class="container">
        <h2>Reset Password</h2>
        <?php if(isset($_SESSION['reset'])) : ?>
            <div class="alert_message error">
                <p>
                    <?=  $_SESSION['reset'];
                    unset($_SESSION['reset']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form method="post">
          <div class="form-group">
            <label for="new_password">New password</label>
            <input style="width: 100%;" type="password" id="new_password" name="new_password" required>
          </div>

          <div class="form-group">
            <label for="password_confirmation">Repeat password</label>
            <input style="width: 100%;" type="password" id="password_confirmation" name="password_confirmation" required>
          </div>
 
          <button type="submit" name="submit">Submit</button>
          
        </form>
      </div>
    </div>
  </section>
</body>
</html>