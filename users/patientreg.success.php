<?php 
include "../config/database.php";

	$status = $_GET['status'];
	$ref = $_GET['tx_ref'];
	$tx_id = $_GET['transaction_id'];
	$start_date = date('Y-m-d H:i:s');

	if ($status === 'successful') {
		$sql = "UPDATE `patients` 
                SET `status` = ?,
                `tx_id` = ?,
                `date_time` = ?
                WHERE `ref_pin` = ?";
                $stmt = $connection->prepare($sql);
		$stmt->bind_param("ssss", $status, $tx_id, $start_date, $ref);
		$stmt->execute();  
		
		// set session for user authorization
                $_SESSION['user_is_successful'] = true; 

		// set session success message 
                $_SESSION['add-user-success'] = "Registration successful.";
                header('location: manage-patients.php');
                die();

	}else{

                $sql = "DELETE FROM `patients` WHERE `ref_pin` = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("s", $ref);
                $stmt->execute();

                header("Location: pages-error-404.php");
	}