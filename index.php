<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LocalLink - Find. Book. Connect.</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Your CSS -->
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Makes service cards clickable without changing their appearance */
        .service-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .service-link:hover {
            color: inherit;
        }
    </style>
</head>

<body>

<!-- Navigation -->
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


<!-- Hero Section -->
<!-- Hero Section -->
<section class="hero d-flex align-items-center text-white">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <span class="badge bg-success mb-3 px-3 py-2">
                    Trusted Local Professionals
                </span>

                <h1 class="display-3 fw-bold mb-3">
                    Find Trusted Local Service Providers
                </h1>

                <p class="lead mb-4">
                    Connect with trusted plumbers, electricians, cleaners,
                    mechanics, tutors and many more. Compare providers,
                    request quotes and book services quickly and securely.
                </p>

                <a href="search.php"
                   class="btn btn-success btn-lg me-3 px-4">

                    <i class="bi bi-search"></i>
                    Search Services

                </a>

                <a href="register.php"
                   class="btn btn-outline-light btn-lg px-4">

                    Get Started

                </a>

            </div>

            <div class="col-lg-6 text-center">

                <img src="images/hero.png"
                     class="img-fluid"
                     style="max-height:450px;"
                     alt="Local Services">

            </div>

        </div>

    </div>

</section>


<!-- Popular Services -->
<!-- Popular Services -->
<section class="container my-5">

    <h2 class="text-center fw-bold mb-5">
        Popular Services
    </h2>

    <div class="row g-4">

        <!-- Plumbing -->
        <div class="col-lg-4 col-md-6">

            <a href="search.php?service=plumbing" class="service-link">

                <div class="service-card plumbing">

                    <i class="bi bi-wrench-adjustable-circle-fill"></i>

                    <h5 class="mt-3">Plumbing</h5>

                    <p>
                        Professional plumbers for leaks,
                        installations and emergency repairs.
                    </p>

                    <span>Explore <i class="bi bi-arrow-right"></i></span>

                </div>

            </a>

        </div>


        <!-- Electrical -->
        <div class="col-lg-4 col-md-6">

            <a href="search.php?service=electrical" class="service-link">

                <div class="service-card electrical">

                    <i class="bi bi-lightning-charge-fill"></i>

                    <h5 class="mt-3">Electrical</h5>

                    <p>
                        Certified electricians for homes,
                        offices and businesses.
                    </p>

                    <span>Explore <i class="bi bi-arrow-right"></i></span>

                </div>

            </a>

        </div>


        <!-- Cleaning -->
        <div class="col-lg-4 col-md-6">

            <a href="search.php?service=cleaning" class="service-link">

                <div class="service-card cleaning">

                    <i class="bi bi-stars"></i>

                    <h5 class="mt-3">Cleaning</h5>

                    <p>
                        Reliable residential and commercial
                        cleaning professionals.
                    </p>

                    <span>Explore <i class="bi bi-arrow-right"></i></span>

                </div>

            </a>

        </div>

    </div>

</section>v

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4 mt-5">

    <p class="mb-0">
        © 2026 LocalLink | Find. Book. Connect.
    </p>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>