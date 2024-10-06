<?php 
include 'partials/header.php'; 
if(isset($_SESSION['user-id'])){
    $userID = $_SESSION['user-id'];
    $user_query = "SELECT * FROM users WHERE id=$userID";
    $user_result = mysqli_query($connection,$user_query);
    $user = mysqli_fetch_assoc($user_result);
}

//get back form data if there was a registration error
$ap_pat_ailment = $_SESSION['add-user-data']['ap_pat_ailment'] ?? null;
$ap_date = $_SESSION['add-user-data']['ap_date'] ?? null;
$ap_pat_number = $_SESSION['add-user-data']['ap_pat_number'] ?? null;

// delete session data
unset($_SESSION['add-user-data']);
?>
   
    <!-- Appointment Start -->
    <div data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="display-5  mb-4">We Are A Certified and Award Winning Eye Hospital You Can Trust</h1>
                        <p class="mb-0">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="appointment-form h-100 d-flex flex-column justify-content-center text-center p-4 wow zoomIn" data-wow-delay="0.6s">
                        <?php if(isset($_SESSION['add-user-success'])) :  // show if add-user is successful ?>
                            <div class="alert_message success text-center container">
                                <p>
                                <?=  $_SESSION['add-user-success'];
                                unset($_SESSION['add-user-success']);
                                ?>
                                </p>
                            </div>
                        <?php elseif(isset($_SESSION['add-user'])) :  // show if add-user was NOT successful ?>
                            <div class="alert_message error container">
                                <p>
                                <?=  $_SESSION['add-user'];
                                unset($_SESSION['add-user']);
                                ?>
                                </p>
                            </div>
                        <?php endif ?>
                        <h1 class="text-white mb-4">Make Appointment</h1>
                        <form action="appointment-logic.php" method="POST">
                            <div class="row g-3">
                            <?php
                            //  fetch services from database
                                $query = "SELECT * FROM services ORDER BY RAND()";
                                $services = mysqli_query($connection, $query);
                            ?>
                                <div class="col-12 col-sm-6">
                                    <select name="ap_service" class="form-select bg-light border-0" style="height: 55px;">
                                        <option selected>Select A Service</option>
                                        <?php while ($service = mysqli_fetch_assoc($services)) : ?>
                                            <option value="<?= "{$service['title']} (NGN {$service['prices']}) " ?>"><?= "{$service['title']} (NGN {$service['prices']}) " ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="ap_pat_ailment" class="form-control bg-light border-0" value="<?=$ap_pat_ailment?>" placeholder="Your Ailment" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" name="ap_pat_name" value="<?="{$user['firstname']} {$user['lastname']}"?>" class="form-control bg-light border-0" placeholder="Your Name (in full)" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="ap_pat_email" value="<?= $user['email'] ?>" class="form-control bg-light border-0" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input name="ap_date" type="date" value="<?=$ap_date?>"
                                            class="form-control bg-light border-0 datetimepicker-input"
                                            placeholder="Appointment Date" data-target="#date1" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="time" id="time1" data-target-input="nearest">
                                        <input type="text" name="ap_pat_number" value="<?=$ap_pat_number?>"
                                            class="form-control bg-light border-0 datetimepicker-input"
                                            placeholder="Your Phone Number" data-target="#time1" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 py-3" name="submit">Make Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->
    
<?php include 'partials/footer.php'; ?>