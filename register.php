<?php
$servername = "mai-nguyen.online";
$username = "mai_n";
$password = "W8AEkw=?r#tH";
$database = "STUDENT_HUB"; 

//connect database
$conn = new mysqli($servername, $username, $password, $database);

//check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //user credentials
    $username = $_POST['username'];
    $password = $_POST['password'];

    //salt and hash password
    $salt = bin2hex(random_bytes(32));
    $hashed_password = hash('sha256', $password . $salt);

    $sql = "INSERT INTO LOGIN (username, pass_hash, pass_salt) VALUES (?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $hashed_password, $salt);

    if ($stmt->execute() === TRUE) {
            echo "<script>";
            echo "alert('User registered successfully. Log in to get started.');";
            echo "window.location.href = 'index.html';";
            echo "</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $stmt->close();
}

$conn->close();
?>
