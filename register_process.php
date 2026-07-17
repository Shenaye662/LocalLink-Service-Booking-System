<?php

include "includes/config.php";

// Get form data
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$province = $_POST['province'];
$accountType = $_POST['accountType'];

// Check if email already exists
$check = "SELECT * FROM Users WHERE Email='$email'";
$result = $conn->query($check);

if ($result->num_rows > 0) {
    die("Email already registered!");
}

// Insert into Users table
$sql = "INSERT INTO Users
(FirstName, LastName, Email, Phone, Password, Province, AccountType)
VALUES
('$firstName', '$lastName', '$email', '$phone', '$password', '$province', '$accountType')";

if ($conn->query($sql) === TRUE) {

    // Get the newly created UserID
    $userID = $conn->insert_id;

    // If Customer, create customer profile
    if ($accountType == "Customer") {

        $sqlCustomer = "INSERT INTO Customers (UserID, Address, City)
                        VALUES ('$userID', '', '$province')";

        $conn->query($sqlCustomer);
    }

    // If Service Provider, create provider profile
    if ($accountType == "Service Provider") {

        $sqlProvider = "INSERT INTO Providers
        (UserID, BusinessName, Description, Experience)
        VALUES
        ('$userID', '$firstName $lastName', '', 0)";

        $conn->query($sqlProvider);
    }

    echo "<h2>Account created successfully!</h2>";
    echo "<a href='login.php'>Go to Login</a>";

} else {

    echo "Error: " . $conn->error;

}
?>