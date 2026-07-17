<?php
include "includes/config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Find a Service - LocalLink</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<link href="css/style.css" rel="stylesheet">

<style>

body{
    background:#f4f7fb;
}

/* HERO */

.search-hero{

    background:linear-gradient(135deg,#0d6efd,#0a58ca);

    color:white;

    padding:60px 0;

    margin-bottom:40px;

}

.search-box{

    background:white;

    border-radius:20px;

    padding:30px;

    margin-top:-40px;

    box-shadow:0 10px 25px rgba(0,0,0,.12);

}

/* PROVIDER CARD */

.provider-card{

    border:none;

    border-radius:18px;

    overflow:hidden;

    transition:.3s;

    box-shadow:0 8px 18px rgba(0,0,0,.08);

}

.provider-card:hover{

    transform:translateY(-8px);

    box-shadow:0 15px 30px rgba(0,0,0,.15);

}

.provider-image{

    width:180px;

    height:180px;

    object-fit:cover;

    border-radius:15px;

}

.badge-verified{

    background:#198754;

    color:white;

    font-size:14px;

    padding:8px 12px;

    border-radius:20px;

}

.rating{

    color:#ffc107;

    font-weight:bold;

    font-size:18px;

}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            <i class="fas fa-map-marker-alt"></i> LocalLink
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link px-3" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3" href="search.php">Services</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3" href="about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3" href="contact.php">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3" href="login.php">Login</a>
                </li>

                <li class="nav-item ms-3">
                    <a href="register.php" class="btn btn-success px-4">
                        Register
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>


<!-- HERO -->

<section class="search-hero">

<div class="container text-center">

<h1 class="display-5 fw-bold">

<i class="bi bi-search"></i>

Find Trusted Professionals

</h1>

<p class="lead">

Search verified providers near you.

</p>

</div>

</section>

<!-- SEARCH -->

<div class="container">

<div class="search-box">

<form method="GET" action="search.php">

<div class="row g-3 align-items-center">

<div class="col-md-9">

<select
name="service"
class="form-select form-select-lg"
required>

<option value="">

Choose a Service

</option>

<?php

$categories = $conn->query("SELECT * FROM Categories");

while($category = $categories->fetch_assoc()){

$selected="";

if(isset($_GET['service']) &&
$_GET['service']==$category['CategoryName']){

$selected="selected";

}

?>

<option
value="<?php echo $category['CategoryName'];?>"
<?php echo $selected;?>>

<?php echo $category['CategoryName'];?>

</option>

<?php
}
?>

</select>

</div>

<div class="col-md-3">

<button
class="btn btn-primary btn-lg w-100">

<i class="bi bi-search"></i>

Search

</button>

</div>

</div>

</form>

</div>

<br>
<?php

if(isset($_GET['service']) && $_GET['service'] != ""){

    $service = $_GET['service'];

    $sql = "

    SELECT DISTINCT

        Providers.ProviderID,
        Providers.BusinessName,
        Providers.Description,
        Providers.Experience,
        Providers.ProfileImage,
        Providers.Rating

    FROM Providers

    INNER JOIN Services
        ON Providers.ProviderID = Services.ProviderID

    INNER JOIN Categories
        ON Categories.CategoryID = Services.CategoryID

    WHERE Categories.CategoryName = ?

    ";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s",$service);

    $stmt->execute();

    $result = $stmt->get_result();

    echo '<div class="mt-5">';

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

?>

<div class="card provider-card mb-4">

    <div class="card-body p-4">

        <div class="row align-items-center">

            <div class="col-lg-3 text-center">

                <?php

                if(!empty($row['ProfileImage'])){

                ?>

                <img
                    src="uploads/<?php echo $row['ProfileImage'];?>"
                    class="provider-image">

                <?php

                }else{

                ?>

                <img
                    src="https://via.placeholder.com/180x180?text=Provider"
                    class="provider-image">

                <?php } ?>

            </div>


            <div class="col-lg-6">

                <div class="d-flex justify-content-between align-items-center mb-2">

                    <h3 class="fw-bold mb-0">

                        <?php echo htmlspecialchars($row['BusinessName']); ?>

                    </h3>

                    <span class="badge-verified">

                        ✔ Verified

                    </span>

                </div>


                <div class="rating mb-3">

                    ⭐ <?php echo $row['Rating']; ?>/5

                </div>


                <p class="text-muted">

                    <?php echo htmlspecialchars($row['Description']); ?>

                </p>


                <div class="row mt-4">

                    <div class="col-md-6">

                        <p>

                            <i class="bi bi-tools text-primary"></i>

                            <strong>Experience:</strong>

                            <?php echo $row['Experience']; ?> Years

                        </p>

                    </div>

                    <div class="col-md-6">

                        <p>

                            <i class="bi bi-shield-check text-success"></i>

                            Trusted Local Provider

                        </p>

                    </div>

                </div>

            </div>


            <div class="col-lg-3 text-center">

                <a
                    href="provider_profile.php?id=<?php echo $row['ProviderID'];?>"
                    class="btn btn-primary btn-lg w-100 mb-3">

                    <i class="bi bi-person-circle"></i>

                    View Profile

                </a>

                <div class="text-muted">

                    Available for Bookings

                </div>

            </div>

        </div>

    </div>

</div>

<?php

        }

    }else{

?>

<div class="alert alert-warning text-center shadow-sm p-4">

    <h4>

        <i class="bi bi-exclamation-circle"></i>

        No Providers Found

    </h4>

    <p>

        We couldn't find any providers offering this service.

    </p>

</div>

<?php

    }

    echo "</div>";

}

?>
<!-- BACK BUTTON -->
<div class="text-center mt-5 mb-4">

    <a href="index.php" class="btn btn-outline-primary btn-lg">

        <i class="bi bi-house-door-fill"></i>

        Back to Home

    </a>

</div>

</div> <!-- End Container -->


<!-- FOOTER -->

<footer class="bg-primary text-white mt-5">

    <div class="container py-5">

        <div class="row">

            <div class="col-md-4">

                <h4 class="fw-bold">

                    <i class="bi bi-geo-alt-fill"></i>

                    LocalLink

                </h4>

                <p>

                    Connecting communities with trusted local
                    service providers.

                </p>

            </div>


            <div class="col-md-4">

                <h5>

                    Quick Links

                </h5>

                <ul class="list-unstyled">

                    <li>

                        <a href="index.php"
                           class="text-white text-decoration-none">

                            Home

                        </a>

                    </li>

                    <li>

                        <a href="search.php"
                           class="text-white text-decoration-none">

                            Services

                        </a>

                    </li>

                    <li>

                        <a href="about.php"
                           class="text-white text-decoration-none">

                            About

                        </a>

                    </li>

                    <li>

                        <a href="contact.php"
                           class="text-white text-decoration-none">

                            Contact

                        </a>

                    </li>

                </ul>

            </div>


            <div class="col-md-4">

                <h5>

                    Why Choose LocalLink?

                </h5>

                <p>

                    ✔ Verified Providers<br>

                    ✔ Easy Booking<br>

                    ✔ Request Quotes<br>

                    ✔ Customer Reviews

                </p>

            </div>

        </div>

        <hr class="border-light">

        <div class="text-center">

            © 2026 LocalLink | Find. Book. Connect.

        </div>

    </div>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
