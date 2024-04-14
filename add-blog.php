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
    $stmt = $conn->prepare("INSERT INTO BLOGS (blog_title, body_text, blog_date, contact_info) VALUES (?, ?, NOW(), ?)");
    $stmt->bind_param("sss", $blog_title, $body_text, $contact_info);

    // Set parameters and execute
    $blog_title = $_POST['blog_title'];
    $body_text = $_POST['body_text'];
    $contact_info = $_POST['contact_info'];

    $stmt->execute();

    $stmt->close();
    $conn->close();

    // Redirect the user after successful submission
    header("Location: blog.html");
    exit();
}
?>
