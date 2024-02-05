
<?php
include('../includes/connect.php');
include('../function/common_function.php');
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
    <h2 class="text-center mb-5">Admin Rergistration</h2>
    <div class="row d-flex justify-content-center ">
        <div class="col-lg-6 col-xl-5">
            <img src="images/adminreg.jpg" alt="Admin Registration" class="img-fluid">
        </div>
        <div class="col-lg-6 col-xl-4">
            <form action="" method="post">
                <div class="form-outline mb-4">
                    <label for="username" class="form-lable">User Name</label>
                    <input type="text" id="username"name="username" placeholder="Enter you Name" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="email" class="form-lable">E-Mail</label>
                    <input type="email" id="email"name="email" placeholder="Enter you email" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="password" class="form-lable">Password</label>
                    <input type="password" id="password"name="password" placeholder="Enter you password" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
                    <label for="confirm password" class="form-lable">Confirm Password</label>
                    <input type="password" id="confirm password"name="confirm_password" placeholder="Enter you confirm password" required="required" class="form-control">
                </div>
                <div class="form-outline mb-4">
    <label for="Mobile" class="form-lable">Mobile No.</label>
    <input type="number" id="Mobile No." name="Mobile" placeholder="Enter your Mobile number" required="required" class="form-control">
</div>

                <div class="">
                    <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_registration" value="Register">
                    <p class="smal fw-bold mt-2 pt-1">Do You Already have an Account? <a href="admin_login.php" class="link-danger">Login</a></p>
                </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>


<!-- php code  -->
<?php
if (isset($_POST['admin_registration'])) {

    $admin_name = $_POST['username'];
    $admin_email = $_POST['email'];
    $admin_password = $_POST['password'];
    $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);
    $confirm_password = $_POST['confirm_password'];
    $mobile_number = $_POST['Mobile'];
    
    // Select query
    $select_query = "SELECT * FROM `admin_table` WHERE admin_email='$admin_email' OR mobile_number='$mobile_number'";
    $result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($result);
    
    if ($rows_count > 0) {
        echo "<script>alert('Admin already exists')</script>";
    } elseif ($admin_password != $confirm_password) {
        echo "<script>alert('Password Does not Matched')</script>";
    } else {
        // Insert query
        $insert_query = "INSERT INTO `admin_table` (admin_name, admin_email, admin_password, mobile_number) 
                 VALUES ('$admin_name', '$admin_email', '$hash_password', $mobile_number)";


        $sql_execute = mysqli_query($con, $insert_query);

        if ($sql_execute) {
            echo "<script>alert('Successfully Registered')</script>";
            echo "<script>window.open('admin_login.php','_self')</script>";
        } else {
            echo "<script>alert('Registration Failed')</script>";
        }
    }
}
?>
