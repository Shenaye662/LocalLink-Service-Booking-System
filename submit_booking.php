<?php
session_start();
include "../includes/config.php";

// Check if logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['user_id'];

// Get CustomerID from Customers table
$sqlCustomer = "SELECT CustomerID FROM Customers WHERE UserID = '$userID'";
$resultCustomer = $conn->query($sqlCustomer);

if ($resultCustomer->num_rows == 0) {
    die("Customer profile not found.");
}

$customer = $resultCustomer->fetch_assoc();
$customerID = $customer['CustomerID'];

// Get form data
$service = $_POST['service'];
$date = $_POST['date'];
$time = $_POST['time'];
$description = $_POST['description'];

// Temporary provider (we'll improve this later)
$providerID = $_POST['providerID'];

// Save booking
$sql = "INSERT INTO Bookings
(CustomerID, ProviderID, ServiceName, BookingDate, BookingTime, Description)
VALUES
('$customerID', '$providerID', '$service', '$date', '$time', '$description')";

if ($conn->query($sql) === TRUE) {

    header("Location: my_bookings.php");
    exit();

} else {

    echo "Error: " . $conn->error;

}
?>