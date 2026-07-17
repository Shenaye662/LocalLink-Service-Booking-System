<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['user_id'];

$stmt = $conn->prepare(
    "SELECT * FROM Providers WHERE UserID = ?"
);

$stmt->bind_param("i", $userID);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Provider profile not found.");
}

$provider = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Provider Dashboard - LocalLink</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>

        .dashboard-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: nowrap;
            align-items: center;
        }

        .dashboard-buttons .btn {
            white-space: nowrap;
            padding: 10px 14px;
        }

        /* Unique View Reviews colour */
        .reviews-btn {
            background-color: #6f42c1;
            color: white;
            border: none;
        }

        .reviews-btn:hover {
            background-color: #59339d;
            color: white;
        }

    </style>

</head>


<body class="bg-light">


<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body p-4">


            <h2>
                Welcome,
                <?php echo htmlspecialchars($provider['BusinessName']); ?>
            </h2>


            <hr>


            <p>
                <strong>Description:</strong>
                <?php echo htmlspecialchars($provider['Description']); ?>
            </p>


            <p>
                <strong>Experience:</strong>
                <?php echo htmlspecialchars($provider['Experience']); ?> Years
            </p>


            <p>
                <strong>Rating:</strong>
                ⭐ <?php echo htmlspecialchars($provider['Rating']); ?>/5
            </p>


            <hr>


            <div class="dashboard-buttons">


                <a href="add_service.php"
                   class="btn btn-primary">
                    Add Service
                </a>


                <a href="my_services.php"
                   class="btn btn-success">
                    My Services
                </a>


                <a href="view_bookings.php"
                   class="btn btn-warning">
                    View Bookings
                </a>


                <a href="reviews.php"
                   class="btn reviews-btn">
                    View Reviews
                </a>


                <a href="my_quotes.php"
                   class="btn btn-secondary">
                    My Quotes
                </a>


                <a href="../logout.php"
                   class="btn btn-danger">
                    Logout
                </a>


            </div>


        </div>

    </div>

</div>


</body>
</html>