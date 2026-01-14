<?php
require_once('config.php');

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["status"] !== "admin") {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $booking_id = isset($_GET['id']) ? $_GET['id'] : null;

    if ($booking_id !== null) {
        // Update the booking status to 'Confirmed'
        $confirmSql = "UPDATE `booking` SET bookingstatus = 1 WHERE id = $booking_id";

        if (mysqli_query($link, $confirmSql)) {
            header("location: view.php");
            exit;
        } else {
            echo "Error: " . $confirmSql . "<br>" . mysqli_error($link);
        }
    } else {
        echo "Error: Booking ID not set.";
    }
}
?>
