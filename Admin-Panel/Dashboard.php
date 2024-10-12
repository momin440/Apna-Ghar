<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="Contact.php">Leads</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Section -->
    <main>
        <h1>Properties List</h1>

        <!-- Display Property Table -->
        <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "Momin@786";
            $dbname = "property_db";
            
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Fetch properties from database
            $sql = "SELECT * FROM properties";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
                echo "<table border='1'>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Location</th>
                            <th>For Sale/Rent</th>
                            <th>Sqft</th>
                            <th>Bedrooms</th>
                            <th>Bathrooms</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>";
            
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["id"] . "</td>
                            <td>" . $row["title"] . "</td>
                            <td>" . $row["price"] . "</td>
                            <td>" . $row["descriptions"] . "</td>
                            <td>" . $row["location"] . "</td>
                            <td>" . $row["forSaleOrRent"] . "</td>
                            <td>" . $row["sqft"] . "</td>
                            <td>" . $row["bedrooms"] . "</td>
                            <td>" . $row["bathrooms"] . "</td>
                            <td><img src='../img/" . $row["image"] . "' alt='Property Image' width='100'></td>
                            <td>
                                <form method='POST' action='edit.php' style='display:inline-block;'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <button type='submit'>Edit</button>
                                    
                                </form>
                                <form method='POST' action='delete.php' style='display:inline-block;' onsubmit='return confirm(\"Are you sure?\");'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <button type='submit'>Delete</button>
                                </form>
                            </td>
                          </tr>";
                }
                echo "</table>";
            } else {
                echo "No properties found.";
            }
            
            $conn->close();
        ?>
        
        <!-- Add Property Form -->
        <h1 >Add Property</h1>
        <form action="Add.php" method="POST" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" name="title" required><br>

            <label for="price">Price:</label>
            <input type="number" name="price" required><br>

            <label for="description">Description:</label>
            <textarea name="description" required></textarea><br>

            <label for="location">Location:</label>
            <input type="text" name="location" required><br>

            <label for="forSaleOrRent">For Sale or Rent:</label>
            <input type="text" name="forSaleOrRent" required><br>

            <label for="sqft">Sqft:</label>
            <input type="number" name="sqft" required><br>

            <label for="bedrooms">Bedrooms:</label>
            <input type="number" name="bedrooms" required><br>

            <label for="bathrooms">Bathrooms:</label>
            <input type="number" name="bathrooms" required><br>
                     <br>
            <label for="image">Image:</label>
            <input type="file" name="image" accept="image/*" required><br>
            <br>
            <button type="submit">Add Property</button>
        </form>
    </main>

    <script src="script.js"></script>
</body>
</html>
