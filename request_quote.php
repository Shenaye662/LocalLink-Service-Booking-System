<?php
session_start();
include "../includes/config.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION["user_id"];

// Get provider ID from the URL
$providerID = intval($_GET["provider_id"] ?? 0);

if ($providerID <= 0) {
    die("Invalid provider.");
}

// Find the logged-in customer's CustomerID
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


// Check that provider exists
$stmt = $conn->prepare(
    "SELECT BusinessName
     FROM Providers
     WHERE ProviderID = ?"
);

$stmt->bind_param("i", $providerID);
$stmt->execute();

$providerResult = $stmt->get_result();

if ($providerResult->num_rows === 0) {
    die("Provider not found.");
}

$provider = $providerResult->fetch_assoc();
$businessName = $provider["BusinessName"];

$stmt->close();

$success = "";
$error = "";
$description = "";

// Process quote request
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $description = trim($_POST["description"] ?? "");

    if (empty($description)) {

        $error = "Please describe the work you need.";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO Quotes
            (CustomerID, ProviderID, Description, Status)
            VALUES (?, ?, ?, 'Pending')"
        );

        $stmt->bind_param(
            "iis",
            $customerID,
            $providerID,
            $description
        );

        if ($stmt->execute()) {

            $success = "Your quote request was sent successfully!";
            $description = "";

        } else {

            $error = "Unable to send quote request. Please try again.";

        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Request Quote - LocalLink</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-primary">

    <div class="container">

        <a class="navbar-brand fw-bold" href="../index.php">
            LocalLink
        </a>

        <!-- FIXED -->
        <a href="../search.php" class="btn btn-light">
            Back to Services
        </a>

    </div>

</nav>

<!-- QUOTE FORM -->
<div class="container py-5">

    <div class="card shadow-sm mx-auto" style="max-width:650px;">

        <div class="card-body p-4">

            <h2 class="mb-2">
                Request a Quote
            </h2>

            <p class="text-muted mb-4">

                Requesting a quote from

                <strong>
                    <?php echo htmlspecialchars($businessName); ?>
                </strong>

            </p>

            <?php if (!empty($success)): ?>

                <div class="alert alert-success">
                    <?php echo htmlspecialchars($success); ?>
                </div>

            <?php endif; ?>

            <?php if (!empty($error)): ?>

                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($error); ?>
                </div>

            <?php endif; ?>

            <form method="POST">

                <div class="mb-4">

                    <label class="form-label fw-bold">
                        Describe the work you need
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="6"
                        placeholder="Example: I need two electrical plugs repaired..."
                        required><?php echo htmlspecialchars($description); ?></textarea>

                </div>

                <button type="submit"
                        class="btn btn-success">

                    Send Quote Request

                </button>

                <!-- FIXED -->
                <a href="../search.php"
                   class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>