<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION["user_id"];
$bookingID = intval($_GET["booking_id"] ?? 0);

if ($bookingID <= 0) {
    die("Invalid booking.");
}

// Get CustomerID
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


// Get booking and provider
$stmt = $conn->prepare(
    "SELECT
        Bookings.BookingID,
        Bookings.ProviderID,
        Providers.BusinessName
     FROM Bookings
     JOIN Providers
        ON Bookings.ProviderID = Providers.ProviderID
     WHERE Bookings.BookingID = ?
     AND Bookings.CustomerID = ?"
);

$stmt->bind_param("ii", $bookingID, $customerID);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Booking not found.");
}

$booking = $result->fetch_assoc();

$providerID = $booking["ProviderID"];
$businessName = $booking["BusinessName"];

$stmt->close();

$message = "";


// Submit review
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $rating = intval($_POST["rating"] ?? 0);
    $comment = trim($_POST["comment"] ?? "");

    if ($rating < 1 || $rating > 5) {

        $message = "Please select a rating from 1 to 5.";

    } elseif (empty($comment)) {

        $message = "Please enter a comment.";

    } else {

        $stmt = $conn->prepare(
            "INSERT INTO Reviews
            (BookingID, CustomerID, ProviderID, Rating, Comment, ReviewDate)
            VALUES (?, ?, ?, ?, ?, NOW())"
        );

        $stmt->bind_param(
            "iiiis",
            $bookingID,
            $customerID,
            $providerID,
            $rating,
            $comment
        );

        if ($stmt->execute()) {

            // Go back to bookings with success message
            header("Location: my_bookings.php?review=success");
            exit();

        } else {

            $message = "Unable to submit review.";

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

    <title>Leave Review - LocalLink</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

    <div class="card shadow mx-auto"
         style="max-width: 600px;">

        <div class="card-body p-4">

            <h2>Leave a Review</h2>

            <p class="text-muted">

                Review

                <strong>
                    <?php echo htmlspecialchars($businessName); ?>
                </strong>

            </p>


            <?php if (!empty($message)): ?>

                <div class="alert alert-danger">

                    <?php echo htmlspecialchars($message); ?>

                </div>

            <?php endif; ?>


            <form method="POST">

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Rating
                    </label>

                    <select
                        name="rating"
                        class="form-select"
                        required>

                        <option value="">
                            Select a rating
                        </option>

                        <option value="5">
                            ⭐⭐⭐⭐⭐ - Excellent
                        </option>

                        <option value="4">
                            ⭐⭐⭐⭐ - Very Good
                        </option>

                        <option value="3">
                            ⭐⭐⭐ - Good
                        </option>

                        <option value="2">
                            ⭐⭐ - Fair
                        </option>

                        <option value="1">
                            ⭐ - Poor
                        </option>

                    </select>

                </div>


                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Comment
                    </label>

                    <textarea
                        name="comment"
                        class="form-control"
                        rows="5"
                        placeholder="Tell us about your experience..."
                        required></textarea>

                </div>


                <button
                    type="submit"
                    class="btn btn-success">

                    Submit Review

                </button>


                <a
                    href="my_bookings.php"
                    class="btn btn-secondary">

                    Cancel

                </a>

            </form>

        </div>

    </div>

</div>

</body>

</html>