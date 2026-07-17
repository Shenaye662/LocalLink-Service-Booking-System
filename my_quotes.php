<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION["user_id"];

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


// Get quote requests for this provider
$stmt = $conn->prepare(
    "SELECT
        Quotes.QuoteID,
        Quotes.Description,
        Quotes.Price,
        Quotes.ProviderMessage,
        Quotes.Status,
        Quotes.CreatedAt,
        Users.FirstName,
        Users.LastName
    FROM Quotes
    JOIN Customers
        ON Quotes.CustomerID = Customers.CustomerID
    JOIN Users
        ON Customers.UserID = Users.UserID
    WHERE Quotes.ProviderID = ?
    ORDER BY Quotes.CreatedAt DESC"
);

$stmt->bind_param("i", $providerID);
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
           href="provider_dashboard.php">
            LocalLink Provider
        </a>

        <a href="provider_dashboard.php"
           class="btn btn-light">
            Dashboard
        </a>

    </div>
</nav>


<div class="container py-5">

    <h1 class="mb-4">Quote Requests</h1>


    <?php if ($quotes->num_rows > 0): ?>

        <?php while ($quote = $quotes->fetch_assoc()): ?>

            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <h5>
                        Customer:
                        <?php
                        echo htmlspecialchars(
                            $quote["FirstName"] . " " .
                            $quote["LastName"]
                        );
                        ?>
                    </h5>


                    <p>
                        <strong>Job Description:</strong>
                        <br>

                        <?php
                        echo nl2br(
                            htmlspecialchars($quote["Description"])
                        );
                        ?>
                    </p>


                    <p>
                        <strong>Status:</strong>

                        <span class="badge bg-secondary">
                            <?php
                            echo htmlspecialchars($quote["Status"]);
                            ?>
                        </span>
                    </p>


                    <?php if ($quote["Status"] === "Pending"): ?>

                        <form
                            method="POST"
                            action="respond_quote.php">

                            <input
                                type="hidden"
                                name="quote_id"
                                value="<?php echo $quote["QuoteID"]; ?>">


                            <div class="mb-3">

                                <label class="form-label">
                                    Quote Price (R)
                                </label>

                                <input
                                    type="number"
                                    name="price"
                                    class="form-control"
                                    step="0.01"
                                    min="0.01"
                                    required>

                            </div>


                            <div class="mb-3">

                                <label class="form-label">
                                    Message to Customer
                                </label>

                                <textarea
                                    name="provider_message"
                                    class="form-control"
                                    rows="3"
                                    placeholder="Example: This price includes labour and materials."
                                    required></textarea>

                            </div>


                            <button
                                type="submit"
                                class="btn btn-success">
                                Send Quote
                            </button>

                        </form>


                    <?php else: ?>

                        <p>
                            <strong>Price:</strong>

                            R<?php
                            echo number_format(
                                (float)$quote["Price"],
                                2
                            );
                            ?>
                        </p>


                        <p>
                            <strong>Your Message:</strong>
                            <br>

                            <?php
                            echo htmlspecialchars(
                                $quote["ProviderMessage"] ?? ""
                            );
                            ?>
                        </p>

                    <?php endif; ?>

                </div>

            </div>

        <?php endwhile; ?>


    <?php else: ?>

        <div class="alert alert-info">
            You currently have no quote requests.
        </div>

    <?php endif; ?>

</div>

</body>
</html>