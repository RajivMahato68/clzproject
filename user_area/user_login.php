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
    <title>User Login</title>
      <!-- bootstarp css link -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
     <!-- css file  -->
     <link rel="stylesheet" href="../style.css">
     <style>
        body{
            overflow-x:hidden;
        }
        .footer{
            position: absolute;
            bottom:0;
        }
     </style>
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6 ">
            <form action="" method="post">
                <!-- User_name  -->
                <div class="form-outline mb-4">
                    <label for="user_username" class="form-label">User Name</label>
                    <input type="text" id="user_username" class="form-control" placeholder="Enter your Name" autocomplete="off" required="required" name="user_username"/>
                </div>
                 <!-- password  -->
                 <div class="form-outline mb-4">
                    <label for="user_password" class="form-label">Your password</label>
                    <input type="password" id="user_password" class="form-control" placeholder="Enter your password" autocomplete="off" required="required" name="user_password"/>
    </div>
                <div class="mt-4 pt-2">
                    <input type="submit" value="Login" class="bg-info py-2 px-3 border-0" name="user_login">
                    <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an accout ? <a href="user_registration.php" class="text-danger"> Register</a></p>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
<!-- php code in user login  -->
<?php
if(isset($_POST['user_login'])){
    $user_username=$_POST['user_username'];
    $user_password=$_POST['user_password'];

    $select_query="select * from `user_tables` where username='$user_username'";
    $result=mysqli_query($con,$select_query);
    $row_count=mysqli_num_rows($result);
    $row_data=mysqli_fetch_assoc($result);
    $user_ip=getIPAddress();
    //cart items
    $select_query_cart="select * from `cart_detail` where ip_address='$user_ip'";
    $select_cart=mysqli_query($con,$select_query_cart);
    $row_count_cart=mysqli_num_rows($select_cart);
    if($row_count>0){
        $_SESSION['username']=$user_username;
        if(password_verify($user_password,$row_data['user_password'])){
            // echo "<script>alert('Login Sucessfully')</script>";
            if($row_count==1 and $row_count_cart==0){
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login Sucessfully')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            }else{
                $_SESSION['username']=$user_username;
                echo "<script>alert('Login Sucessfully')</script>";
                echo "<script>window.open('profile.php','_self')</script>";
            }

        }else{
            echo "<script>alert('Password not matched')</script>";
        }

    }else{
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>