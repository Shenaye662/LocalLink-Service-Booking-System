<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | LocalLink</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Custom CSS -->
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

<!-- Registration Form -->
<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-lg-7">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    <h2 class="text-center fw-bold mb-2">
                        Create Your Account
                    </h2>

                    <p class="text-center text-muted mb-4">
                        Join LocalLink today and start finding or offering trusted local services.
                    </p>

                 <form action="register_process.php" method="POST">

    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label">First Name</label>
            <input type="text" name="firstName" class="form-control" placeholder="Enter first name" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" name="lastName" class="form-control" placeholder="Enter last name" required>
        </div>

    </div>

    <div class="mb-3">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="example@email.com" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Phone Number</label>
        <input type="tel" name="phone" class="form-control" placeholder="0123456789" required>
    </div>

    <div class="row">

        <div class="col-md-6 mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirmPassword" class="form-control" required>
        </div>

    </div>

    <div class="mb-3">
        <label class="form-label">Province</label>

        <select class="form-select" name="province" required>

            <option value="" disabled selected>Select Province</option>

            <option>Gauteng</option>
            <option>KwaZulu-Natal</option>
            <option>Western Cape</option>
            <option>Eastern Cape</option>
            <option>Free State</option>
            <option>Limpopo</option>
            <option>Mpumalanga</option>
            <option>North West</option>
            <option>Northern Cape</option>

        </select>

    </div>

    <div class="mb-3">
        <label class="form-label">Account Type</label>

        <select class="form-select" name="accountType" required>

            <option value="" disabled selected>Select Account Type</option>

            <option value="Customer">Customer</option>
            <option value="Service Provider">Service Provider</option>

        </select>

    </div>

    <div class="form-check mb-4">

        <input class="form-check-input" type="checkbox" required>

        <label class="form-check-label">
            I agree to the Terms & Conditions.
        </label>

    </div>

    <button type="submit" class="btn btn-primary w-100 btn-lg">
        Create Account
    </button>

</form>

                    <hr>

                    <p class="text-center">

                        Already have an account?

                        <a href="login.php">Login here</a>

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>