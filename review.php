<?php

include './config/config.php'; 

$reviews = [];
$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uid = $_POST['uid'];
    $uname = $_POST['uname'];
    $message = $_POST['message'];
    $rate = $_POST['rate'];

    $stmt = $conn->prepare("INSERT INTO review (uid, uname, message, rate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $uid, $uname, $message, $rate);

    if (!$stmt->execute()) {
        $errorMsg = "Error: " . $stmt->error;
    } else {
        $errorMsg = "Review submitted successfully!";
    }

    $stmt->close();
}

// Fetch reviews from database
$result = $conn->query("SELECT uname, uid, message, rate FROM review LIMIT 5");

if ($result) {
    while($row = $result->fetch_assoc()) {
        $reviews[] = $row;
    }
    $result->free();
} else {
    die("Database query failed: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Restoran - Bootstrap Restaurant Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

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
    <link href="./css copy/review.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0 align-items-center">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
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
                        <a href="menu.html" class="nav-item nav-link">Menu</a>
                        <a href="order.php" class="nav-item nav-link">Order</a>
                        <a href="review.php" class="nav-item nav-link active">Review</a>
                       
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    <a href="booking.php" class="btn btn-primary py-2 px-4">Book A Table</a>
                </div>
            </nav>

            <div class="container-xxl py-5 bg-dark hero-header mb-5">
                <div class="container text-center my-5 pt-5 pb-4">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Reviews</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center text-uppercase">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                      
                            <li class="breadcrumb-item text-white active" aria-current="page">Reviews</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Navbar & Hero End -->

        <!-- Reservation Start -->
        <div class="container-xxl py-5 px-0 wow fadeInUp d-flex justify-content-center align-items-center" data-wow-delay="0.1s">
    <div class="align-items-center col-md-6 bg-dark d-flex">
        <div class="p-5 wow fadeInUp" data-wow-delay="0.2s">
            <h5 class="section-title ff-secondary text-start text-primary fw-normal">Your Opinions Matter: </h5>
            <h1 class="text-white mb-4">Post Your Review</h1>

            <form action="" method="post">  
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="userid" name="uid" placeholder="Your User ID">
                            <label for="userid">Your User ID</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                <input type="text" class="form-control" id="userid" name="uid" placeholder="Your User ID">
                <label for="userid">Your User ID</label>
            </div>
        </div>
       
        <div class="col-md-6">
            <div class="form-floating">
                <input type="text" class="form-control" id="username" name="uname" placeholder="Your Name">
                <label for="username">Your Name</label>
            </div>
        </div>
        
        <div class="col-12">
            <div class="form-floating">
                <textarea class="form-control" placeholder="Share your Reviews" id="message" name="message" style="height: 100px"></textarea>
                <label for="message">Share your Reviews</label>
            </div>
        </div>
        <div class="col-12">
            <section class="rating" id="rating">
                <input type="button" class="circle" value="1" onclick="setRating(1)">
                <input type="button" class="circle" value="2" onclick="setRating(2)">
                <input type="button" class="circle" value="3" onclick="setRating(3)">
                <input type="button" class="circle" value="4" onclick="setRating(4)">
                <input type="button" class="circle" value="5" onclick="setRating(5)">
            </section>
            <!-- Hidden field to capture the rating -->
            <input type="hidden" name="rate" id="hiddenRate" value="">
        </div>
        <div class="col-12">
            <button class="btn btn-primary w-100 py-3" type="submit">Post</button>
        </div>
    </div>
</form>



                    </div>
                </div>
            </div>
        </div>

        
                
         
        <!-- Reservation Start -->
    <!-- Testimonial Start -->
<div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="text-center">
            <h5 class="section-title ff-secondary text-center text-primary fw-normal">User Reviews Spotlight</h5>
        </div>
        <div class="owl-carousel testimonial-carousel">
            <?php foreach ($reviews as $review) { ?>
                <div class="testimonial-item bg-transparent border rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                    <p><?php echo htmlspecialchars($review['message']); ?></p>
                    <div>
                        <h5 class="mb-1"><?php echo htmlspecialchars($review['uname']); ?></h5>
                        <small>User ID: <?php echo htmlspecialchars($review['uid']); ?> | Rating: <?php echo htmlspecialchars($review['rate']); ?></small>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>   

         <!-- Footer Start -->
         <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                  
                    <div class="col-lg-6 col-md-6">
                        <h4 class="section-title ff-secondary text-start text-primary fw-normal mb-4">Contact</h4>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Cears Plaza, 136, First Floor, Residency Road, Bangalore, Karnataka 560025</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 99000 06779</p>

                        <div class="d-flex pt-2">

                            <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/yamashiroblr/"><i class="fab fa-facebook-f"></i></a>

                            <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/coastalmachalico/"><i class="bi bi-instagram"></i></a>
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
							
							
							Designed By<br> <a class="border-bottom" href="https://amisha-ananda-gowda.netlify.app">Amisha Ananda Gowda  </a>and Greeshma
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
    <script>
    function setRating(rating) {
        document.getElementById('hiddenRate').value = rating;
    }
</script>
</body>

</html>