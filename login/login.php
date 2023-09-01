<?php
include '../config/config.php';

$errorMsg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim(mysqli_real_escape_string($conn, $_POST['email'])); // trim and escape
    $password = trim($_POST['password']); // just trim

    $sql = "SELECT * FROM myusers WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            $errorMsg = "Invalid email or password!";
        } else {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                header("Location: ../index1.html");
                exit;
            } else {
                $errorMsg = "Invalid email or password!";
            }
        }

        $stmt->close();
    } else {
        $errorMsg = "Database error!";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
        <div class="front">
            <img src="../img/img9.jpg" alt="">
            <div class="text">
                <span class="text-1">Every new friend is a <br> new adventure</span>
                <span class="text-2">Let's get connected</span>
            </div>
        </div>
        <div class="back">
            <img class="backImg" src="../images/Screenshot1.png" alt="">
            <div class="text">
                <span class="text-1">Complete miles of journey <br> with one step</span>
                <span class="text-2">Let's get started</span>
            </div>
        </div>
    </div>
    <div class="forms">
        <div class="form-content">
            <div class="login-form">
                <div class="title">Login</div>
                <form action="login.php" method="POST">
                    <div class="input-boxes">
                        <div class="input-box">
                            <i class="fas fa-envelope"></i>
                            <input type="text" name="email" placeholder="Enter your email" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" placeholder="Enter your password" required>
                        </div>
                        <?php
                        // Display the error message if it exists
                        if ($errorMsg) {
                            echo "<div style='color: red;'>" . $errorMsg . "</div>";
                        }
                        ?>
                        <div class="text"><a href="#">Forgot password?</a></div>
                        <div class="button input-box">
                            <input type="submit" value="Login">
                        </div>
                        <div class="text sign-up-text">Don't have an account? <a href="signup.php">Signup now</a></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
