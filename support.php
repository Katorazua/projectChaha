<?php 
require 'config/database.php';

if (isset($_POST['submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = filter_var($_POST['phone'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ref_pin = "pcgwf" .substr(rand(0000, time()), 0, 8);
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($name) || empty($email) || empty($amount)) {
        
        // echo 'Please fill in all required fields.';
        // exit;
        $_SESSION['add-user'] = "Please fill in all required fields.";
        header('location: index.php#support');
        die();

    }

    $stmt = $connection->prepare("INSERT INTO `support` (`name`, `email`, `phone`, `amount`, `ref_pin`, `comment`) VALUES (?,?,?,?,?,?)");
    $stmt->bind_param("ssssss", $name, $email, $phone, $amount, $ref_pin, $comment);

    if ($stmt->execute()) {
    	 
    $data = array(
            'tx_ref' => $ref_pin, 
            'amount' => $amount,
            'currency' => 'NGN',
            'redirect_url' => 'http://localhost/projectChaha/support_success.php', // here is the redirect URL
            'meta' => array(
                // Empty
            ),
            'customer' => array(
                'email' => $email,
                'phonenumber' => $phone, 
                'name' => $name
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
	            header("Location: success.php");
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
        header('location: index.php#support');
        die();
    
}
