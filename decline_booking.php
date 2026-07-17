<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = (int)$_GET['id'];

$conn->query("UPDATE Bookings
SET Status='Declined'
WHERE BookingID='$id'");

header("Location: view_bookings.php");
exit();
?>