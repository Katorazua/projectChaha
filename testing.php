<?php
require 'config/database.php';
if (isset($_SESSION['user-id'])) {
    $user_subscription_start_date = $_SESSION['user-id'];
    $stmt = $connection->prepare("SELECT subscription_start_date FROM users WHERE id = $user_subscription_start_date ");
    $stmt->execute();
    $stmt->bind_result($start_date);
    $stmt->fetch();
    $stmt->close();
}
// Set the subscription start date
$subscription_start_date = $start_date;

// Set the subscription duration (in days)
$subscription_duration = 1;

// Calculate the subscription expiry date
$subscription_expiry_date = date('Y-m-d H:i:s', strtotime($subscription_start_date . ' + ' . $subscription_duration . ' days'));

// Calculate the number of days remaining
$days_remaining = (strtotime($subscription_expiry_date) - strtotime(date('Y-m-d H:i:s'))) / (60 * 60 * 24);

// Send a notification 30 days before expiry
if ($days_remaining <= 30) {
    $notification_message = "Your subscription will expire on " . $subscription_expiry_date . ". Please renew your subscription.";
    // Add your notification code here (e.g., email, push notification, SMS)
    echo $notification_message;
}

if ($days_remaining < 1) {
    $subscription_end_date = "expired";
    $expiry_message = "Dear user, you are out of balance!";
    // update users data
    $stmt = $connection->prepare("UPDATE users SET status = ?");
    $stmt->bind_param("s", $subscription_end_date);
    $stmt->execute();

    echo $expiry_message;
}

// Output the subscription timeline
echo "Subscription start date: " . $subscription_start_date . "\n";
echo "Subscription expiry date: " . $subscription_expiry_date . "\n";
echo "Days remaining: " . round($days_remaining) . "\n";

 
// Here's how the code works:===================

// The $subscription_start_date variable is set to the date the subscription began.
// The $subscription_duration variable is set to the duration of the subscription in days.
// The $subscription_expiry_date variable is calculated by adding the subscription duration to the start date using the strtotime() function and the date() function.
// The $days_remaining variable calculates the number of days remaining until the subscription expires by subtracting the current date from the expiry date and dividing the result by the number of seconds in a day.
// If the number of days remaining is less than or equal to 30, a notification message is generated and output to the console. You'll need to add your own code to actually send the notification (e.g., via email, push notification, SMS).
// Finally, the script outputs the subscription start date, expiry date, and the number of days remaining.
// You can customize this code to fit your specific requirements, such as using a different subscription duration or modifying the notification logic.
?>

