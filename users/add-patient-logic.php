<?php
require '../config/database.php';
if (isset($_POST['submit'])) {
  // get signup form data if signup button was clicked
    $admin_id = $_SESSION['user-id'];
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $dob = filter_var($_POST['DOB'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $age = filter_var($_POST['age'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $addr = filter_var($_POST['addr'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $gender = filter_var($_POST['gender'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $city = filter_var($_POST['city'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $pat_ailment = filter_var($_POST['pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ref_pin = "pcgwfapt-".substr(rand(0000, time()), 0, 8);

  // redirect back to add-patient page if there was any problem
  if (isset($_SESSION['add-user'])) {
    // pass form data back to add-user page
    $_SESSION['add-user-data'] = $_POST;
    header('location: patient-registration.php');
    die();
  } 

  $stmt = $connection->prepare("INSERT INTO `patients` (`admin_id`, `pat_fname`, `pat_lname`, `pat_email`, `pat_dob`, `pat_age`, `pat_addr`, `pat_gender`, `pat_phone`, `pat_country`, `pat_ailment`, `ref_pin`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

  $stmt->bind_param("ssssssssssss",$admin_id, $firstname, $lastname, $email, $dob, $age, $addr, $gender, $phone,$city, $pat_ailment, $ref_pin);

  if ($stmt->execute()) {
    
    $data = array(
            'tx_ref' => $ref_pin, 
            'amount' => $amount,
            'currency' => 'NGN',
            'redirect_url' => 'http://localhost/projectChaha/patientreg.success.php', // Kator here please replace with your actual redirect URL
            'meta' => array(
                // Empty
            ),
            'customer' => array(
                'email' => $email,
                'phonenumber' => $phone, 
                'name' => $name,
            ),
            'customizations' => array(
                'title' => 'Chaha Eye Clinic.',
                'logo' => 'logo.png'
            )
        );

    $url = 'https://api.flutterwave.com/v3/payments';

        $headers = array(
            "Authorization: Bearer $flutterwaveSecretKey",
            "Content-Type: application/json"
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $decodedResponse = json_decode($response, true);
            if (isset($decodedResponse['status']) && $decodedResponse['status'] === 'success') {
                $data_link = $decodedResponse['data']['link'];
                
                header("Location: $data_link");
                exit;
            } else {
                // Handle unsuccessful response from Flutterwave
                echo 'Payment initiation failed: ' . $decodedResponse['message'];
            }
                header("Location: patientreg.success.php");
                exit;
            }        
    } else {
        // Display an error message if the insertion fails
        echo "Error: " . $conn->error;
    }
    
} else {
// Handle non-POST requests (e.g., display an error message)
// echo 'Invalid request method.';
$_SESSION['add-user'] = "Invalid request method.";
header('location: patient-registration.php');
die();
}