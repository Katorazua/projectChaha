<?php
include 'header.php';

if (isset($_SESSION['user-id'])) {
	//echo "Welcome ".$_SESSION['name'];
	$current_user_id = $_SESSION['user-id'];
}else{
	// header("location:signin.php");
    header('location:' . ROOT_URL . 'signin.php');
}

if (isset($_GET['id'])) {
    $user_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM appointments WHERE doc_id = $user_id";
    $result = mysqli_query($connection, $query);
    $incoming = mysqli_fetch_assoc($result);
}

// REQUEST TO SUBMIT FORM
if (isset($_POST['submit'])) {
    $outgoing_id = $current_user_id;
    $incoming_id = $_POST['incoming_id'];
    $message = $_POST['message'];

    $msg_query = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, message) VALUES ('$incoming_id', '$outgoing_id', '$message')";
    $msg_result = mysqli_query($connection, $msg_query);
}

?>

<div class="wrapper">
    <section class="chat-area">
        <header>
            <?php
                $user_id = $incoming['doc_id'];
                $query = "SELECT * FROM doctors WHERE id = $user_id";
                $result = mysqli_query($connection, $query);
                $row = mysqli_fetch_assoc($result);
            
            ?>
            <a href="../users/view-appointment.php" class="back-icon"><i class="bi bi-arrow-left-circle-fill"></i></a>
            <img src="<?= ROOT_URL . 'images/' . $row['avatar'] ?>" alt="photo">
            <div class="content">
                <div class="details">
                    <span><?= $row['firstname'] . " " . $row['lastname'] ?></span>
                    <p><?= $row['status'] ?></p>
                </div>
            </div>
        </header>
        <hr />
        <div class="chat-box">

            
		 		<?php 
	                $outgoing_id = $_SESSION['user-id'];
	                $incoming_id = $incoming['doc_id'];

		 			$sql1="SELECT * FROM messages WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id= {$incoming_id}) OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id= {$outgoing_id}) ORDER BY id DESC";
		 			$query1=mysqli_query($connection,$sql1);

		 			if (mysqli_num_rows($query1) > 0){
		 				while ($row=mysqli_fetch_array($query1)) {
		 				if ($row['outgoing_msg_id'] == $outgoing_id) {
		 					?>
		 			
                        <div class="chat outgoing">
                            <div class="details">
                                <a href="#" class="delete-message" data-message-id="<?= $row['id'] ?>"><i class="bi bi-trash-fill"></i></a>
                                <p><?= $row['message'] ?>
                                    <br><br>
                                    <?= date("M D, Y - H:i", strtotime($row['date_time'])) ?>
                                </p>
                            </div>
                        </div>
 
		 				<?php 
		 				}else{
		 					?>
                            <div class="chat incoming">
                                <?php
                                $user_id = $incoming['doc_id'];
                                $query = "SELECT avatar FROM doctors WHERE id = $user_id";
                                $result = mysqli_query($connection, $query);
                                $user = mysqli_fetch_assoc($result);
                                ?>
                                <img src="<?= ROOT_URL . 'images/' . $user['avatar'] ?>" alt="photo">
                                <div class="details">
                                    <p><?= $row['message'] ?>
                                        <br><br>
                                        <?= date("M D, Y - H:i", strtotime($row['date_time'])) ?>
                                    </p>
                                </div>
                            </div>

		 					<?php 
		 				}
                    }
		 		}
		 		?>
        </div>

        <form action="#" method="POST" class="typing-area" autocomplete="off" enctype="multipart/form-data">
            <input type="hidden" name="incoming_id" value="<?= $incoming['doc_id'] ?>">
            <input type="text" name="message" placeholder="Type a message here...">
            <button name="submit"><i class="bi bi-telegram"></i></button>
        </form>
    </section>
</div>

<script>
    // Add event listener to delete message links
    document.querySelectorAll('.delete-message').forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const messageId = event.target.dataset.messageId;
            // Implement delete message functionality here
            console.log('Deleting message with ID:', messageId);
        });
    });
</script>
</body>
</html>
