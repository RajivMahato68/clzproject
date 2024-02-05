<?php
include('../includes/connect.php');
include('../function/common_function.php');
@session_start();
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
      <!-- bootstarp css link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

 <!-- fontawesome link  -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body{
        overflow-x:hidden;

    }
</style>
</head>
<body>
    <div class="container-fluid m-3">
    <h2 class="text-center mb-5">Admin Login</h2>
    <div class="row d-flex justify-content-center ">
        <div class="col-lg-6 col-xl-5">
            <img src="images/login.jpg" alt="Admin Login" class="img-fluid">
        </div>
        <div class="col-lg-6 col-xl-4">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="username" class="form-lable">User Name</label>
                    <input type="text" id="username"name="admin_username" placeholder="Enter you Name" required="required"autocomplete="off" class="form-control">
                </div>
              
                <div class="form-outline mb-4">
                    <label for="password" class="form-lable">Password</label>
                    <input type="password" id="password"name="password" placeholder="Enter you password" required="required"autocomplete="off" class="form-control">
                </div>
                <div class="">
                    <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login" value="Login">
                    <p class="smal fw-bold mt-2 pt-1">Don't have Already Account? <a href="admin_registration.php" class="link-danger">Register</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>

<!-- php code -->

<?php
if (isset($_POST['admin_login'])) {
    $admin_username = $_POST['admin_username'];
    $password = $_POST['password'];

    // Update the column name in the WHERE clause
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_username'";
    $result = mysqli_query($con, $select_query);

    if (!$result) {
        die("Error in SQL query: " . mysqli_error($con));
    }

    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        $row_data = mysqli_fetch_assoc($result);
        $_SESSION['admin_username'] = $admin_username;

        if (password_verify($password, $row_data['admin_password'])) {
            echo "<script>alert('Login Successfully')</script>";
            echo "<script>window.open('index.php','_self')</script>";
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>
