<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - LocalLink</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Your CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- ================= NAVIGATION ================= -->

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

<section class="bg-primary text-white text-center py-5">

    <div class="container">

        <h1 class="display-4 fw-bold">
            About LocalLink
        </h1>

        <p class="lead">
            Connecting communities with trusted local service providers.
        </p>

    </div>

</section>

<!-- ABOUT -->

<section class="container py-5">

<div class="row align-items-center">

<div class="col-lg-6">

<h2 class="fw-bold mb-3">
Who We Are
</h2>

<p class="text-muted">

LocalLink is a community-focused platform designed to connect customers with trusted local service providers.

</p>

<p class="text-muted">

Whether you need a plumber, electrician, cleaner, mechanic, tutor or gardener, LocalLink helps you find reliable professionals quickly.

</p>

<p class="text-muted">

Our goal is to support local businesses while making it easy for customers to book quality services.

</p>

</div>

<div class="col-lg-6 text-center">

<i class="fas fa-people-group text-primary" style="font-size:150px;"></i>

</div>

</div>

</section>

<!-- MISSION -->

<section class="bg-light py-5">

<div class="container">

<div class="row g-4">

<div class="col-md-6">

<div class="card shadow border-0 h-100">

<div class="card-body text-center">

<i class="fas fa-bullseye text-primary fa-3x mb-3"></i>

<h3>Our Mission</h3>

<p class="text-muted">

To make finding trusted local services simple, safe and convenient.

</p>

</div>

</div>

</div>

<div class="col-md-6">

<div class="card shadow border-0 h-100">

<div class="card-body text-center">

<i class="fas fa-eye text-primary fa-3x mb-3"></i>

<h3>Our Vision</h3>

<p class="text-muted">

To build stronger communities by connecting customers with reliable local professionals.

</p>

</div>

</div>

</div>

</div>

</div>

</section>

<!-- HOW IT WORKS -->

<section class="container py-5">

<h2 class="text-center fw-bold mb-5">

How LocalLink Works

</h2>

<div class="row text-center">

<div class="col-md-4">

<i class="fas fa-search fa-3x text-primary mb-3"></i>

<h4>Find</h4>

<p>Search for trusted service providers.</p>

</div>

<div class="col-md-4">

<i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>

<h4>Book</h4>

<p>Choose a provider and make a booking.</p>

</div>

<div class="col-md-4">

<i class="fas fa-handshake fa-3x text-primary mb-3"></i>

<h4>Connect</h4>

<p>Enjoy reliable local services.</p>

</div>

</div>

</section>

<!-- CALL TO ACTION -->

<section class="bg-primary text-white text-center py-5">

<div class="container">

<h2 class="fw-bold">

Ready to get started?

</h2>

<p class="lead">

Find the right local service provider today.

</p>

<a href="search.php" class="btn btn-light btn-lg me-3">

Find a Service

</a>

<a href="register.php" class="btn btn-success btn-lg">

<i class="fas fa-user-plus"></i>

Join LocalLink

</a>

</div>

</section>

<!-- FOOTER -->

<footer class="bg-dark text-white text-center py-4">

<p class="mb-0">

© 2026 LocalLink | Find. Book. Connect.

</p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>