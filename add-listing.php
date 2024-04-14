<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO LISTINGS (name, category, price, description, location, seller) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdsss", $name, $category, $price, $description, $location, $seller);

    // Set parameters and execute
    $name = $_POST['listing_name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $seller = $_POST['seller'];
    
    $stmt->execute();

    echo "<script>";
    echo "alert('Listing created successfully.');";
    echo "window.location.href = 'market.html';";
    echo "</script>";

    $stmt->close();
    $conn->close();
}
?>