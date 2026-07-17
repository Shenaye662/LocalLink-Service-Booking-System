<?php
session_start();
include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['user_id'];

// Get logged-in provider
$sql = "SELECT ProviderID FROM Providers WHERE UserID='$userID'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Provider not found.");
}

$provider = $result->fetch_assoc();
$providerID = $provider['ProviderID'];

// Get all bookings for this provider
$sql = "SELECT
Bookings.*,
Users.FirstName,
Users.LastName

FROM Bookings

INNER JOIN Customers
ON Bookings.CustomerID = Customers.CustomerID

INNER JOIN Users
ON Customers.UserID = Users.UserID

WHERE Bookings.ProviderID='$providerID'

ORDER BY BookingDate DESC, BookingTime DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<h2>My Bookings</h2>

<table class="table table-bordered table-striped">

<tr>
    <th>Customer</th>
    <th>Service</th>
    <th>Date</th>
    <th>Time</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()){ ?>

<tr>

<td>
<?php echo $row['FirstName']." ".$row['LastName']; ?>
</td>

<td>
<?php echo $row['ServiceName']; ?>
</td>

<td>
<?php echo $row['BookingDate']; ?>
</td>

<td>
<?php echo $row['BookingTime']; ?>
</td>

<td>
<?php echo $row['Status']; ?>
</td>

<td>

<?php if($row['Status']=="Pending"){ ?>

<a href="accept_booking.php?id=<?php echo $row['BookingID']; ?>"
class="btn btn-success btn-sm">

Accept

</a>

<a href="decline_booking.php?id=<?php echo $row['BookingID']; ?>"
class="btn btn-danger btn-sm">

Decline

</a>

<?php }else{ ?>

-

<?php } ?>

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