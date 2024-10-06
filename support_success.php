<?php 
include "config/database.php";

	$status = $_GET['status'];
	$ref = $_GET['tx_ref'];
	$tx_id = $_GET['transaction_id'];

	if ($status === 'successful') {
		$sql = "UPDATE `support` 
                SET `status` = ?,
                `transaction_id` = ?
                WHERE `ref_pin` = ?";
        $stmt = $connection->prepare($sql);
		$stmt->bind_param("sss", $status, $tx_id, $ref);

		$stmt->execute();  
		
		$_SESSION['add-user-success'] = "Your message recived successfully. Thank you!.";
        header('location: index.php#support');
        die();      
	}else{
		
			$sql = "DELETE FROM `support` WHERE `ref_pin` = ?";
			$stmt = $connection->prepare($sql);
			$stmt->bind_param("s", $ref);
			$stmt->execute();
		
        header("Location: pages-error-404.php");
	}