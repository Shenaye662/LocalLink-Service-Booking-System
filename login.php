<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | LocalLink</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Your CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-light">

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
                    <a class="nav-link" href="index.php">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="search.php">Services</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="about.php">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.php">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="login.php">Login</a>
                </li>

                <li class="nav-item ms-2">
                    <a href="register.php" class="btn btn-success px-4 fw-bold">
                        Register
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>

<!-- Hero -->
<section class="bg-primary text-white text-center py-5">

    <div class="container">

        <h1 class="display-5 fw-bold">
            Welcome Back
        </h1>

        <p class="lead">
            Login to access your LocalLink account.
        </p>

    </div>

</section>

<!-- Login Card -->
<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <div class="text-center mb-4">

                        <div class="bg-primary text-white rounded-circle d-inline-flex justify-content-center align-items-center"
                             style="width:90px;height:90px;">

                            <i class="bi bi-person-fill fs-1"></i>

                        </div>

                        <h2 class="mt-3 fw-bold">
                            Login
                        </h2>

                        <p class="text-muted">
                            Enter your email and password below.
                        </p>

                    </div>

                    <form action="login_process.php" method="POST">

                        <!-- Email -->
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>

                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       placeholder="Enter your email"
                                       required>

                            </div>

                        </div>

                        <!-- Password -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>

                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Enter your password"
                                       required>

                            </div>

                        </div>

                        <!-- Login Button -->
                        <button class="btn btn-success w-100 py-2 fw-bold">

                            <i class="bi bi-box-arrow-in-right"></i>

                            Login

                        </button>

                    </form>

                    <hr>

                    <div class="text-center">

                        <p class="mb-0">

                            Don't have an account?

                            <a href="register.php"
                               class="fw-bold text-success">

                                Register Here

                            </a>

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-4 mt-5">

    <p class="mb-0">

        © 2026 LocalLink | Find. Book. Connect.

    </p>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>