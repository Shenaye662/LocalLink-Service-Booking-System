<?php
session_start();
include "includes/config.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM Users WHERE Email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['Password'])) {

        // Regenerate session ID for security
        session_regenerate_id(true);

        // Save session data
        $_SESSION['user_id'] = $user['UserID'];
        $_SESSION['name'] = $user['FirstName'];
        $_SESSION['role'] = $user['AccountType'];

        // Redirect based on account type
        if ($user['AccountType'] == "Customer") {
            header("Location: customer/customer_dashboard.php");
        } elseif ($user['AccountType'] == "Service Provider") {
            header("Location: provider/provider_dashboard.php");
        } elseif ($user['AccountType'] == "Admin") {
            header("Location: admin/admin_dashboard.php");
        } else {
            echo "Unknown account type.";
        }

        exit();

    } else {
        echo "Wrong password!";
    }

} else {
    echo "User not found!";
}
?>