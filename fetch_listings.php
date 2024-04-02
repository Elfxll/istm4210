<?php
    $servername = "mai-nguyen.online";
    $username = "mai_n";
    $password = "W8AEkw=?r#tH";
    $database = "STUDENT_HUB"; // Changed database name
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Fetch listings from the database
    $sql = "SELECT * FROM LISTINGS"; // Changed table name
    $result = $conn->query($sql);
    
    $listings = array();
    
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $listings[] = $row;
        }
    }
    
    // Output listings as JSON
    header('Content-Type: application/json');
    echo json_encode($listings);
    
    $conn->close();
?>
