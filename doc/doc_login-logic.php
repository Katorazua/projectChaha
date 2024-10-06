<?php
require '../config/database.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["doc_number"];
    $password = $_POST["password"];

    // Prepare the SQL query
    $stmt = $connection->prepare("SELECT * FROM doctors WHERE doc_number = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Login successful, store the user's information in the session
            $_SESSION["user-id"] = $row["id"];

                // update doctor's details
                $status = "Active now";
                $sql = "UPDATE `doctors` 
                    SET `status` = ?
                    WHERE `id` = ?";
                    $stmt = $connection->prepare($sql);
                    $stmt->bind_param("ss", $status, $_SESSION['user-id']);
                    $stmt->execute();

            // Set session based on user role
            if ($row['role'] == 'Medical_Doctor') {
                $_SESSION['user_is_doctor'] = true;
                header('location:' . ROOT_URL . 'doc/index.php');

            } else {
                header('location:' . ROOT_URL . 'pages-error-404.php');
            }

        } else {
            // $error_message = "Invalid username or password.";
            $_SESSION['signin'] = "Invalid user ID or password.";
        }
    } else {
        // $error_message = "Invalid username or password.";
        $_SESSION['signin'] = "Invalid user input!";
    }

    // If any problem, redirect to signin page with login data
    if (isset($_SESSION['signin'])) {
        $_SESSION['signin-data'] = $_POST;
        header('location: doc-login.php#msg');
        die();
    }

    $stmt->close();
} else {
    header('location: doc-login.php#msg');
}

$connection->close();


