<?php
// Database connection
$servername = "mai-nguyen.online";
$username = "mai_n";
$password = "W8AEkw=?r#tH";
$database = "STUDENT_HUB"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") { // Corrected to check for POST method
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Password salt and hash
    $salt = bin2hex(random_bytes(32));
    $hashed_password = hash('sha256', $password . $salt);

    $sql = "INSERT INTO LOGIN (username, pass_hash, pass_salt) VALUES (?, ?, ?)";
    
    // parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $hashed_password, $salt);

    if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
