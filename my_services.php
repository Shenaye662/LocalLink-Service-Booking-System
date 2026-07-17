<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['user_id'];

// Get ProviderID
$sql = "SELECT ProviderID FROM Providers WHERE UserID='$userID'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Provider not found.");
}

$provider = $result->fetch_assoc();
$providerID = $provider['ProviderID'];

// Get provider's services
$sql = "SELECT Services.*, Categories.CategoryName
        FROM Services
        INNER JOIN Categories
        ON Services.CategoryID = Categories.CategoryID
        WHERE Services.ProviderID='$providerID'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<h2>My Services</h2>

<a href="add_service.php" class="btn btn-success mb-3">
Add New Service
</a>

<table class="table table-bordered table-striped">

<tr>
    <th>Service</th>
    <th>Category</th>
    <th>Price</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()) { ?>

<tr>

<td><?php echo $row['ServiceName']; ?></td>

<td><?php echo $row['CategoryName']; ?></td>

<td>R<?php echo $row['Price']; ?></td>

<td>

<a href="edit_service.php?id=<?php echo $row['ServiceID']; ?>"
class="btn btn-warning btn-sm">
Edit
</a>

<a href="delete_service.php?id=<?php echo $row['ServiceID']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Delete this service?');">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

<a href="provider_dashboard.php" class="btn btn-secondary">
Back to Dashboard
</a>

</div>

</body>
</html>