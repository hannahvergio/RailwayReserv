<?php 
include('../connect/connect.php');
// include('../procedure/procedure.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid my-3">
    <h2 class="text-center">Registration Form</h2>

    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-8 col-x1-6">
            <form action="" method="post" enctype="multipart/form-data">
                <!-- username field -->
                <div class="form-outline mb-4">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="p_username"/>
                </div>
                <!-- email field -->
                <div class="form-outline mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Enter your email" autocomplete="off" required="required" name="p_email"/>
                </div>
                <!-- password field -->
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="p_password"/>
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-label">Gender</label>
                    <input type="text" id="gender" class="form-control" placeholder="Enter your gender" autocomplete="off" required="required" name="p_gender"/>
                </div>
                <!-- address field -->
                <div class="form-outline mb-4">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" class="form-control" placeholder="Enter your address" autocomplete="off" required="required" name="p_address"/>
                </div>
                <!-- Contact Field -->
                <div class="form-outline mb-4">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="text" id="contact" class="form-control" placeholder="Enter your Mobile Number" autocomplete="off" required="required" name="p_contact"/>
                </div>

                <div class="mt-4 pt-2">
                    <input type="submit" value="register" class="bg-success py-2 px-3 border-0" name="register">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ? <a href="login.php" class="text-danger"> Login</a></p>
                </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>

<?php
if (isset($_POST['register'])) {
    $p_username = $_POST['p_username'];
    $p_email = $_POST['p_email'];
    $p_password = $_POST['p_password'];
    $p_password = password_hash($p_password, PASSWORD_DEFAULT);    
    $p_gender = $_POST['p_gender'];
    $p_address = $_POST['p_address'];
    $p_contact = $_POST['p_contact'];

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'railway_reserv');

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
    } else {
        // Prepare the query
        $insert_query = "INSERT INTO `passenger_acc` (p_username, p_email, p_password, p_gender, p_address, p_contact) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);

        if ($stmt) {
            // Bind parameters and execute the statement
            $stmt->bind_param("sssssi", $p_username, $p_email, $p_password, $p_gender, $p_address, $p_contact);
            $execval = $stmt->execute();

            if ($execval) {
                echo "<script>alert('Registration successful. Please login.');</script>";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }

        $conn->close();
    }
}
?>
