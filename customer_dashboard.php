<?php
session_start();

// If user is not logged in, send to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <a class="navbar-brand fw-bold" href="customer_dashboard.php">
            LocalLink Dashboard
        </a>

        <div class="ms-auto">

            <a href="../search.php" class="btn btn-light me-2">
                Find a Service
            </a>

            <a href="my_bookings.php" class="btn btn-success me-2">
                My Bookings
            </a>

            <!-- NEW MY QUOTES BUTTON -->
            <a href="my_quotes.php" class="btn btn-info me-2">
                My Quotes
            </a>

            <a href="../logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>
</nav>

<div class="container mt-5">

    <h2>
        Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?> 👋
    </h2>

    <p class="text-muted">
        Search for trusted local service providers and manage your bookings and quotes.
    </p>

    <div class="row mt-4 g-4">

        <!-- FIND A SERVICE -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body">

                    <h5 class="card-title">Find a Service</h5>

                    <p class="card-text">
                        Search for providers by category and book a service.
                    </p>

                    <a href="../search.php" class="btn btn-primary">
                        Search Providers
                    </a>

                </div>
            </div>
        </div>


        <!-- MY BOOKINGS -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body">

                    <h5 class="card-title">My Bookings</h5>

                    <p class="card-text">
                        View and manage your existing bookings.
                    </p>

                    <a href="my_bookings.php" class="btn btn-success">
                        View Bookings
                    </a>

                </div>
            </div>
        </div>


        <!-- MY QUOTES -->
        <div class="col-md-4">
            <div class="card shadow h-100">
                <div class="card-body">

                    <h5 class="card-title">My Quotes</h5>

                    <p class="card-text">
                        View quote requests and accept or decline provider quotes.
                    </p>

                    <a href="my_quotes.php" class="btn btn-info">
                        View Quotes
                    </a>

                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>