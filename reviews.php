<?php
session_start();

include "../includes/config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$userID = $_SESSION['user_id'];


// Find provider ID
$stmt = $conn->prepare(
    "SELECT ProviderID 
     FROM Providers 
     WHERE UserID = ?"
);

$stmt->bind_param("i", $userID);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Provider profile not found.");
}

$provider = $result->fetch_assoc();

$providerID = $provider['ProviderID'];

$stmt->close();


// Get reviews
$stmt = $conn->prepare(
    "SELECT 
        Reviews.Rating,
        Reviews.Comment,
        Reviews.ReviewDate,
        Users.FirstName,
        Users.LastName
     
     FROM Reviews

     JOIN Customers
     ON Reviews.CustomerID = Customers.CustomerID

     JOIN Users
     ON Customers.UserID = Users.UserID

     WHERE Reviews.ProviderID = ?

     ORDER BY Reviews.ReviewDate DESC"
);


$stmt->bind_param("i", $providerID);

$stmt->execute();

$reviews = $stmt->get_result();

?>

<!DOCTYPE html>
<html>

<head>

<title>Customer Reviews</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>


<body class="bg-light">


<div class="container py-5">


<h2 class="mb-4">
    Customer Reviews
</h2>


<?php if ($reviews->num_rows > 0): ?>


<?php while($review = $reviews->fetch_assoc()): ?>


<div class="card mb-3 shadow">

<div class="card-body">


<h5>
<?php echo htmlspecialchars(
$review['FirstName']." ".$review['LastName']
); ?>
</h5>


<p>

<?php

echo str_repeat(
"⭐",
intval($review['Rating'])
);

?>

<strong>
<?php echo $review['Rating']; ?>/5
</strong>

</p>


<p>
<?php echo nl2br(
htmlspecialchars($review['Comment'])
); ?>
</p>


<small class="text-muted">

<?php echo $review['ReviewDate']; ?>

</small>


</div>

</div>


<?php endwhile; ?>


<?php else: ?>


<div class="alert alert-info">

No reviews yet.

</div>


<?php endif; ?>


<a href="provider_dashboard.php" class="btn btn-secondary">

Back to Dashboard

</a>


</div>


</body>

</html>