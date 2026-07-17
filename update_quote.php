<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $quoteID = intval($_POST["quote_id"] ?? 0);
    $action = $_POST["action"] ?? "";

    // Only allow these two actions
    if ($action !== "Accepted" && $action !== "Declined") {
        die("Invalid action.");
    }

    // Get the logged-in customer's CustomerID
    $stmt = $conn->prepare(
        "SELECT CustomerID
         FROM Customers
         WHERE UserID = ?"
    );

    $stmt->bind_param("i", $userID);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Customer profile not found.");
    }

    $customer = $result->fetch_assoc();
    $customerID = $customer["CustomerID"];

    $stmt->close();

    // Update the quote
    $stmt = $conn->prepare(
        "UPDATE Quotes
         SET Status = ?
         WHERE QuoteID = ?
         AND CustomerID = ?"
    );

    $stmt->bind_param(
        "sii",
        $action,
        $quoteID,
        $customerID
    );

    $stmt->execute();
    $stmt->close();
}

header("Location: my_quotes.php");
exit();
?>