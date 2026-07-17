<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['provider'])) {
    die("Provider not found.");
}

$providerID = (int)$_GET['provider'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2>Book a Service</h2>

<form action="submit_booking.php" method="POST">

<input type="hidden" name="providerID"
value="<?php echo $providerID; ?>">

<div class="mb-3">
<label>Service Name</label>
<input type="text" name="service" class="form-control" required>
</div>

<div class="mb-3">
<label>Date</label>
<input type="date" name="date" class="form-control" required>
</div>

<div class="mb-3">
<label>Time</label>
<input type="time" name="time" class="form-control" required>
</div>

<div class="mb-3">
<label>Description</label>
<textarea name="description" class="form-control"></textarea>
</div>

<button class="btn btn-success">
Book Now
</button>

</form>

</div>

</div>

</div>

</body>
</html>