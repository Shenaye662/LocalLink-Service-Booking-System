<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<h2>Book a Service</h2>

<form action="submit_booking.php" method="POST">

    <input type="text" name="service" placeholder="Service Name" required><br><br>

    <input type="date" name="date" required><br><br>

    <input type="time" name="time" required><br><br>

    <textarea name="description" placeholder="Describe what you need"></textarea><br><br>

    <button type="submit">Book Now</button>

</form>