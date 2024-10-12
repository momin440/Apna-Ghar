<?php
$servername = "localhost";
$username = "root";
$password = "Momin@786";
$dbname = "property_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    
    $sql = "DELETE FROM properties WHERE id='$id'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Property deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
