<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['user_id'];


// Get CustomerID
$stmt = $conn->prepare(
    "SELECT CustomerID
     FROM Customers
     WHERE UserID = ?"
);

$stmt->bind_param("i", $userID);
$stmt->execute();

$customerResult = $stmt->get_result();

if ($customerResult->num_rows == 0) {
    die("Customer not found.");
}

$customer = $customerResult->fetch_assoc();
$customerID = $customer['CustomerID'];

$stmt->close();


// Get bookings
$stmt = $conn->prepare(
    "SELECT *
     FROM Bookings
     WHERE CustomerID = ?
     ORDER BY BookingDate DESC, BookingTime DESC"
);

$stmt->bind_param("i", $customerID);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>My Bookings - LocalLink</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <h2 class="mb-4">
        My Bookings
    </h2>


    <!-- REVIEW SUCCESS MESSAGE -->

    <?php
    if (isset($_GET['review']) &&
        $_GET['review'] === 'success') {
    ?>

        <div class="alert alert-success">

            ✅ Your review was submitted successfully!

        </div>

    <?php
    }
    ?>


    <div class="table-responsive">

        <table class="table table-bordered table-striped">

            <thead class="table-dark">

                <tr>

                    <th>Service</th>

                    <th>Date</th>

                    <th>Time</th>

                    <th>Description</th>

                    <th>Status</th>

                    <th>Review</th>

                </tr>

            </thead>


            <tbody>


            <?php if ($result->num_rows > 0): ?>


                <?php while ($row = $result->fetch_assoc()): ?>


                    <tr>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['ServiceName']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['BookingDate']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['BookingTime']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['Description']
                            );
                            ?>

                        </td>


                        <td>

                            <?php
                            echo htmlspecialchars(
                                $row['Status']
                            );
                            ?>

                        </td>


                        <td>

                            <a
                                href="leave_review.php?booking_id=<?php echo $row['BookingID']; ?>"
                                class="btn btn-warning btn-sm">

                                ⭐ Leave Review

                            </a>

                        </td>


                    </tr>


                <?php endwhile; ?>


            <?php else: ?>


                <tr>

                    <td
                        colspan="6"
                        class="text-center">

                        No bookings found.

                    </td>

                </tr>


            <?php endif; ?>


            </tbody>

        </table>

    </div>


    <a
        href="customer_dashboard.php"
        class="btn btn-secondary">

        Back to Dashboard

    </a>

</div>

</body>

</html>