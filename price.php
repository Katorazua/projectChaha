<?php
require 'config/database.php';
 
if (isset($_GET['id'])) {
  $user_id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $user_query = "SELECT * FROM users WHERE id= $user_id";
  $user_result = mysqli_query($connection, $user_query);
  $row = mysqli_fetch_assoc($user_result);
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chaha Eye Hospital|Pricing Form</title>
  <link rel="stylesheet" href="alphacss/price.css">
</head>
<body style="background-image: url('img/bg-pattern.jpg');background-repeat:no-repeat;background-position:center;background-size:fit;position:relative;">    
  <section>
    <div class="modal">   
      <div class="container">
        <h2>Personal Information</h2>
        <?php if(isset($_SESSION['price'])) : ?>
            <div class="alert_message error">
                <p>
                    <?=  $_SESSION['price'];
                    unset($_SESSION['price']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="priceController.php" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="hidden" name="userid" value="<?=$row['id']?>">
            <input type="text" id="firstname" name="firstname" value="<?=$row['firstname']?>" required>
          </div>

          <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" id="lastname" name="lastname" value="<?=$row['lastname']?>" required>
          </div>

          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?=$row['email']?>" required>
          </div>

          <div class="form-group">
            <label for="phone">Phone Number:</label>
            <input type="tel" id="phone" name="phone" value="<?=$row['phone']?>" required>
          </div>

          <div class="form-group">
            <label for="	amount">Select an option</label>
            <?php
              $user_id = $_SESSION['user-id'];
              $sql = "SELECT amount FROM pricing WHERE userid=$user_id";
              $result = mysqli_query($connection,$sql);
              $user = mysqli_fetch_assoc($result);
             ?>
            <select type="select" id="amount" name="amount" required>
              <?php if ($user['amount'] == true) :?>
              <option value="<?=$user['amount']?>" selected><?=$user['amount']?>(Current)</option>
              <?php else :?>
              <option value="NILL" selected>NILL</option>
              <?php endif ?>
              <option value="Silver(500000)">Silver</option>
              <option value="Gold(750000)">Gold</option>
              <option value="Diamond(1000000)">Diamond</option>
            </select>
          </div>

          <button type="submit" name="submit">Submit</button>
          <a href="pricing.php">Close</a>
          
        </form>
      </div>
    </div>
  </section>
</body>
</html>


    <!-- Pricing End -->