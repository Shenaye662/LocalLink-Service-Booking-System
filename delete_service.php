<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Service not found.");
}

$serviceID = (int)$_GET['id'];

// Make sure the logged-in provider owns this service
$userID = $_SESSION['user_id'];

$sql = "SELECT Providers.ProviderID
        FROM Providers
        WHERE Providers.UserID = '$userID'";

$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Provider not found.");
}

$provider = $result->fetch_assoc();
$providerID = $provider['ProviderID'];

// Delete only if it belongs to this provider
$sql = "DELETE FROM Services
        WHERE ServiceID = '$serviceID'
        AND ProviderID = '$providerID'";

if ($conn->query($sql)) {
    header("Location: my_services.php");
    exit();
} else {
    echo $conn->error;
}
?>