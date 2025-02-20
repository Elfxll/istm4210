<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $listing_id = $_POST["listing_id"];
    $action = $_POST["action"];
    
    //connect database
    $servername = "mai-nguyen.online";
    $username = "mai_n";
    $password = "W8AEkw=?r#tH";
    $database = "STUDENT_HUB"; 
    
    $conn = new mysqli($servername, $username, $password, $database);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($action == "Update Listing") {
        //retrieve form data for updating the listing
        $name = $_POST["name"];
        $category = $_POST["category"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        $location = $_POST["location"];
        
        //SQL for updating the listing
        $sql = "UPDATE LISTINGS SET name = ?, category = ?, price = ?, description = ?, location = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $name, $category, $price, $description, $location, $listing_id);
        
        //check if new image was uploaded
        if (!empty($_FILES["image"]["name"])) {
            $image = $_FILES["image"]["name"];
            //move the uploaded image to a new location
            move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $image);
        }
        
        if ($stmt->execute()) {
            echo "Listing updated successfully!";
        } else {
            echo "Error updating listing: " . $stmt->error;
        }
        
        $stmt->close();
    } elseif ($action == "Delete Listing") {
        //SQL statement for deleting the listing
        $sql = "DELETE FROM LISTINGS WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $listing_id);
        
        if ($stmt->execute()) {
            echo "Listing deleted successfully!";
        } else {
            echo "Error deleting listing: " . $stmt->error;
        }
        
        $stmt->close();
    }
    
    $conn->close();
}
?>
