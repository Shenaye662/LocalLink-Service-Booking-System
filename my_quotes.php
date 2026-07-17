<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION["user_id"];

// Find customer
$stmt = $conn->prepare(
    "SELECT CustomerID FROM Customers WHERE UserID = ?"
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


// Get customer's quotes
$stmt = $conn->prepare(
    "SELECT
        Quotes.QuoteID,
        Quotes.Description,
        Quotes.Price,
        Quotes.ProviderMessage,
        Quotes.Status,
        Quotes.CreatedAt,
        Providers.BusinessName
    FROM Quotes
    JOIN Providers
        ON Quotes.ProviderID = Providers.ProviderID
    WHERE Quotes.CustomerID = ?
    ORDER BY Quotes.CreatedAt DESC"
);

$stmt->bind_param("i", $customerID);
$stmt->execute();

$quotes = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Quotes - LocalLink</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-dark bg-primary">
    <div class="container">

        <a class="navbar-brand fw-bold"
           href="customer_dashboard.php">
            LocalLink
        </a>

        <a href="customer_dashboard.php"
           class="btn btn-light">
            Dashboard
        </a>

    </div>
</nav>


<div class="container py-5">

    <h1 class="mb-4">My Quotes</h1>


    <?php if ($quotes->num_rows > 0): ?>

        <?php while ($quote = $quotes->fetch_assoc()): ?>

            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <h4>
                        <?php echo htmlspecialchars($quote["BusinessName"]); ?>
                    </h4>


                    <p>
                        <strong>Your Request:</strong><br>

                        <?php
                        echo nl2br(
                            htmlspecialchars($quote["Description"])
                        );
                        ?>
                    </p>


                    <p>
                        <strong>Status:</strong>

                        <?php echo htmlspecialchars($quote["Status"]); ?>
                    </p>


                   <?php if (!empty($quote["Price"]) && $quote["Status"] !== "Accepted" && $quote["Status"] !== "Declined"): ?>

                        <p>
                            <strong>Quoted Price:</strong>

                            R<?php
                            echo number_format(
                                (float)$quote["Price"],
                                2
                            );
                            ?>
                        </p>


                        <p>
                            <strong>Provider Message:</strong><br>

                            <?php
                            echo htmlspecialchars(
                                $quote["ProviderMessage"] ?? ""
                            );
                            ?>
                        </p>


                        <form
                            method="POST"
                            action="update_quote.php"
                            class="d-inline">

                            <input
                                type="hidden"
                                name="quote_id"
                                value="<?php echo $quote["QuoteID"]; ?>">

                            <input
                                type="hidden"
                                name="action"
                                value="Accepted">

                            <button
                                type="submit"
                                class="btn btn-success">
                                Accept Quote
                            </button>

                        </form>


                        <form method="POST" action="update_quote.php" class="d-inline">

    <input
        type="hidden"
        name="quote_id"
        value="<?php echo $quote["QuoteID"]; ?>">

    <input
        type="hidden"
        name="action"
        value="Declined">

    <button type="submit" class="btn btn-danger">
        Decline Quote
    </button>

</form>

                    <?php elseif ($quote["Status"] === "Pending"): ?>

                        <div class="alert alert-warning">
                            Waiting for the provider to respond.
                        </div>

                    <?php else: ?>

                        <div class="alert alert-info">
                            Quote <?php echo htmlspecialchars($quote["Status"]); ?>
                        </div>

                    <?php endif; ?>

                </div>

            </div>

        <?php endwhile; ?>

    <?php else: ?>

        <div class="alert alert-info">
            You have not requested any quotes yet.
        </div>

    <?php endif; ?>

</div>

</body>
</html>