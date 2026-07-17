<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2>Add New Service</h2>

<form action="save_service.php" method="POST">

    <div class="mb-3">
        <label class="form-label">Service Name</label>
        <input type="text" name="serviceName" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Category</label>

        <select name="categoryID" class="form-select" required>

        <?php

        $categories = $conn->query("SELECT * FROM Categories");

        while($row = $categories->fetch_assoc()){

            echo "<option value='".$row['CategoryID']."'>".$row['CategoryName']."</option>";

        }

        ?>

        </select>

    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="4"></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Price (R)</label>
        <input type="number" name="price" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary">
        Save Service
    </button>

    <a href="provider_dashboard.php" class="btn btn-secondary">
        Back to Dashboard
    </a>

</form>

</div>

</div>

</div>

</body>
</html>