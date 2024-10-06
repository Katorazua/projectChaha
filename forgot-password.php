<?php
// Database connection details
$host = "localhost";
$username = "Alpha";
$password = "alpha@management.services";
$database = "projectchaha";

// SMTP settings
$smtp_host = "smtp.gmail.com";
$smtp_port = 587;
$smtp_username = "katorazua674@gmail.com";
$smtp_password = "osep oltl mpsa yktq";

// Connect to the database
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Include the PHPMailer library
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Query the database to check if the email exists
    $sql = "SELECT id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row["id"];
        $user_email = $row["email"];
        $user_password = $row["password"];

        // Generate a reset token and set expiry date
        $reset_token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", time() + 60 * 60); // token expires after 60min

        // Update the user's reset token in the database
        $sql = "UPDATE users SET reset_token_hash = ?, reset_token_expiration = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $reset_token, $expiry, $user_id);
        $stmt->execute();

        // Send the password reset email
        $to = $user_email;
        $subject = "Password Reset Request";
        $message = "To reset your password, Make sure the date and time on yourphone or PC is up to date (current date-time), please click the following link:\n\n";
        $message .= "http://localhost/projectChaha/reset-password.php?token=" . $reset_token;

        $headers = "From: noreply@example.com\r\n";
        $headers .= "Reply-To: noreply@example.com\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Set up the SMTP mailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = $smtp_host;
        $mail->Port = $smtp_port;
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_username;
        $mail->Password = $smtp_password;
        $mail->SMTPSecure = 'tls';
        $mail->Timeout = 86400; // Set the timeout to 24 hours (86,400 seconds)


        $mail->setFrom("noreply@gmail.com", "Password Reset");
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;

        if ($mail->send()) {
            $_SESSION['signup-success'] = "A password reset token has been sent to your email. Please check your inbox.";
        } else {
            echo "Error sending email: " . $mail->ErrorInfo;

        }
    } else {
        $_SESSION['signup'] = "No user found with the provided email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset pasword-Chaha Eye Hospitals</title>
    <meta content="Chaha Hospitals" name="keywords">
    <meta content="Chaha Eye Hospital" name="description">
     <!-- custom links -->
     <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/modifile.css">
    <link rel="stylesheet" href="assets/vendor/bootstrap-icons/bootstrap-icons.css">

</head>
<body>
    <!--================Set token Area =================-->
    <section class="login_part section_padding ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>New to our Site?</h2>
                            <p>Make sure the date and time on yourphone or PC is up to date (current date-time)</p>
                            <a href="signin.php" class="btn_3">continue with login</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <section class="form login">
                        <div class="login_part_form_iner">
                            <h3>Forgot Your Password ?<br> 
                            Don't Panick We Gat You !</h3>
                            <?php if (isset($_SESSION['signup-success'])) : ?>
                                <div class="alert_message success">
                                    <p>
                                        <?=  $_SESSION['signup-success'];
                                        unset($_SESSION['signup-success']);
                                        ?>
                                        </p>
                                </div>
                                <?php elseif (isset($_SESSION['signup'])) : ?>
                                <div class="alert_message error">
                                    <p>
                                        <?=  $_SESSION['signup'];
                                        unset($_SESSION['signup']);
                                        ?>
                                        </p>
                                </div>
                            <?php endif ?>
                        
                            <form method="post">
                                <div class="field input">
                                    <label for="name">Provide Your Email Address</label>
                                    <input type="email" name="email"
                                        placeholder="example@email.com">
                                </div>
                                <div class="field button">
                                    <input type="submit" name="submit" value="Reset Password">
                                </div>
                            </form>                                               
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    <!--================Set token end =================-->
    
    <script src="assets/js/pass-shwo-hide.js"></script>

</body>
</html>

