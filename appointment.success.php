<?php 
include "config/database.php";

	$status = $_GET['status'];
	$ref = $_GET['tx_ref'];
	$tx_id = $_GET['transaction_id'];
	$start_date = date('Y-m-d H:i:s');

	if ($status === 'successful') {
		$sql = "UPDATE `appointments` 
                SET `status` = ?,
                `tx_id` = ?,
                `date_time` = ?
                WHERE `ref_code` = ?";
                $stmt = $connection->prepare($sql);
		$stmt->bind_param("ssss", $status, $tx_id, $start_date, $ref);
		$stmt->execute();  
		
		// set session for user authorization
                $_SESSION['user_is_successful'] = true; 

		// set session success message 
                $_SESSION['add-user-success'] = "Appointment Rquiest Sent successfully.";
                header('location: appointment.php');
                die();

	}else{

                $sql = "DELETE FROM `appointments` WHERE `ref_code` = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bind_param("s", $ref);
                $stmt->execute();

                header("Location: pages-error-404.php");
	}