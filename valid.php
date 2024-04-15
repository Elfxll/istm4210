<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

//connect database
$servername = "mai-nguyen.online";
$username = "mai_n";
$password = "W8AEkw=?r#tH";
$database = "STUDENT_HUB"; 

$conn = new mysqli($servername, $username, $password, $database);

//connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = $_POST['username'];
    $password = $_POST['password'];

    //SQL query
    $sql = "SELECT PASS_HASH, PASS_SALT FROM LOGIN WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        //fetch password hash and salt
        $row = $result->fetch_assoc();
        $stored_hash = $row['PASS_HASH'];
        $salt = $row['PASS_SALT'];

        //hash the provided password with the stored salt
        $hashed_password = hash('sha256', $password . $salt);

        //compare the hashed passwords
        if ($hashed_password === $stored_hash) {
            //check password match
            $_SESSION['username'] = $username;
            header("Location: home.html"); //redirect to home if valud
            exit();
        } else {
            //incorrect password
            header("Location: login-error.html"); //redirect to error page if invalid
        }
    } else {
        //user not found
        header("Location: login-error.html"); //redirect to error page if invalid
    }

    $stmt->close();
    $conn->close();
}
?>
