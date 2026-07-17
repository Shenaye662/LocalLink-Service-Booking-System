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
    $price = floatval($_POST["price"] ?? 0);
    $providerMessage = trim($_POST["provider_message"] ?? "");

    // Find logged-in provider
    $stmt = $conn->prepare(
        "SELECT ProviderID FROM Providers WHERE UserID = ?"
    );

    $stmt->bind_param("i", $userID);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        die("Provider profile not found.");
    }

    $provider = $result->fetch_assoc();
    $providerID = $provider["ProviderID"];

    $stmt->close();

    // Update only a quote belonging to this provider
    $stmt = $conn->prepare(
        "UPDATE Quotes
         SET Price = ?,
             ProviderMessage = ?,
             Status = 'Responded'
         WHERE QuoteID = ?
         AND ProviderID = ?"
    );

    $stmt->bind_param(
        "dsii",
        $price,
        $providerMessage,
        $quoteID,
        $providerID
    );

    $stmt->execute();
    $stmt->close();
}

header("Location: my_quotes.php");
exit();
?>