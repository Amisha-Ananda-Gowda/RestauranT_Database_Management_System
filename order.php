<?php
include './config/config.php'; 


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['uid'], $_POST['fname'], $_POST['quantity'], $_POST['amount'], $_POST['pay_method'], $_POST['pay_id'])) {
    
    // Retrieve and sanitize data from form
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $pay_method = mysqli_real_escape_string($conn, $_POST['pay_method']);
    $pay_id = mysqli_real_escape_string($conn, $_POST['pay_id']);

    // Prepare SQL statement
    $sql = "INSERT INTO food (uid, fname, quantity, amount, pay_method, pay_id) VALUES ('$uid', '$fname', '$quantity', '$amount', '$pay_method', '$pay_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Order Placed Successfully";
    } else {
        if ($conn->errno == 1452) {
            echo "User ID does not exist. Please make sure the user is registered.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

} else {
    echo "";
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restaurant Database Management System</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/machali.jpg" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="./css copy/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="./css copy/style.css" rel="stylesheet">
    <style>
        .img {
            height: 500px;
            width: 196px;
        }
    </style>
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar & Hero Start -->
        <div class="container-xxl position-relative p-0">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0">
                <a href="" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><img src="img/machali1.png">&nbspCoastal Machali</h1>
                    <!-- <img src="img/logo.png" alt="Logo"> -->
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0 pe-4">
                        <a href="index1.html" class="nav-item nav-link">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="order.php" class="nav-item nav-link active">Order</a>
                        <a href="menu.html" class="nav-item nav-link">Menu</a>
                       
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="booking.php" class="btn btn-primary py-2 px-4">Book A Table</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Order</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="index1.html">Home</a></li>

                            <li class="breadcrumb-item text-white active" aria-current="page">Orders</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Reservation Start -->
        <div class="container-xxl py-5 px-0 wow fadeInUp" data-wow-delay="0.1s">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="img/img2.jpg" class="img">
                    <img src="img/img4.jpg" class="img">
                    <img src="img/img10.jpg" class="img">
                </div>
                <div class="col-md-6 bg-dark d-flex align-items-center">
                    <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
                        <h5 class="section-title ff-secondary text-start text-primary fw-normal">Order</h5>
                        <h1 class="text-white mb-4">Order Food Online</h1>
                        <!-- ... the top part of your HTML remains unchanged ... -->

                        <form action="order.php" method="post">
                            <div class="row g-3">
                            <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="uid" name="uid" placeholder="Your User ID">
            <label for="uid">Your User ID</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="fname" name="fname" placeholder="Food Name">
            <label for="fname">Food Name</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
            <label for="quantity">Quantity</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="pay_method" name="pay_method" placeholder="Payment Method">
            <label for="pay_method">Payment Method</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="pay_id" name="pay_id" placeholder="Payment-ID">
            <label for="pay_id">Payment-ID</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Total Amount">
            <label for="amount">Total Amount</label>
        </div>
    </div>

    <div class="col-12">
        <button class="btn btn-primary w-100 py-3" type="submit">Place Order</button>
    </div>
</form>

                        <!-- ... the rest of your HTML remains unchanged ... -->

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen
                                allowscriptaccess="always" allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Reservation Start -->


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">

                    <div class="col-lg-6 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Cears Plaza, 136, First Floor,
                            Residency Road, Bangalore, Karnataka 560025</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 99000 06779</p>

                        <div class="d-flex pt-2">

                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/yamashiroblr/"><i
                                    class="fab fa-facebook-f"></i></a>

                            <a class="btn btn-outline-light btn-social"
                                href="https://www.instagram.com/coastalmachalico/"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Opening</h4>
                        <h5 class="text-light fw-normal">Monday - Sunday</h5>

                        <p>11:30AM - 3:00PM</p>
                        <p>AND</p>
                        <p>7:00PM - 11:30PM</p>

                    </div>
                </div>
                <div class="container">
                    <div class="copyright">
                        <div class="row">
                            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                                &copy; <a class="border-bottom" href="https://coastal-machali.netlify.app"">Restaurant Database Management System</a>
                        
                        
                        Designed By<br> <a class=" border-bottom" href="https://amisha-ananda-gowda.netlify.app">Amisha
                                    Ananda Gowda </a>and Greeshma
                            </div>
                            <div class="col-md-6 text-center text-md-end">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->


            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>

        <!-- JavaScript Libraries -->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="lib/wow/wow.min.js"></script>
        <script src="lib/easing/easing.min.js"></script>
        <script src="lib/waypoints/waypoints.min.js"></script>
        <script src="lib/counterup/counterup.min.js"></script>
        <script src="lib/owlcarousel/owl.carousel.min.js"></script>
        <script src="lib/tempusdominus/js/moment.min.js"></script>
        <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
        <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

        <!-- Template Javascript -->
        <script src="js/main.js"></script>
</body>

</html>