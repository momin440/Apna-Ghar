<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Momin@786";
$dbname = "contact_form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['send'])) {
    $names = $_POST['name'];
    $emails = $_POST['email'];
    $phones = $_POST['phone'];
    $subjects = $_POST['subject'];
    $messages = $_POST['message'];

    // Insert form data into the database
    $sql = "INSERT INTO contacts (name, email, phone, subject, message) VALUES ('$names', '$emails', '$phones', '$subjects', '$messages')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Message sent successfully!');</script>";
        header("Location:contact.html");    
         
    } else {
        echo "<script>alert('Message Not Send Error!!');</script>";
    }
}

// Close connection
$conn->close();
?>
