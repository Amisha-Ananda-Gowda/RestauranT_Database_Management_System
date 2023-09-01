<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "restaurant";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if($conn) {
  /*  echo "conn works fine";
    echo "<a href='../login/login.html'>Login</a>"; // Corrected this line
*/
}
else {
    echo "conn err";
}
?>
