<?php
session_start();
include '../config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve values from the form
    $uid = $_POST['uid'];
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];

    // Prepare SQL query using the mysqli prepared statement
    $sql = "INSERT INTO myusers (uid, uname, email, password, gender, dob) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    
    // Bind the parameters
    $stmt->bind_param("ssssss", $uid, $uname, $email, $password, $gender, $dob);
    
    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Error occurred: " . $stmt->error;
        $_SESSION['msg_type'] = "danger";
    }

    // Close the statement
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .alert-danger {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
    </style>
</head>
<body>


<div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
    <div class="front">
            <img src="../img/img2.jpg" alt="">
            <div class="text">
                <span class="text-1">Complete miles of journe<br> new adventure</span>
                <span class="text-2">Let's get started</span>
            </div>
        </div>
        <div class="back">
            <img class="backImg" src="../images/Screenshot1.png" alt="">
            <div class="text">
                <span class="text-1">y <br> with one step</span>
                <span class="text-2"></span>
            </div>
        </div>
    </div>

    <div class="forms">
        <div class="form-content">
      

        <div class="signup-form">
        <div class="title">Signup</div>
    <form action="" method="POST">
        <div class="input-boxes">
            <div class="input-box">
                <i class="fas fa-id-card"></i>
                <input type="text" id="uid" name="uid" placeholder="Enter your user id" required>
            </div>
            <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" id="uname" name="uname" placeholder="Enter your name" required>
            </div>
            <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <div class="input-box"> 
                <i class="fas fa-child"></i>
                <input type="text" id="gender" name="gender" placeholder="Enter your gender">
            </div>
            <h3>Select your Date of Birth</h3>
            <div class="input-box">
                <i class="fa fa-calendar"></i>
                <input type="date" id="dob" name="dob" placeholder="dd-mm-yyyy" required>
            </div>
            <div class="button input-box">
                <input type="submit" value="Signup">
            </div>
            <div class="text sign-up-text">Already have an account? <a href="login.php">Login now</a></div>
            <?php
        if (isset($_SESSION['message'])):
        ?>
            <div class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
        </div>
    </form>
        </div>
        </div>
    </div>
</div>
</body>
</html>
