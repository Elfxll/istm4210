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
    
    //use SQL to get blogs, show most recent first
    $sql = "SELECT * FROM BLOGS ORDER BY BLOG_DATE DESC";
    $result = $conn->query($sql);
    
    $blogs = array();
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $blogs[] = $row;
        }
    }
    

    header('Content-Type: application/json');
    echo json_encode($blogs);
    
    $conn->close();
?>
