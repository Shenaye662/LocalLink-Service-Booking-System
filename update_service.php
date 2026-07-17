<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$serviceID = $_POST['serviceID'];
$serviceName = $_POST['serviceName'];
$description = $_POST['description'];
$price = $_POST['price'];

$sql = "UPDATE Services
SET
ServiceName='$serviceName',
Description='$description',
Price='$price'
WHERE ServiceID='$serviceID'";

if($conn->query($sql)){

    header("Location: my_services.php");

}else{

    echo $conn->error;

}
?>