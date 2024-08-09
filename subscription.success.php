<?php 
include "config/database.php";
	$user_id = $_SESSION['user-id'];
	$status = $_GET['status'];
	$ref = $_GET['tx_ref'];
	$tx_id = $_GET['transaction_id'];
	$start_date = date('Y-m-d H:i:s');

	if ($status === 'successful') {
		$sql = "UPDATE `pricing` 
                SET `status` = ?,
                `tx_id` = ?
                WHERE `ref_code` = ?";
        $stmt = $connection->prepare($sql);
		$stmt->bind_param("sss", $status, $tx_id, $ref);
		$stmt->execute(); 

		$sql = "UPDATE `users` 
                SET `status` = ?,
				 `subscription_start_date` = ?
                WHERE `id` = ?";
        $stmt = $connection->prepare($sql);
		$stmt->bind_param("sss", $status, $start_date, $user_id);
		$stmt->execute();  
		
		// set session for success message
        $_SESSION['successful'] = true;

		// set session for success message
        $_SESSION['price-success'] = "Subscription successful.";
            header('location: pricing.php');
            die();   
	}else{
		
			$sql = "DELETE FROM `pricing` WHERE `ref_code` = ?";
			$stmt = $connection->prepare($sql);
			$stmt->bind_param("s", $ref);
			$stmt->execute();
		
		header("Location: pages-error-404.php");
	}