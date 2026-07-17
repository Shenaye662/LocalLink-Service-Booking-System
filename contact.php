<?php
session_start();
include "includes/config.php";

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $subject = trim($_POST["subject"] ?? "");
    $message = trim($_POST["message"] ?? "");

    // Check that all fields are completed
    if (
        !empty($name) &&
        !empty($email) &&
        !empty($subject) &&
        !empty($message)
    ) {

        // Check email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $error = "Please enter a valid email address.";

        } else {

            // Save message to database
            $stmt = $conn->prepare(
                "INSERT INTO ContactMessages
                (FullName, Email, Subject, Message)
                VALUES (?, ?, ?, ?)"
            );

            $stmt->bind_param(
                "ssss",
                $name,
                $email,
                $subject,
                $message
            );

            if ($stmt->execute()) {

                $success = "Your message has been sent successfully!";

                // Clear the form after successful submission
                $name = "";
                $email = "";
                $subject = "";
                $message = "";

            } else {

                $error = "Something went wrong. Please try again.";

            }

            $stmt->close();
        }

    } else {

        $error = "Please complete all fields.";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Contact Us - LocalLink</title>


    <!-- Bootstrap -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"
        rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">


    <!-- LocalLink CSS -->
    <link
        rel="stylesheet"
        href="css/style.css">

</head>


<body>


<!-- NAVIGATION -->
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

<!-- CONTACT HERO -->
<section class="bg-primary text-white text-center py-5">


    <div class="container">


        <h1 class="display-4 fw-bold">

            Contact Us

        </h1>


        <p class="lead">

            Have a question? We're here to help.

        </p>


    </div>


</section>



<!-- CONTACT SECTION -->
<section class="container py-5">


    <div class="row g-5">


        <!-- LEFT SIDE -->
        <!-- CONTACT INFORMATION -->
        <div class="col-lg-5">


            <h2 class="fw-bold mb-4">

                Get in Touch

            </h2>


            <p class="text-muted mb-4">

                Whether you are a customer looking for assistance
                or a service provider interested in joining LocalLink,
                feel free to contact us.

            </p>



            <!-- EMAIL -->
            <div class="d-flex align-items-start mb-4">


                <i class="
                    fas
                    fa-envelope
                    text-primary
                    fs-3
                    me-3">
                </i>


                <div>


                    <h5>Email</h5>


                    <p class="text-muted">

                        support@locallink.co.za

                    </p>


                </div>


            </div>



            <!-- PHONE -->
            <div class="d-flex align-items-start mb-4">


                <i class="
                    fas
                    fa-phone
                    text-primary
                    fs-3
                    me-3">
                </i>


                <div>


                    <h5>Phone</h5>


                    <p class="text-muted">

                        +27 12 345 6789

                    </p>


                </div>


            </div>



            <!-- LOCATION -->
            <div class="d-flex align-items-start mb-4">


                <i class="
                    fas
                    fa-location-dot
                    text-primary
                    fs-3
                    me-3">
                </i>


                <div>


                    <h5>Location</h5>


                    <p class="text-muted">

                        South Africa

                    </p>


                </div>


            </div>



            <!-- SUPPORT HOURS -->
            <div class="d-flex align-items-start">


                <i class="
                    fas
                    fa-clock
                    text-primary
                    fs-3
                    me-3">
                </i>


                <div>


                    <h5>Support Hours</h5>


                    <p class="text-muted">

                        Monday – Friday

                        <br>

                        08:00 – 17:00

                    </p>


                </div>


            </div>


        </div>



        <!-- RIGHT SIDE -->
        <!-- CONTACT FORM -->
        <div class="col-lg-7">


            <div class="
                card
                border-0
                shadow-sm
                p-4">


                <div class="card-body">


                    <h2 class="fw-bold mb-4">

                        Send Us a Message

                    </h2>



                    <!-- SUCCESS MESSAGE -->
                    <?php if (!empty($success)): ?>


                        <div class="alert alert-success">


                            <i class="
                                fas
                                fa-circle-check
                                me-2">
                            </i>


                            <?php echo htmlspecialchars($success); ?>


                        </div>


                    <?php endif; ?>



                    <!-- ERROR MESSAGE -->
                    <?php if (!empty($error)): ?>


                        <div class="alert alert-danger">


                            <i class="
                                fas
                                fa-circle-exclamation
                                me-2">
                            </i>


                            <?php echo htmlspecialchars($error); ?>


                        </div>


                    <?php endif; ?>



                    <!-- FORM -->
                    <form
                        method="POST"
                        action="">



                        <!-- FULL NAME -->
                        <div class="mb-3">


                            <label
                                class="form-label">

                                Full Name

                            </label>


                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                placeholder="Enter your full name"
                                value="<?php echo htmlspecialchars($name ?? ''); ?>"
                                required>


                        </div>



                        <!-- EMAIL -->
                        <div class="mb-3">


                            <label
                                class="form-label">

                                Email Address

                            </label>


                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Enter your email"
                                value="<?php echo htmlspecialchars($email ?? ''); ?>"
                                required>


                        </div>



                        <!-- SUBJECT -->
                        <div class="mb-3">


                            <label
                                class="form-label">

                                Subject

                            </label>


                            <input
                                type="text"
                                name="subject"
                                class="form-control"
                                placeholder="What can we help you with?"
                                value="<?php echo htmlspecialchars($subject ?? ''); ?>"
                                required>


                        </div>



                        <!-- MESSAGE -->
                        <div class="mb-4">


                            <label
                                class="form-label">

                                Message

                            </label>


                            <textarea
                                name="message"
                                class="form-control"
                                rows="5"
                                placeholder="Write your message here..."
                                required><?php echo htmlspecialchars($message ?? ''); ?></textarea>


                        </div>



                        <!-- SEND BUTTON -->
                        <button
                            type="submit"
                            class="
                                btn
                                btn-primary
                                btn-lg
                                w-100">


                            <i class="
                                fas
                                fa-paper-plane
                                me-2">
                            </i>


                            Send Message


                        </button>


                    </form>


                </div>


            </div>


        </div>


    </div>


</section>



<!-- FOOTER -->
<footer class="
    bg-dark
    text-white
    text-center
    py-4
    mt-5">


    <p class="mb-0">

        © 2026 LocalLink | Find. Book. Connect.

    </p>


</footer>



<!-- BOOTSTRAP JAVASCRIPT -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>