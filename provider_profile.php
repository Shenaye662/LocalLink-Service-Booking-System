<?php
include "includes/config.php";

// Get Provider ID from URL
$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    die("Invalid provider.");
}


// ==========================================
// GET PROVIDVIDER INFORMATION
// ==========================================

$stmt = $conn->prepare(
    "SELECT *
     FROM Providers
     WHERE ProviderID = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Provider not found.");
}

$provider = $result->fetch_assoc();

$stmt->close();


// ==========================================
// GET AVERAGE RATING AND TOTAL REVIEWS
// ==========================================

$stmt = $conn->prepare(
    "SELECT
        AVG(Rating) AS AverageRating,
        COUNT(ReviewID) AS TotalReviews
     FROM Reviews
     WHERE ProviderID = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();

$ratingResult = $stmt->get_result();
$ratingData = $ratingResult->fetch_assoc();

$averageRating = !empty($ratingData['AverageRating'])
    ? round($ratingData['AverageRating'], 1)
    : 0;

$totalReviews = $ratingData['TotalReviews'] ?? 0;

$stmt->close();


// ==========================================
// GET CUSTOMER REVIEWS
// ==========================================

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

$stmt->bind_param("i", $id);
$stmt->execute();

$reviews = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Provider Profile - LocalLink</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>


<body class="bg-light">


<div class="container py-5">


    <!-- ==========================================
         PROVIDER INFORMATION
    =========================================== -->

    <div class="card shadow mb-4">

        <div class="card-body p-4">


            <h2 class="mb-3">

                <?php
                echo htmlspecialchars(
                    $provider['BusinessName']
                );
                ?>

            </h2>


            <!-- RATING -->

            <div class="mb-3">

                <span class="fs-5">

                    ⭐ <?php echo $averageRating; ?>/5

                </span>

                <span class="text-muted">

                    (<?php echo $totalReviews; ?> reviews)

                </span>

            </div>


            <!-- EXPERIENCE -->

            <p>

                <strong>Experience:</strong>

                <?php
                echo htmlspecialchars(
                    $provider['Experience']
                );
                ?>

                Years

            </p>


            <!-- DESCRIPTION -->

            <p>

                <?php
                echo htmlspecialchars(
                    $provider['Description']
                );
                ?>

            </p>


            <!-- BOOK NOW BUTTON -->

            <a
                href="customer/book_service.php?provider=<?php echo $provider['ProviderID']; ?>"
                class="btn btn-primary">

                Book Now

            </a>


            <!-- REQUEST QUOTE BUTTON -->

            <a
                href="customer/request_quote.php?provider_id=<?php echo $provider['ProviderID']; ?>"
                class="btn btn-success">

                Request Quote

            </a>


        </div>

    </div>



    <!-- ==========================================
         CUSTOMER REVIEWS
    =========================================== -->

    <div class="card shadow">

        <div class="card-body p-4">


            <h3 class="mb-4">

                Customer Reviews

            </h3>


            <?php if ($reviews->num_rows > 0): ?>


                <?php while ($review = $reviews->fetch_assoc()): ?>


                    <div class="border-bottom pb-3 mb-3">


                        <!-- CUSTOMER NAME -->

                        <h5>

                            <?php
                            echo htmlspecialchars(
                                $review['FirstName']
                                . " "
                                . $review['LastName']
                            );
                            ?>

                        </h5>


                        <!-- RATING -->

                        <p class="mb-1">

                            <?php
                            echo str_repeat(
                                "⭐",
                                intval($review['Rating'])
                            );
                            ?>

                            <strong>

                                <?php
                                echo htmlspecialchars(
                                    $review['Rating']
                                );
                                ?>/5

                            </strong>

                        </p>


                        <!-- REVIEW COMMENT -->

                        <p>

                            <?php
                            echo nl2br(
                                htmlspecialchars(
                                    $review['Comment']
                                )
                            );
                            ?>

                        </p>


                        <!-- REVIEW DATE -->

                        <small class="text-muted">

                            <?php
                            echo htmlspecialchars(
                                $review['ReviewDate']
                            );
                            ?>

                        </small>


                    </div>


                <?php endwhile; ?>


            <?php else: ?>


                <div class="alert alert-info">

                    This provider has no reviews yet.

                </div>


            <?php endif; ?>


        </div>

    </div>



    <!-- ==========================================
         BACK TO SERVICES
    =========================================== -->

<button type="button"
        class="btn btn-secondary mt-4"
        onclick="window.location.replace('http://localhost/LocalLink/search.php')">
    Back to Services
</button>

</div>


</body>

</html>