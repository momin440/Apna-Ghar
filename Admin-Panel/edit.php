<?php
$servername = "localhost";
$username = "root";
$password = "Momin@786";
$dbname = "property_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Fetch the existing property details
    $sql = "SELECT * FROM properties WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No property found with this ID.";
        exit;
    }
} else {
    echo "No ID provided.";
    exit;
}

// Handle the update process
if (isset($_POST['update'])) {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $forSaleOrRent = $_POST['forSaleOrRent'];
    $sqft = $_POST['sqft'];
    $bedrooms = $_POST['bedrooms'];
    $bathrooms = $_POST['bathrooms'];

    // Handle image upload if provided
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "../img/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $sql = "UPDATE properties SET title='$title', price='$price', descriptions='$description', location='$location', forSaleOrRent='$forSaleOrRent', sqft='$sqft', bedrooms='$bedrooms', bathrooms='$bathrooms', image='$image' WHERE id=$id";
    } else {
        $sql = "UPDATE properties SET title='$title', price='$price', descriptions='$description', location='$location', forSaleOrRent='$forSaleOrRent', sqft='$sqft', bedrooms='$bedrooms', bathrooms='$bathrooms' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Property updated successfully";
        header('Location: Dashboard.php'); 
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<html>
<head>
    <title>Edit Property</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Property</h1>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required><br>

    <label for="price">Price:</label>
    <input type="number" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required><br>

    <label for="description">Description:</label>
    <textarea name="description" required><?php echo htmlspecialchars($row['descriptions']); ?></textarea><br>

    <label for="location">Location:</label>
    <input type="text" name="location" value="<?php echo htmlspecialchars($row['location']); ?>" required><br>

    <label for="forSaleOrRent">For Sale or Rent:</label>
    <input type="text" name="forSaleOrRent" value="<?php echo htmlspecialchars($row['forSaleOrRent']); ?>" required><br>

    <label for="sqft">Sqft:</label>
    <input type="number" name="sqft" value="<?php echo htmlspecialchars($row['sqft']); ?>" required><br>

    <label for="bedrooms">Bedrooms:</label>
    <input type="number" name="bedrooms" value="<?php echo htmlspecialchars($row['bedrooms']); ?>" required><br>

    <label for="bathrooms">Bathrooms:</label>
    <input type="number" name="bathrooms" value="<?php echo htmlspecialchars($row['bathrooms']); ?>" required><br>

    <label for="image">Image:</label>
    <input type="file" name="image" accept="image/*"><br>
    <img src="../img/<?php echo htmlspecialchars($row['image']); ?>" width="100"><br>

    <button type="submit" name="update">Update Property</button>
</form>

</body>
</html>
