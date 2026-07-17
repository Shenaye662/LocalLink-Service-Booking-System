<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if (!isset($_GET['id'])) {
    die("Service not found.");
}

$serviceID = (int)$_GET['id'];

$sql = "SELECT * FROM Services WHERE ServiceID = $serviceID";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Service not found.");
}

$service = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="card shadow">

<div class="card-body">

<h2>Edit Service</h2>

<form action="update_service.php" method="POST">

<input type="hidden" name="serviceID"
value="<?php echo $service['ServiceID']; ?>">

<div class="mb-3">
<label>Service Name</label>

<input
type="text"
name="serviceName"
class="form-control"
value="<?php echo $service['ServiceName']; ?>"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
rows="4"><?php echo $service['Description']; ?></textarea>

</div>

<div class="mb-3">

<label>Price</label>

<input
type="number"
name="price"
class="form-control"
value="<?php echo $service['Price']; ?>"
required>

</div>

<button class="btn btn-primary">
Update Service
</button>

<a href="my_services.php" class="btn btn-secondary">
Cancel
</a>

</form>

</div>

</div>

</div>

</body>
</html>