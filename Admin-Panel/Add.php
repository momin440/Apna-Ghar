<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "Momin@786";
$dbname = "property_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Collect form data
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        $forSaleOrRent = $_POST['forSaleOrRent'];
        $sqft = $_POST['sqft'];
        $bedrooms = $_POST['bedrooms'];
        $bathrooms = $_POST['bathrooms'];
    
        // File upload handling
        $Fileuplod = $_FILES['image']   ['tmp_name'];
        $Filerecive = '../img/' . $_FILES['image']['name'];
    
        // Move the uploaded file
        if (move_uploaded_file($Fileuplod, $Filerecive)) {
    
            // Insert data into the database
            $sql = "INSERT INTO properties (title, price, descriptions, location, forSaleOrRent, sqft, bedrooms, bathrooms, image)
                    VALUES ('$title', '$price', '$description', '$location', '$forSaleOrRent', '$sqft', '$bedrooms', '$bathrooms', '$Filerecive')";
    
            if ($conn->query($sql) === TRUE) {
                echo "<script>document.getElementById('add-not').innerHTML = 'New property added successfully!';</script>";
            } else {
                echo "<script>document.getElementById('add-not').innerHTML = 'Error: Property not added!';</script>     ";
            }
    
        } else {
            echo "<script>document.getElementById('add-not').innerHTML = 'Error uploading file.';</script>";
        }
}

}

else
{
    echo "<script>document.getElementById('add-not').innerHTML = 'Database connection failed.';</script>    ";
}
?>
