<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form Messages</title>
    <link rel="stylesheet" href="style.css"> 
    
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="Contact.php">Leads</a></li>
            </ul>
        </nav>
    </header>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "Momin@786";
    $dbname = "contact_form";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch records
    $sql = "SELECT * FROM contacts";
    $result = $conn->query($sql);

    // Check if there are any records to display
    if ($result->num_rows > 0) {
        echo "<br><br><table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>";

        // Output data for each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["name"] . "</td>
                    <td>" . $row["email"] . "</td>
                    <td>" . $row["phone"] . "</td> 
                    <td>" . $row["subject"] . "</td>
                    <td>" . $row["message"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No messages found.";
    }

    // Close connection
    $conn->close();
    ?>

</body>
</html>
