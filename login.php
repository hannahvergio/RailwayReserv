<?php 
    include('../connect/connect.php'); 
    session_start();

    // if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    //     header("location: welcome.php");
    //     exit;
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="style.css">

      <style>
    body{
        overflow-x:hidden;
    }
      </style>
</head>
<body>
<div class="container-fluid my-3">
    <h2 class="text-center">Login Form</h2>

    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-8 col-x1-6">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="p_username" class="form-label">Username</label>
                    <input type="text" id="p_username" class="form-control" placeholder="Enter your username" autocomplete="off" required="required" name="p_username"/>
                </div>


                <!-- password field -->
                <div class="form-outline mb-4">
                    <label for="p_password" class="form-label">Password</label>
                    <input type="password" id="password" class="form-control" placeholder="Enter your Password" autocomplete="off" required="required" name="p_password"/>
                </div>

                <div class="mt-4 pt-2">
                    <input type="submit" value="login" class="bg-success py-2 px-3 border-0" name="login">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account ? <a href="registration.php" class="text-danger">Register</a></p>
                </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>

<?php
if (isset($_POST['login'])) { 
    $p_username = $_POST['p_username'];
    $p_password = $_POST['p_password'];

    $conn = new mysqli('localhost', 'root', '', 'railway_reserv');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $select_query = "SELECT * FROM `passenger_acc` WHERE p_username='$p_username'";
    $result = mysqli_query($conn, $select_query);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        $row_data = mysqli_fetch_assoc($result);
        if (password_verify($p_password, $row_data['p_password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['p_username'] = $p_username;
            echo "<script>alert('Login Successful')</script>";
            echo "<script>window.open('welcome.php', '_self')</script>";
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
        exit;
    }
}
?>
