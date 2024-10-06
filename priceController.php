<?php
require 'config/database.php';

if (isset($_POST['submit'])) {
    $userid = filter_var($_POST['userid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $name = $firstname." ".$lastname; 
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ref_pin = "pcgwfsub-".substr(rand(0000, time()), 0, 8);

    if (empty($firstname) || empty($lastname) || empty($email) || empty($amount)) {
        
        // echo 'Please fill in all required fields.';
        // exit;
        $_SESSION['price'] = "Please fill in all required fields.";
    }  else {
        // check if user plan or email already exist in datagase
        $user_check_query = "SELECT * FROM pricing WHERE amount='$amount' AND email = '$email'";
        $user_check_result = mysqli_query($connection, $user_check_query);

        if (mysqli_num_rows($user_check_result) > 0) {
            $_SESSION['price'] = "user's plan already exist, please renew plan!";
        } 
    }

    $stmt = $connection->prepare("INSERT INTO `pricing` (`userid`, `firstname`, `lastname`, `email`, `phone`, `amount`, `ref_code`) VALUES (?,?,?,?,?,?,?)");

    $stmt->bind_param("sssssss", $userid, $firstname, $lastname, $email, $phone, $amount, $ref_pin);

    if ($stmt->execute()) {
    	 
    $data = array(
            'tx_ref' => $ref_pin, 
            'amount' => $amount,
            'currency' => 'NGN',
            'redirect_url' => 'http://localhost/projectChaha/subscription.success.php', // here is redirect URL
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
	            header("Location: subscription.success.php");
			        exit;
	        }        
    } else {
        // Display an error message if the insertion fails
        echo "Error: " . $conn->error;
    }
} else {
    // Handle non-POST requests (e.g., display an error message)
    $_SESSION['price'] = "Invalid request method.";
            header('location: pricing.php');
            die();
}
