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
    
    // Fetch listings
    $sql = "SELECT * FROM LISTINGS";
    $result = $conn->query($sql);
    
    $listings = array();
    
    if ($result->num_rows > 0) {
        // Output each row
        while($row = $result->fetch_assoc()) {
            $listings[] = $row;
        }
    }
    

    header('Content-Type: application/json');
    echo json_encode($listings);
    
    $conn->close();
?>
