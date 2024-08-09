<?php 
include 'config/database.php';

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['user-id'];
    $name = filter_var($_POST['ap_pat_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ailment = filter_var($_POST['ap_pat_ailment'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['ap_pat_email'], FILTER_VALIDATE_EMAIL);
    $phone = filter_var($_POST['ap_pat_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $amount = filter_var($_POST['ap_service'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $date = filter_var($_POST['ap_date'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $ref_pin = "pcgwfapt-".substr(rand(0000, time()), 0, 8);

    if (empty($name) || empty($ailment) || empty($email) || empty($amount)) {
        
        // echo 'Please fill in all required fields.';
        // exit;
        $_SESSION['add-user'] = "Please fill in all required fields.";
        header('location: appointment.php');
        die();
    }

    $stmt = $connection->prepare("INSERT INTO `appointments` (`user_id`, `ap_pat_name`, `ap_pat_ailment`, `ap_pat_email`, `ap_pat_phone`, `ap_service`, `ap_date`, `ref_code`) VALUES (?,?,?,?,?,?,?,?)");

    $stmt->bind_param("ssssssss",$user_id, $name, $ailment, $email, $phone, $amount, $date, $ref_pin);

    if ($stmt->execute()) {
    	 
    $data = array(
            'tx_ref' => $ref_pin, 
            'amount' => $amount,
            'currency' => 'NGN',
            'redirect_url' => 'http://localhost/projectChaha/appointment.success.php', // Kator here please replace with your actual redirect URL
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
	            header("Location: appointment.success.php");
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
    header('location: appointment.php');
    die();
}
