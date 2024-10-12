    <?php


    $db = mysqli_connect('localhost', 'root', 'Momin@786', 'Apna_Ghar');

    if ($db) {
        if (isset($_POST['submit'])) { 
            $email = $_POST['txt-email'];
            $password = $_POST['txt-password'];

        
            $sql = "SELECT * FROM Register WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($db, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $_SESSION['email'] = $email;

                
                if($email == 'mahommad@gmail.com' && $password == 123)
                {
                    header("Location: ../Admin-Panel/Admin-panel.html");
                }
                else{
                    header("Location: ../index.html");

                }
            
            
            } else {
                echo "Invalid email or password.";
            }
        } else {
            echo "Invalid request.";
        }
    } else {
        echo "Database connection failed.";
    }
    ?>
