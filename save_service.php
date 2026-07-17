<?php
session_start();
include "../includes/config.php";

$userID = $_SESSION['user_id'];

// Find the logged-in provider
$sql = "SELECT ProviderID FROM Providers WHERE UserID='$userID'";
$result = $conn->query($sql);

if($result->num_rows == 0){
    die("Provider not found.");
}

$provider = $result->fetch_assoc();
$providerID = $provider['ProviderID'];

$serviceName = $_POST['serviceName'];
$categoryID = $_POST['categoryID'];
$description = $_POST['description'];
$price = $_POST['price'];

$sql = "INSERT INTO Services
(ProviderID, CategoryID, ServiceName, Description, Price)

VALUES

('$providerID','$categoryID','$serviceName','$description','$price')";

if($conn->query($sql)){

    echo "<h2>Service added successfully!</h2>";

    echo "<a href='provider_dashboard.php' class='btn btn-success mt-3'>
            Back to Dashboard
          </a>";

}else{

    echo $conn->error;

}
?>